<template>
  <div class="container">
    <button
      type="button"
      class="btn btn-success my-3 float-start"
      data-bs-toggle="modal"
      data-bs-target="#cliModal"
      @click.prevent="AddButton()"
    >
      Añadir Cliente
    </button>

    <table class="table table-info table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Nombres</th>
          <th>Identificación</th>
          <th>Email</th>
          <th>Municipio</th>
          <th>Dirección</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="cliente in clientes" :key="cliente.id">
          <td>{{ cliente.id }}</td>
          <td>{{ cliente.nombre }}</td>
          <td>{{ cliente.identificacion }}</td>
          <td>{{ cliente.email }}</td>
          <td>{{ cliente.municipio }}</td>
          <td>{{ cliente.direccion }}</td>
          <td>
            <button
              type="button"
              class="btn btn-info mx-1 px-2"
              data-bs-toggle="modal"
              data-bs-target="#cliModal"
              @click.prevent="EditButton(cliente)"
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
              @click.prevent="EliminarCliente(cliente)"
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
      id="cliModal"
      tabindex="-1"
      aria-labelledby="cliModalLabel"
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
              <span class="input-group-text">Nombre</span>
              <input type="text" class="form-control" v-model="nombreCliente" />
              <span class="input-group-text">Identificación</span>
              <input type="text" class="form-control" v-model="identiCliente" />
            </div>
            <div class="input-group">
              <span class="input-group-text">Email</span>
              <input
                type="text"
                class="form-control"
                v-model="emailCliente"
              />
              <span class="input-group-text">Contraseña</span>
              <input type="password" class="form-control" v-model="passCliente" />
            </div>
            <div class="input-group">
              <span class="input-group-text">Municipio</span>
              <input
                type="text"
                class="form-control"
                v-model="muniCliente"
              />
              <span class="input-group-text">Dirección</span>
              <input
                type="text"
                class="form-control"
                v-model="direCliente"
              />
            </div>

            <button
              type="button"
              v-if="idCliente == 0"
              class="btn btn-primary mt-3"
              @click="CrearCliente()"
            >
              Crear Cliente
            </button>
            <button
              type="button"
              v-if="idCliente != 0"
              class="btn btn-primary mt-3"
              @click="ActualizarCliente()"
            >
              Actualizar Cliente
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
let url = "https://6201fa36b8735d00174cb682.mockapi.io/cliente/";

export default {
  data() {
    return {
      clientes: [],
      modalTitulo: "",
      idCliente: 0,
      nombreCliente: "",
      identiCliente: "",
      emailCliente: "",
      passCliente: "",
      muniCliente: "",
      direCliente: "",
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
          this.clientes = json;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    AddButton() {
      this.modalTitulo = "Añadir Cliente";
      this.idCliente = 0;
      this.nombreCliente = "";
      this.identiCliente = "";
      this.emailCliente = "";
      this.passCliente = "";
      this.muniCliente = "";
      this.direCliente = "";
    },
    CrearCliente() {
      axios
        .post(url, {
          nombre: this.nombreCliente,
          identificacion: this.identiCliente,
          email: this.emailCliente,
          password: this.passCliente,
          municipio: this.muniCliente,
          direccion: this.direCliente,
        })
        .then((response) => {
          alert(
            "Cliente " +
              response.data.nombre +
              " ha sido registrado con éxito!"
          );
          this.getAPI();
        })
        .catch((err) => {
          console.log(err);
        });
    },
    EditButton(clien) {
      this.modalTitulo = "Editar Cliente";
      this.idCliente = clien.id;
      this.nombreCliente = clien.nombre;
      this.identiCliente = clien.identificacion;
      this.emailCliente = clien.email;
      this.muniCliente = clien.municipio;
      this.direCliente = clien.direccion;
    },
    ActualizarCliente() {
      axios
        .put(url + this.idCliente, {
          nombre: this.nombreCliente,
          identificacion: this.identiCliente,
          email: this.emailCliente,
          municipio: this.muniCliente,
          direccion: this.direCliente,
        })
        .then((response) => {
          alert(
            "Cliente " +
              response.data.nombre +
              " ha sido actualizado con éxito!"
          );
          this.getAPI();
        })
        .catch((err) => {
          console.log(err);
        });
    },
    EliminarCliente(clien) {
      if(!confirm("¿Está seguro de eliminar el cliente?")) {
        return;
      }

      axios.delete(url + clien.id).then((response) => {
        this.getAPI();
        alert("Cliente ha sido eliminado con éxito!");
      });
    },
  },
};
</script>

<style>
</style>