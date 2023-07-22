<template>
  <div class="home">
    <NavBar/>
    <HeadButtons/>
    <Footer/>
  </div>
</template>

<script>
// @ is an alias to /src
import NavBar from '@/components/NavBar.vue'
import HeadButtons from '@/components/HeadButtons.vue'
import Footer from '@/components/Footer.vue'

export default {
  name: 'Home',
  components: {
    NavBar,
    HeadButtons,
    Footer
  }
}
</script>
