<template>
  <v-app>
    <navbar v-if="$route.name != 'Login'" />
    <router-view></router-view>
  </v-app>
</template>

<script>

import navbar from './components/_navbar.vue'

export default {
  name: 'App',

  components: {
    navbar
  },

  data: () => ({
    
  }),

  methods: {
    
  },

  created: function() {
    let that = this

    this.$axios.interceptors.response.use(undefined, function(error) {
      return new Promise(function () {
        if (error.response.status === 401) {
          that.$store.dispatch('logout')
          .then(() => {
            that.$router.push('/connexion')
          })
        }
        throw error;
      })
    })
  }
};
</script>
