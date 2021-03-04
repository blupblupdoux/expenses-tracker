<template>
  <v-app>
    <router-view></router-view>
  </v-app>
</template>

<script>

export default {
  name: 'App',

  components: {
    
  },

  data: () => ({
    
  }),

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
