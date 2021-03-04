<template>
<v-main>
    <v-col>
        <p>an image</p>
    </v-col>

    <v-col>
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

          <v-btn type="submit">Se connecter</v-btn>
      </v-form>
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
  rules: {
    require: v => !!v || 'The field is required',
    email: v => /.+@.+\..+/.test(v) || 'The email must be valid'
  }
}),

methods: {
  onSubmit() {
    if(this.$refs.form.validate()) {
      this.$store.dispatch('login', this.credentials)
    }
  }
}
};
</script>
