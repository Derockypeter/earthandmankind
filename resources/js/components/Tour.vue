<template>
  <div class="container">
    <div class="articles">
      <div class="main-container">
        <!-- <div class="center" v-if="!loaded" style="height: 500px">
          <div style="top: 250px" class="preloader-wrapper small active">
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
        </div> -->
        <!-- v-else -->
        <div>
          <div class="row cont1">
            <div class="col s12">
              <div class="card dark-grey darken-1 hoverable">
                <div class="card-content dark-text">
                  <h2 class="header">Tours</h2>
                  <table>
                    <thead>
                      <tr>
                        <th>Country</th>
                        <th>State</th>
                        <th>Radio Station of State</th>
                        <th>Date</th>
                        <th>Time</th>
                      </tr>
                    </thead>

                    <tbody>
                      <tr v-for="tour in tours" :key="tour.period">
                        <td>{{ tour.country }}</td>
                        <td>{{ tour.state }}</td>
                        <td>{{ tour.stateRadioStation }}</td>
                        <td>{{ tour.programDate }}</td>
                        <td>{{ tour.programTime }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="card-action">
                  <ul class="pagination">
                    <li
                      class="page-item"
                      v-for="(links, i) in pagination.links"
                      :key="i"
                      :class="[
                        {
                          disabled: links.active || links.url === null,
                        },
                      ]"
                    >
                      <a
                        v-html="links.label"
                        class="page-link text-dark"
                        href="#"
                        :class="[
                          {
                            blue: links.active,
                          },
                        ]"
                        @click="getTours(links.url)"
                      >
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      //   loaded: false,
      pagination: "",
      tours: [],
      loadPage: true,
    };
  },
  mounted() {
    this.getTours();
  },
  methods: {
    // getTours() {
    //   this.axios
    //     .get("/api/tour")
    //     .then((response) => {
    //       setTimeout(() => {
    //         this.tours = response.data.data;
    //         this.loaded = !this.loaded;
    //       }, 2000);
    //     })
    //     .catch((err) => console.log(err));
    // },
    getTours(page_url) {
      let vm = this;
      page_url = page_url || "/api/tour";
      this.loadPage = true;
      this.axios
        .get(page_url)
        .then((response) => {
          this.tours = response.data.data;
          vm.makePagination(response.data);
          this.loadPage = false;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    makePagination(responses) {
      let pagination = {
        current_page: responses.current_page,
        first_page_url: responses.first_page_url,
        next_page_url: responses.next_page_url,
        from: responses.from,
        prev_page_url: responses.prev_page_url,
        to: responses.to,
        per_page: responses.per_page,
        last_page: responses.last_page,
        path: responses.path,
        links: responses.links,
      };
      // pagination.links.forEach(element => {
      //     pagination.links = element.label.replace(/&([a-z0-9]+|#[0-9]{1,6}|#x[0-9a-fA-F]{1,6});/ig);

      // console.log(pagination.links);
      this.pagination = pagination;
      // });
    },
  },
};
</script>
<style scoped>
</style>
