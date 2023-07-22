<template>
  <div class="proveedorView">
    <NavBar/>
    <HeadButtons/>
    <Proveedor/>
    <Footer/>
  </div>
</template>

<script>

import NavBar from '@/components/NavBar.vue'
import HeadButtons from '@/components/HeadButtons.vue'
import Proveedor from '@/components/Proveedor.vue'
import Footer from '@/components/Footer.vue'

export default {
  name: 'ProveedorView',
  components: {
    NavBar,
    HeadButtons,
    Proveedor,
    Footer
  }
}
</script>