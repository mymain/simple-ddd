<template>
  <v-container>
    <Dialog/>
  </v-container>
  <v-container>
    <v-data-table
        v-model:items-per-page="itemsPerPage"
        :headers="headers"
        :items="cars"
        item-value="name"
        class="elevation-1"
    ></v-data-table>
  </v-container>
</template>

<script setup>
  import { VDataTable } from 'vuetify/labs/VDataTable'
</script>

<script>
import Dialog from './Dialog.vue'
import axios from 'axios'
export default {
  components () {
    Dialog
  },
  data () {
    return {
      itemsPerPage: 5,
      cars: [],
      headers: [
        {
          title: 'Lp.',
          align: 'start',
          sortable: false,
          key: 'id',
        },
        { title: 'Nr rejestracyjny', align: 'end', key: 'registrationNumber' },
        { title: 'Model', align: 'end', key: 'model' },
        { title: 'Marka', align: 'end', key: 'mark' },
        { title: 'Data utworzenia', align: 'end', key: 'createdAt' },
        { title: 'Data modyfikacji', align: 'end', key: 'updatedAt' },
      ],
    }
  },
  methods: {
    getData() {
      return axios
          .get('/api/car/list', {
            dataType: 'json',
          })
          .then((response) => {
            this.cars = response.data;
          })
          .catch((err) => alert(err));
    },
  },
  mounted() {
    this.getData();
  },
}
</script>