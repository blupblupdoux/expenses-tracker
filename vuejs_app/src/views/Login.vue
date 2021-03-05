<template>
<v-main class="align-center">
  <v-col cols="10" class="mx-auto">
    <v-row>
      <v-col cols="7" class="pr-15">
          <v-img src="../assets/calculator.svg"></v-img>
      </v-col>

      <v-col cols="5" class="d-flex flex-column justify-center pl-16">
        <div>
          <h1 class="primary--text mb-5">Connexion</h1>
        </div>
        <div>
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
                <v-btn type="submit" class="primary white--text">Se connecter</v-btn>
                <v-alert v-if="connectionError" type="error" max-width="400px" class="ml-3" dense>Echec de la connexion, veuillez recommencer.</v-alert>
              </div>
          </v-form>
        </div>
      </v-col>
    </v-row>
  </v-col>
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
