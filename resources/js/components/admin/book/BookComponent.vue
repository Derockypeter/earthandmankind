<template>
    <div class="container">
        <h1>Books</h1>
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
                <div class="col m10"></div>
                <div class="col m2">
                    <router-link :to="{ name: 'create-book' }" class="btn grey"
                        >Create Book</router-link
                    >
                </div>
            </div>
            <br />
            <div class="row">
                <div
                    class="col s12 l4 m2 card"
                    v-for="book in books"
                    :key="book.id"
                >
                    <div
                        class="card-image waves-effect waves-block waves-light"
                    >
                        <img
                            class="activator"
                            :src="'/books/images/' + book.image"
                        />
                    </div>
                    <div class="card-content">
                        <span
                            class="card-title activator grey-text text-darken-4 font-1"
                            >{{ book.name.substr(0, 19)
                            }}<i class="material-icons right"
                                >more_vert</i
                            ></span
                        >
                        <p>
                            <router-link
                                :to="{
                                    name: 'edit-book',
                                    params: { id: book.id }
                                }"
                                class="btn cyan pulse"
                                ><i class="material-icons">edit</i></router-link
                            >
                            <button
                                class="btn red right"
                                :disabled="saving"
                                @click.prevent="deleteBook(book.id)"
                            >
                                <i class="material-icons">delete</i>
                            </button>
                        </p>
                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4"
                            >{{ book.name
                            }}<i class="material-icons right">close</i></span
                        >

                        <p>{{ book.description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped></style>
<script>
export default {
    data() {
        return {
            saving: false,
            loaded: false,
            books: []
        };
    },
    created() {
        let uri = "/api/books";
        this.axios
            .get(uri)
            .then(response => {
                setTimeout(() => {
                    this.loaded = true;
                    this.books = response.data;
                }, 5000);
            })
            .catch(err => console.log(error));
    },
    methods: {
        deleteBook(id) {
            this.saving = true;
            let uri = `/api/delBook/${id}`;
            this.axios
                .delete(uri)
                .then(response => {
                    M.toast({ html: "Book deleted" });
                    this.books.splice(
                        this.books.findIndex(book => book.id === id),
                        1
                    );
                    this.saving = false;
                })
                .catch(err => {
                    // this.$router.push({ name: '404' });
                    this.saving = false;
                });
        }
    }
};
</script>
