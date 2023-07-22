<template>
  <div class="adminView">
    <NavBar/>
    <HeadButtons/>
    <Admin/>
    <Footer/>
  </div>
</template>

<script>

import NavBar from '@/components/NavBar.vue'
import HeadButtons from '@/components/HeadButtons.vue'
import Admin from '@/components/Admin.vue'
import Footer from '@/components/Footer.vue'

export default {
  name: 'AdminView',
  components: {
    NavBar,
    HeadButtons,
    Admin,
    Footer
  }
}
</script>