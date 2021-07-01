<template>
  <div class="container">
    <h1>Tour</h1>
    <div class="center" v-if="!loaded">
      <div class="preloader-wrapper small active">
        <div class="spinner-layer spinner-red-only">
          <div class="circle-clipper left">
            <div class="circle"></div>
          </div>
          <div class="gap-patch">
            <div class="circle"></div>
          </div>
          <div class="circle-clipper right">
            <div class="circle"></div>
          </div>
        </div>
      </div>
    </div>
    <div v-else>
      <div class="row">
        <div class="col m5"></div>
        <div class="col m4">
          <router-link :to="{ name: 'create-tour' }" class="btn grey"
            >Create Tour</router-link
          >
        </div>
      </div>
      <br />

      <table class="striped highlight responsive-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Country</th>
            <th>State</th>
            <th>Radio Station</th>
            <th>Program Date</th>
            <th>Program Time</th>
            <th>Period</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="tour in tours" :key="tour.id">
            <td>{{ tour.id }}</td>
            <td>{{ tour.country }}</td>
            <td>{{ tour.state }}</td>
            <td>{{ tour.stateRadioStation }}</td>
            <td>{{ tour.programDate }}</td>
            <td>{{ tour.programTime }}</td>
            <td>{{ tour.period }}</td>
            <td>
              <router-link
                :to="{ name: 'edit-tour', params: { id: tour.id } }"
                class="btn cyan pulse"
                ><i class="material-icons">edit</i></router-link
              >
            </td>
            <td>
              <button
                class="btn red"
                :disabled="saving"
                @click.prevent="deleteTour(tour.id)"
              >
                <i class="material-icons">delete</i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      loaded: false,
      saving: false,
      tours: [],
    };
  },
  created() {
    let uri = "/api/tour";
    this.axios
      .get(uri)
      .then((response) => {
        setTimeout(() => {
          this.loaded = true;
          this.tours = response.data.data;
        }, 5000);
      })
      .catch((err) => console.log(err));
  },
  methods: {
    deleteTour(id) {
      this.saving = true;
      let uri = `/api/delTour/${id}`;
      this.axios
        .delete(uri)
        .then((response) => {
          this.tours.splice(
            this.tours.findIndex((tour) => tour.id === id),
            1
          );
        })
        .catch((err) => {
          console.log(err);
          // this.$router.push({ name: '404' });
        })
        .then((this.saving = false));
    },
  },
};
</script>