<template>
  <div class="productoView">
    <NavBar/>
    <HeadButtons/>
    <Producto/>
    <Footer/>
  </div>
</template>

<script>

import NavBar from '@/components/NavBar.vue'
import HeadButtons from '@/components/HeadButtons.vue'
import Producto from '@/components/Producto.vue'
import Footer from '@/components/Footer.vue'

export default {
  name: 'ProductoView',
  components: {
    NavBar,
    HeadButtons,
    Producto,
    Footer
  }
}
</script>