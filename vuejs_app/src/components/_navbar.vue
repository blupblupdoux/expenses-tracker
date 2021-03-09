<template>
<v-navigation-drawer class="nav-drawer" width="auto" app>
  <div class="d-flex flex-column align-center mb-4">
    <v-avatar
      class="mt-8 mb-2"
      color="teal"
      size="48"
    >
      <span class="white--text headline">MM</span>
    </v-avatar>
    <p>{{ auth.user.name }}</p>
  </div>

  <v-list dense nav>
    <router-link v-for="item in nav_items" :key="item.label" :to="item.path">

      <v-list-item link>
        <v-list-item-icon class="mr-3">
          <v-icon>{{ item.icon }}</v-icon>
        </v-list-item-icon>

        <v-list-item-content class="pt-3 pr-3">
          <v-list-item-title>{{ item.label }}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

    </router-link>
  </v-list>
</v-navigation-drawer>
</template>

<script>

import {mapState} from 'vuex'

export default {
name: 'navbar',

data: () => ({
  nav_items: [
    {path: '/tableau-de-bord', label:'Tableau de bord', icon:'fa-home'},
    {path: '/tracker', label:'Tracker', icon:'fa-money'},
    {path: '/#', label:'Stats', icon:'fa-bar-chart'},
  ]
}),

computed : {
  ...mapState(['auth'])
},

methods : {

},

created() {
  console.log(this.auth)
}
};
</script>

<style lang="scss">
.nav-drawer {
		a {
			text-decoration: none;
		}
}
</style>