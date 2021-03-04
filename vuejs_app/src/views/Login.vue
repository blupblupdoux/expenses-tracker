<template>
<v-main>
  <v-row>
    <v-col cols="6">
        <p>an image</p>
    </v-col>

    <v-col cols="6">
      <h1>Connexion</h1>
      <v-form @submit.prevent="onSubmit" ref="form">
          <v-text-field
            v-model="credentials.email"
            label="Email"
            :rules="[rules.require, rules.email]"
            required
          >
          </v-text-field>

          <v-text-field
            v-model="credentials.password"
            label="Mot de passe"
            :rules="[rules.require]"
            required
          >
          </v-text-field>

          <div class="d-flex">
            <v-btn type="submit">Se connecter</v-btn>
            <v-alert v-if="connectionError" type="error" max-width="400px" class="ml-3" dense>Echec de la connexion, veuillez recommencer.</v-alert>
          </div>
      </v-form>
    </v-col>
  </v-row>
</v-main>
</template>

<script>

export default {
name: 'Login',

components: {
  
},

data: () => ({
  credentials: {email: '', password: ''},
  connectionError : false,
  rules: {
    require: v => !!v || 'The field is required',
    email: v => /.+@.+\..+/.test(v) || 'The email must be valid'
  }
}),

methods: {
  onSubmit() {
    if(this.$refs.form.validate()) {
      this.$store.dispatch('login', this.credentials)
        .then(() => {
          this.$router.push('/tableau-de-bord')
        })
        .catch(error => {
          this.connectionError = true
          console.error(error)
        })
    }
  }
}
};
</script>
