<template>
  <div class="clienteView">
    <NavBar/>
    <HeadButtons/>
    <Cliente/>
    <Footer/>
  </div>
</template>

<script>

import NavBar from '@/components/NavBar.vue'
import HeadButtons from '@/components/HeadButtons.vue'
import Cliente from '@/components/Cliente.vue'
import Footer from '@/components/Footer.vue'

export default {
  name: 'ClienteView',
  components: {
    NavBar,
    HeadButtons,
    Cliente,
    Footer
  }
}
</script>