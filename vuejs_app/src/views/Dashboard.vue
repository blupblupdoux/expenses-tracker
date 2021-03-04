<template>
  <v-main>
      dash
      <v-btn @click="logout"></v-btn>
  </v-main>
</template>

<script>

export default {
  name: 'Dashboard',

  components: {
    
  },

  data: () => ({
    
  }),

  methods : {
    logout() {
      this.$store.dispatch('logout')
        .then(() => {
          this.$router.push('/connexion')
        })
    }
  }
};
</script>
