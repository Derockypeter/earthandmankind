<template>
  <main>
    <div class="hide-on-large-only">
      <div class="banner">
        <img
          src="/images/background-logo/background_logo.jpg"
          alt="site logo"
          width="100%"
          height="490px"
          class="responsive-img"
        />
      </div>
    </div>

    <div class="container">
      <div class="banner hide-on-med-and-down">
        <img
          src="/images/background-logo/background_logo.jpg"
          alt="site logo"
          class="responsive-img"
        />
      </div>
      <div class="row">
        <div class="col s12" style="padding-top: 30px">
          <p class="lead">
            In the knowledge of the fact that “death is not the opposite of
            life; Rather death is the opposite of God”, lies the help mankind
            seeks from God.
          </p>
          <p>
            From the inception of the life of mankind on earth, the fate of the
            living state of mankind has always depended on the effect of the
            known knowledge or integrated consciousness of God by the parent, up
            on till the newly reproduced off springs; integrates more
            consciousness or knows more knowledge of God, according to their
            intake capacity; Life therefore advances. Life has continued thus,
            up on till this state of life on earth and will continue thus till
            the fulfillment of the purpose of life.
          </p>
        </div>
      </div>
      <div class="row" v-if="books.length >= 1">
        <h2 class="header">Books</h2>
        <div class="col s12 m6 l4" v-for="book in books" :key="book.id">
          <div class="card horizontal">
            <div class="card-image">
              <img
                :src="'/books/images/' + book.image"
                height="200"
                class="responsive-img"
              />
            </div>
            <div class="card-stacked">
              <div class="card-content">
                <p>{{ book.description.substr(0, 40) }}...</p>
              </div>
              <div class="card-action">
                <router-link
                  :to="{
                    name: 'mybook',
                    params: {
                      bookname: book.name,
                    },
                  }"
                >
                  <div>
                    <p class="librarysect">
                      {{ book.name.substr(0, 40) }}
                    </p>
                  </div>
                </router-link>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row cont1" v-if="tours.length >= 1">
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
                  <tr v-for="tour in tours" :key="tour.id">
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
              <router-link :to="{name: 'tour'}">View More</router-link>
            </div>
          </div>
        </div>
      </div>
     
    </div>
  </main>
</template>
<style scoped>
.banner.hide-on-med-and-down img {
  /* margin-top: 1vh; */
  width: 100%;
  height: 550px;
}

</style>
<script>
export default {
  props: [],
  data() {
    return {
      books: [],
      tours: [],
    };
  },
  mounted() {
    M.AutoInit();
    this.getBooks();
    this.getTours();
  },
  methods: {
    getBooks() {
      let book_uri = "/api/books";
      this.axios
        .get(book_uri)
        .then((response) => {
          // setTimeout(() => {
          this.books = response.data;
          // }, 2000);
        })
        .catch((err) => {});
    },
    getTours() {
      this.axios
        .get("/api/tour/10")
        .then((response) => {
          // setTimeout(() => {
          this.tours = response.data;
          // }, 5000);
        })
        .catch((err) => console.log(err));
    },
  },
};
</script>
