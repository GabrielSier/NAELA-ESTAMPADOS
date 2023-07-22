<template>
  <div class="container">
    <button
      type="button"
      class="btn btn-success my-3 float-start"
      data-bs-toggle="modal"
      data-bs-target="#pvrModal"
      @click.prevent="AddButton()"
    >
      Añadir Proveedor
    </button>

    <table class="table table-primary table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Nombres</th>
          <th>Código</th>
          <th>Dirección</th>
          <th>Cantidad</th>
          <th>Monto</th>
          <th>Descuento</th>
          <th>Oferta</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="proveedor in proveedors" :key="proveedor.id">
          <td>{{ proveedor.id }}</td>
          <td>{{ proveedor.nombres }}</td>
          <td>{{ proveedor.codigo }}</td>
          <td>{{ proveedor.direccion }}</td>
          <td>{{ proveedor.cantidad }}</td>
          <td>{{ proveedor.monto }}</td>
          <td>{{ proveedor.descuento }}</td>
          <td>{{ proveedor.oferta }}</td>
          <td>
            <button
              type="button"
              class="btn btn-info mx-1 px-2"
              data-bs-toggle="modal"
              data-bs-target="#pvrModal"
              @click.prevent="EditButton(proveedor)"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="20"
                height="16"
                fill="currentColor"
                class="bi bi-pencil"
                viewBox="0 0 16 16"
              >
                <path
                  d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"
                />
              </svg>
            </button>

            <button
              type="button"
              class="btn btn-danger mx-1 px-2"
              @click.prevent="EliminarProveedor(proveedor)"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="20"
                height="16"
                fill="currentColor"
                class="bi bi-trash-fill"
                viewBox="0 0 16 16"
              >
                <path
                  d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"
                />
              </svg>
            </button>
          </td>
        </tr>
      </tbody>
    </table>

    <div
      class="modal fade"
      id="pvrModal"
      tabindex="-1"
      aria-labelledby="pvrModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title px-2" id="modalTitulo">
              {{ modalTitulo }}
            </h4>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Cerrar"
            ></button>
          </div>

          <div class="modal-body">
            <div class="input-group">
              <span class="input-group-text">Nombres</span>
              <input type="text" class="form-control" v-model="nombresProveedor" />
              <span class="input-group-text">Código</span>
              <input type="text" class="form-control" v-model="codProveedor" />
            </div>
            <div class="input-group">
              <span class="input-group-text">Dirección</span>
              <input type="text" class="form-control" v-model="direProveedor" />
              <span class="input-group-text">Cantidad</span>
              <input type="number" class="form-control" v-model="cantiProveedor" />
            </div>
            <div class="input-group">
              <span class="input-group-text">Monto</span>
              <input type="number" class="form-control" v-model="montoProveedor" />
              <span class="input-group-text">Descuento</span>
              <input type="number" class="form-control" v-model="descProveedor" />
            </div>
            <div class="input-group">
              <span class="input-group-text">Oferta</span>
              <input type="number" class="form-control" v-model="ofertaProveedor" />
            </div>

            <button
              type="button"
              v-if="idProveedor == 0"
              class="btn btn-primary mt-3"
              @click="CrearProveedor()"
            >
              Crear Proveedor
            </button>
            <button
              type="button"
              v-if="idProveedor != 0"
              class="btn btn-primary mt-3"
              @click="ActualizarProveedor()"
            >
              Actualizar Proveedor
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
let url = "https://6201fa36b8735d00174cb682.mockapi.io/proveedor/";

export default {
  data() {
    return {
      proveedors: [],
      modalTitulo: "",
      idProveedor: 0,
      nombresProveedor: "",
      codProveedor: "",
      direProveedor: "",
      cantiProveedor: "",
      montoProveedor: "",
      descProveedor: "",
      ofertaProveedor: "",
    };
  },
  mounted() {
    this.getAPI();
  },
  methods: {
    getAPI() {
      axios
        .get(url)
        .then((response) => response.data)
        .then((json) => {
          this.proveedors = json;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    AddButton() {
      this.modalTitulo = "Añadir Proveedor";
      this.idProveedor = 0;
      this.nombresProveedor = "";
      this.codProveedor = "";
      this.direProveedor = "";
      this.cantiProveedor = "";
      this.montoProveedor = "";
      this.descProveedor = "";
      this.ofertaProveedor = "";
    },
    CrearProveedor() {
      axios
        .post(url, {
          nombres: this.nombresProveedor,
          codigo: this.codProveedor,
          direccion: this.direProveedor,
          cantidad: this.cantiProveedor,
          monto: this.montoProveedor,
          descuento: this.descProveedor,
          oferta: this.ofertaProveedor,
        })
        .then((response) => {
          alert(
            "Proveedor " +
              response.data.nombres +
              " ha sido registrado con éxito!"
          );
          this.getAPI();
        })
        .catch((err) => {
          console.log(err);
        });
    },
    EditButton(proveedor) {
      this.modalTitulo = "Editar Proveedor";
      this.idProveedor = proveedor.id;
      this.nombresProveedor = proveedor.nombres;
      this.codProveedor = proveedor.codigo;
      this.direProveedor = proveedor.direccion;
      this.cantiProveedor = proveedor.cantidad;
      this.montoProveedor = proveedor.monto;
      this.descProveedor = proveedor.descuento;
      this.ofertaProveedor = proveedor.oferta;
    },
    ActualizarProveedor() {
      axios
        .put(url + this.idProveedor, {
          nombres: this.nombresProveedor,
          codigo: this.codProveedor,
          direccion: this.direProveedor,
          cantidad: this.cantiProveedor,
          monto: this.montoProveedor,
          descuento: this.descProveedor,
          oferta: this.ofertaProveedor,
        })
        .then((response) => {
          alert(
            "Proveedor " +
              response.data.nombres +
              " ha sido actualizado con éxito!"
          );
          this.getAPI();
        })
        .catch((err) => {
          console.log(err);
        });
    },
    EliminarProveedor(proveedor) {
      if (!confirm("¿Está seguro de eliminar el proveedor?")) {
        return;
      }

      axios.delete(url + proveedor.id).then((response) => {
        this.getAPI();
        alert("Proveedor ha sido eliminado con éxito!");
      });
    },
  },
};
</script>

<style>
</style>