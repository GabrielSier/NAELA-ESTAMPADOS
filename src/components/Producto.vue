<template>
  <div class="container">
    <button
      type="button"
      class="btn btn-success my-3 float-start"
      data-bs-toggle="modal"
      data-bs-target="#proModal"
      @click.prevent="AddButton()"
    >
      Añadir Producto
    </button>

    <table class="table table-warning table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Código</th>
          <th>Tipo</th>
          <th>Imagen</th>
          <th>Descripción</th>
          <th>Precio</th>
          <th>Oferta</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="producto in productos" :key="producto.id">
          <td>{{ producto.id }}</td>
          <td>{{ producto.codigo }}</td>
          <td>{{ producto.tipo }}</td>
          <td>{{ producto.imagen }}</td>
          <td>{{ producto.descripcion }}</td>
          <td>{{ producto.precio }}</td>
          <td>{{ producto.oferta }}</td>
          <td>
            <button
              type="button"
              class="btn btn-info mx-1 px-2"
              data-bs-toggle="modal"
              data-bs-target="#proModal"
              @click.prevent="EditButton(producto)"
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
              @click.prevent="EliminarProducto(producto)"
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
      id="proModal"
      tabindex="-1"
      aria-labelledby="proModalLabel"
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
              <span class="input-group-text">Código</span>
              <input type="text" class="form-control" v-model="codProducto" />
              <span class="input-group-text">Tipo</span>
              <input type="text" class="form-control" v-model="tipoProducto" />
            </div>
            <div class="input-group">
              <span class="input-group-text">Imagen</span>
              <input
                type="text"
                class="form-control"
                v-model="imagenProducto"
              />
              <span class="input-group-text">Descipción</span>
              <input type="text" class="form-control" v-model="descProducto" />
            </div>
            <div class="input-group">
              <span class="input-group-text">Precio</span>
              <input
                type="number"
                class="form-control"
                v-model="precioProducto"
              />
              <span class="input-group-text">Oferta</span>
              <input
                type="number"
                class="form-control"
                v-model="ofertaProducto"
              />
            </div>

            <button
              type="button"
              v-if="idProducto == 0"
              class="btn btn-primary mt-3"
              @click="CrearProducto()"
            >
              Crear Producto
            </button>
            <button
              type="button"
              v-if="idProducto != 0"
              class="btn btn-primary mt-3"
              @click="ActualizarProducto()"
            >
              Actualizar Producto
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
let url = "https://6201fa36b8735d00174cb682.mockapi.io/producto/";

export default {
  data() {
    return {
      productos: [],
      modalTitulo: "",
      idProducto: 0,
      codProducto: "",
      tipoProducto: "",
      imagenProducto: "",
      descProducto: "",
      precioProducto: 0,
      ofertaProducto: 0,
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
          this.productos = json;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    AddButton() {
      this.modalTitulo = "Añadir Producto";
      this.idProducto = 0;
      this.codProducto = "";
      this.tipoProducto = "";
      this.imagenProducto = "";
      this.descProducto = "";
      this.precioProducto = 0;
      this.ofertaProducto = 0;
    },
    CrearProducto() {
      axios
        .post(url, {
          codigo: this.codProducto,
          tipo: this.tipoProducto,
          imagen: this.imagenProducto,
          descripcion: this.descProducto,
          precio: this.precioProducto,
          oferta: this.ofertaProducto,
        })
        .then((response) => {
          alert(
            "Producto " +
              response.data.codigo +
              " ha sido registrado con éxito!"
          );
          this.getAPI();
        })
        .catch((err) => {
          console.log(err);
        });
    },
    EditButton(prod) {
      this.modalTitulo = "Editar Producto";
      this.idProducto = prod.id;
      this.codProducto = prod.codigo;
      this.tipoProducto = prod.tipo;
      this.imagenProducto = prod.imagen;
      this.descProducto = prod.descripcion;
      this.precioProducto = prod.precio;
      this.ofertaProducto = prod.oferta;
    },
    ActualizarProducto() {
      axios
        .put(url + this.idProducto, {
          codigo: this.codProducto,
          tipo: this.tipoProducto,
          imagen: this.imagenProducto,
          descripcion: this.descProducto,
          precio: this.precioProducto,
          oferta: this.ofertaProducto,
        })
        .then((response) => {
          alert(
            "Producto " +
              response.data.codigo +
              " ha sido actualizado con éxito!"
          );
          this.getAPI();
        })
        .catch((err) => {
          console.log(err);
        });
    },
    EliminarProducto(prod) {
      if(!confirm("¿Está seguro de eliminar el producto?")) {
        return;
      }

      axios.delete(url + prod.id).then((response) => {
        this.getAPI();
        alert("Producto ha sido eliminado con éxito!");
      });
    },
  },
};
</script>

<style>
</style>