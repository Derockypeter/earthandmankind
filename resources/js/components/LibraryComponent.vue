<template>
    <div class="container">
        <div class="articles">
            <div class="main-container">
                <div class="center" v-if="!loaded" style="height:500px">
                    <div
                        style="top:250px"
                        class="preloader-wrapper small active"
                    >
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
                    <section class="library-banner">
                        <h1>Books</h1>
                        <p class="lead">
                            <!-- Our Wealth of books and videos to feed your mind with daily motivation and guidance. -->
                        </p>
                    </section>
                    <div id="books">
                        <section class="books">
                            <div class="row">
                                <div
                                    class="col s12 l2 divStyle"
                                    v-for="book in books"
                                    :key="book.id"
                                >
                                    <router-link
                                        :to="{
                                            name: 'mybook',
                                            params: {
                                                bookname: book.name
                                            }
                                        }"
                                    >
                                        <div>
                                            <img
                                                :src="
                                                    '/books/images/' +
                                                        book.image
                                                "
                                                height="200"
                                                class="responsive-img"
                                            />
                                            <p class="librarysect">
                                                {{ book.name.substr(0, 40) }}
                                            </p>

                                            <!-- <p class="uppercase" :title="'Written in ' + book.language.language " >
                                                <em
                                                    >
                                                    {{
                                                        book.language.language
                                                    }}</em
                                                >
                                                <span
                                                    class="right green-text"
                                                    v-show="book.amount"
                                                    >Get a copy for &#36;{{
                                                        book.amount
                                                    }}</span
                                                >
                                            </p> -->
                                            <!-- <h6 class="grey-text">
                                                {{ book.description.substr(0, 50) }}...
                                            </h6> -->
                                            <!-- <a
                                                class="btn btn-small downloadBook waves waves-effect grey darken-4" :href="'books/preview/'+book.preview"
                                                >Preview</a
                                            > -->
                                        </div>
                                    </router-link>
                                </div>
                                <div
                                    v-if="books.length == 0"
                                    style="color: grey; font-size: 30px; text-align: center;"
                                >
                                    <marquee>Books Are on The Way</marquee>
                                </div>
                            </div>
                        </section>
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
            loaded: false,
            books: []
        };
    },
    mounted() {
        this.getBooks();
    },
    methods: {
        getBooks() {
            let book_uri = "/api/books";
            this.axios
                .get(book_uri)
                .then(response => {
                    setTimeout(() => {
                        this.loaded = true;
                        this.books = response.data;
                    }, 2000);
                })
                .catch(err => {});
        }
    }
};
</script>
<style scoped>
.articles {
    margin-top: 2vh;
    box-shadow: 13px 13px 20px grey;
}
.library-banner h1 {
    margin: 1.5rem 0rem;
}
.tabs .tab a,
.tabs .tab a:hover,
.tabs .tab a.active {
    background-color: grey;
    color: #f1e8e8;
}
.tabsCol {
    padding: 0px;
}
.bold {
    font-weight: bold;
}
.coursename {
    font-size: 24px;
    text-transform: capitalize;
}
.card
    .card-action
    span:not(.btn):not(.btn-large):not(.btn-small):not(.btn-large):not(.btn-floating) {
    margin-right: 24px;
    transition: color 0.3s ease;
    text-transform: uppercase;
}
.material-icons {
    font-size: 18px;
}
.column3 {
    float: left;
    width: 20%;
    padding: 5px;
    background-color: rgb(253, 253, 253);
}
@media screen and (max-width: 500px) {
    .column3 {
        width: 100%;
    }
}
a {
    color: rgb(46, 45, 45);
}
.librarysect {
    font-weight: 600;
}
</style>
