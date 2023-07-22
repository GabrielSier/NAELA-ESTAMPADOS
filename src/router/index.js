import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/cliente',
    name: 'ClienteView',
    component: () => import('../views/ClienteView.vue')
  },
  {
    path: '/producto',
    name: 'ProductoView',
    component: () => import('../views/ProductoView.vue')
  },
  {
    path: '/admin',
    name: 'AdminView',
    component: () => import('../views/AdminView.vue')
  },
  {
    path: '/proveedor',
    name: 'ProveedorView',
    component: () => import('../views/ProveedorView.vue')
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
