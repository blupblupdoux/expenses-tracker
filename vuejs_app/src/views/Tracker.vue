<template>
<v-main>
  <h1>Tracker</h1>
  <v-row>
    <v-col>
      Income stats
    </v-col>
    <v-col>
      Expense stats
    </v-col>
  </v-row>
  <v-row>
    <v-data-table
    :headers="headers"
    :items="desserts"
    :items-per-page="5"
    class="elevation-1"
  ></v-data-table>
  </v-row>
</v-main>
</template>

<script>

export default {
name: 'Tracker',

components: {

},

data: () => ({

}),
};
</script>

<style lang="scss">
.row {
  margin: 0;
}
</style>
