<template>
  <div>
    <div class="container my-5 w-50">
      <div class="btn-group btn-c" role="group">
        <router-link to="/cliente" class="btn btn-secondary">Clientes</router-link>
        <router-link to="/producto" class="btn btn-secondary">Productos</router-link>
        <router-link to="/admin" class="btn btn-secondary">Administrador</router-link>
        <router-link to="/proveedor" class="btn btn-secondary">Proveedores</router-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style scoped>
.main-wrapper {
  height: 100vh;
}
.btn-c {
  margin-top: 4px;
  margin-bottom: 4px;
  display: flex;
  flex-wrap: wrap;
}
</style>