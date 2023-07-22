<template>
  <div class="container">
    <button
      type="button"
      class="btn btn-success my-3 float-start"
      data-bs-toggle="modal"
      data-bs-target="#admModal"
      @click.prevent="AddButton()"
    >
      Añadir Administrador
    </button>

    <table class="table table-secondary table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Nombres</th>
          <th>Identificación</th>
          <th>Email</th>
          <th>Dirección</th>
          <th>Código</th>
          <th>Turno</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="admin in admins" :key="admin.id">
          <td>{{ admin.id }}</td>
          <td>{{ admin.nombres }}</td>
          <td>{{ admin.identificacion }}</td>
          <td>{{ admin.email }}</td>
          <td>{{ admin.direccion }}</td>
          <td>{{ admin.codigo }}</td>
          <td>{{ admin.turno }}</td>
          <td>
            <button
              type="button"
              class="btn btn-info mx-1 px-2"
              data-bs-toggle="modal"
              data-bs-target="#admModal"
              @click.prevent="EditButton(admin)"
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
              @click.prevent="EliminarAdmin(admin)"
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
      id="admModal"
      tabindex="-1"
      aria-labelledby="admModalLabel"
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
              <input type="text" class="form-control" v-model="nombresAdmin" />
              <span class="input-group-text">Identificación</span>
              <input type="text" class="form-control" v-model="identiAdmin" />
            </div>
            <div class="input-group">
              <span class="input-group-text">Email</span>
              <input
                type="text"
                class="form-control"
                v-model="emailAdmin"
              />
              <span class="input-group-text">Contraseña</span>
              <input type="password" class="form-control" v-model="passAdmin" />
            </div>
            <div class="input-group">
              <span class="input-group-text">Dirección</span>
              <input
                type="text"
                class="form-control"
                v-model="direAdmin"
              />
              <span class="input-group-text">Código</span>
              <input
                type="text"
                class="form-control"
                v-model="codAdmin"
              />
            </div>
            <div class="input-group">
              <span class="input-group-text">Turno</span>
              <input
                type="text"
                class="form-control"
                v-model="turnoAdmin"
              />
            </div>

            <button
              type="button"
              v-if="idAdmin == 0"
              class="btn btn-primary mt-3"
              @click="CrearAdmin()"
            >
              Crear Administrador
            </button>
            <button
              type="button"
              v-if="idAdmin != 0"
              class="btn btn-primary mt-3"
              @click="ActualizarAdmin()"
            >
              Actualizar Administrador
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
let url = "https://6201fa36b8735d00174cb682.mockapi.io/administrador/";

export default {
  data() {
    return {
      admins: [],
      modalTitulo: "",
      idAdmin: 0,
      nombresAdmin: "",
      identiAdmin: "",
      emailAdmin: "",
      passAdmin: "",
      codAdmin: "",
      direAdmin: "",
      turnoAdmin: "",
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
          this.admins = json;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    AddButton() {
      this.modalTitulo = "Añadir Administrador";
      this.idAdmin = 0;
      this.nombresAdmin = "";
      this.identiAdmin = "";
      this.emailAdmin = "";
      this.passAdmin = "";
      this.direAdmin = "";
      this.codAdmin = "";
      this.turnoAdmin = "";
    },
    CrearAdmin() {
      axios
        .post(url, {
          nombres: this.nombresAdmin,
          identificacion: this.identiAdmin,
          email: this.emailAdmin,
          password: this.passAdmin,
          direccion: this.direAdmin,
          codigo: this.codAdmin,
          turno: this.turnoAdmin,
        })
        .then((response) => {
          alert(
            "Administrador " +
              response.data.nombres +
              " ha sido registrado con éxito!"
          );
          this.getAPI();
        })
        .catch((err) => {
          console.log(err);
        });
    },
    EditButton(admin) {
      this.modalTitulo = "Editar Administrador";
      this.idAdmin = admin.id;
      this.nombresAdmin = admin.nombres;
      this.identiAdmin = admin.identificacion;
      this.emailAdmin = admin.email;
      this.direAdmin = admin.direccion;
      this.codAdmin = admin.codigo;
      this.turnoAdmin = admin.turno;
    },
    ActualizarAdmin() {
      axios
        .put(url + this.idAdmin, {
          nombres: this.nombresAdmin,
          identificacion: this.identiAdmin,
          email: this.emailAdmin,
          direccion: this.direAdmin,
          codigo: this.codAdmin,
          turno: this.turnoAdmin,
        })
        .then((response) => {
          alert(
            "Administrador " +
              response.data.nombres +
              " ha sido actualizado con éxito!"
          );
          this.getAPI();
        })
        .catch((err) => {
          console.log(err);
        });
    },
    EliminarAdmin(admin) {
      if(!confirm("¿Está seguro de eliminar el administrador?")) {
        return;
      }

      axios.delete(url + admin.id).then((response) => {
        this.getAPI();
        alert("Administrador ha sido eliminado con éxito!");
      });
    },
  },
};
</script>

<style>
</style>