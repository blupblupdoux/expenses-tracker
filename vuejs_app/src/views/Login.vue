<template>
<v-main>
    <v-col>
        <p>an image</p>
    </v-col>

    <v-col>
      <h1>Connexion</h1>
      <v-form>
          <v-text-field
            v-model="credentials.email"
            label="Email"
            required
          >
          </v-text-field>

          <v-text-field
            v-model="credentials.password"
            label="Mot de passe"
            required
          >
          </v-text-field>

          <v-btn>Se connecter</v-btn>
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
  credentials: {email: '', password: ''}
}),
};
</script>
