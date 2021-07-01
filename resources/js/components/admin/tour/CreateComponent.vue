<template>
  <div class="container">
    <div class="articles">
      <div class="main-container">
        <center>
          <div class="row">
            <div class="col s12 m6 crad">
              <div class="card white-grey lighten-1">
                <div class="card-content dark-text">
                  <span class="card-title">Create a New Tour</span>
                  <div v-if="message" class="alert">{{ message }}</div>

                  <form @submit="addTour">
                    <div class="row">
                      <div class="input-field col s12">
                        <input
                          placeholder="Enter country"
                          v-model="tour.country"
                          required
                          type="text"
                          class="validate"
                        />
                      </div>
                      <div class="input-field col s12">
                        <input
                          placeholder="Enter state"
                          v-model="tour.state"
                          required
                          type="text"
                          class="validate"
                        />
                      </div>
                      <div class="input-field col s12">
                        <input
                          placeholder="Enter Name of radio station ABS-92.9"
                          v-model="tour.stateRadioStation"
                          required
                          type="text"
                          class="validate"
                        />
                      </div>
                      <div class="input-field col s12">
                        <input
                          placeholder="Enter Days program will last here eg 7"
                          v-model="tour.period"
                          required
                          type="text"
                          class="validate"
                        />
                      </div>
                      <div class="col s12">
                        <div>
                          <date-picker
                            v-model="tour.programDate"
                            valueType="format"
                          ></date-picker>
                        </div>
                      </div>
                      <div class="input-field col s12">
                        <div class="col s12">
                          <div>
                            <date-picker
                              v-model="tour.programTime"
                              format="hh:mm a"
                              value-type="format"
                              type="time"
                              placeholder="hh:mm a"
                            ></date-picker>
                          </div>
                        </div>
                      </div>
                      <div class="col s12">
                        <button
                          type="submit"
                          :disabled="creating"
                          class="btn waves-effect"
                        >
                          {{ creating ? "Creating..." : "Create" }}
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </center>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      // components: { DatePicker },
      tour: {
        country: "",
        state: "",
        stateRadioStation: "",
        programTime: "",
        programDate: "",
        period: "",
      },
      time1: null,
      time2: null,
      time3: null,

      creating: false,
      message: false,
    };
  },
  created() {},
  methods: {
    addTour(evt) {
      evt.preventDefault();
      this.creating = true;
      let uri = "/api/tour/";
      this.axios
        .post(uri, this.tour)
        .then((response) => {
          M.toast({ html: "Tour created" });
          this.$router.push({ name: "admin" }).catch(() => {});
        })
        .catch((err) => {
          this.message = err.response.data || "Error encountered";
          this.creating = false;
        });
    },
  },
};
</script>
<style scoped>
div.crad {
  margin: auto;
  width: 60%;
  padding: 10px;
}
</style>