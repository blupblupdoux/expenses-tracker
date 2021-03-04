import Vue from 'vue'
import App from './App.vue'
import Axios from 'axios'
import router from './router'
import store from './store'
import vuetify from './plugins/vuetify';

Vue.config.productionTip = false
Vue.prototype.$axios = Axios;

// Keep token in headers
let token = localStorage.getItem('user-token')
if (token) {
  Vue.prototype.$axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
}

new Vue({
  router,
  store,
  vuetify,
  render: h => h(App)
}).$mount('#app')
