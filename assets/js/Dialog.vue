<template>
  <div class="text-center">
    <v-dialog
        v-model="dialog"
        width="1024"
    >
      <template v-slot:activator="{ props }">
        <v-btn
            color="primary"
            v-bind="props"
        >
          Dodaj
        </v-btn>
      </template>

      <v-card>
        <v-card-title>
          <span class="text-h5">Utwórz samochód</span>
        </v-card-title>
        <v-card-text>
            <v-container>
              <v-row>
                <v-col
                    cols="12"
                    sm="6"
                    md="4"
                >
                  <v-text-field
                      label="Numer rejestracyjny*"
                      required
                      v-model="registrationNumber"
                  ></v-text-field>
                </v-col>
                <v-col
                    cols="12"
                    sm="6"
                    md="4"
                >
                  <v-text-field
                      label="Marka*"
                      required
                      v-model="mark"
                  ></v-text-field>
                </v-col>
                <v-col
                    cols="12"
                    sm="6"
                    md="4"
                >
                  <v-text-field
                      label="Model*"
                      v-model="model"
                      required
                  ></v-text-field>
                </v-col>
              </v-row>
            </v-container>
            <small>*pola wymagane</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
              color="red"
              @click="dialog = false"
          >
            Zamknij
          </v-btn>
          <v-btn
              color="green"
              @click="saveCar();"
          >
            Zapisz
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>
<script>
import axios from 'axios'
export default {
  methods: {
    saveCar() {
      axios.post(
          '/api/car/create',
          {
            'registrationNumber': this.registrationNumber,
            'mark': this.mark,
            'model': this.model,
          },
          {headers: {'content-type': 'application/x-www-form-urlencoded'}
      });

      this.resetData();

      this.dialog = false;
    },
    resetData() {
      this.registrationNumber = '';
      this.mark = '';
      this.model = '';
    }
  },
  data () {
    return {
      dialog: false,
      registrationNumber: '',
      mark: '',
      model: '',
    }
  },
}
</script>