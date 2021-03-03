import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from '../views/Login.vue'
import Dashboard from '../views/Dashboard.vue'

Vue.use(VueRouter)

const routes = [
  // {
  //   path: '/',
  //   name: 'Home',
  //   component: Home
  // },
  {
    path: '/connexion',
    name: 'Login',
    component: Login
  },
  {
    path: '/tableau-de-bord',
    name: 'Dashboard',
    component: Dashboard,
    meta: { requiresAuth: true }
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

router.beforeEach((to, from, next) => {
  if(to.matched.some(record => record.meta.requiresAuth)) {
    //check if user is connected
    // if connected : next()
    // if not connected : next('/connexion')
  } else {
    next()
  }
})

export default router
