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
                <div class="col s12 l9">
                    <table class="striped highlight responsive-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Language</th>
                                <th>Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="book in books" :key="book.id">
                                <td>{{ book.id }}</td>
                                <td>{{ book.name }}</td>
                                <td>{{ book.description }}</td>
                                <td>{{ book.language.language }}</td>
                                <td>
                                    <img :src="'/books/images/' + book.image" />
                                </td>
                                <td>
                                    <router-link
                                        :to="{
                                            name: 'edit-book',
                                            params: { id: book.id }
                                        }"
                                        class="btn cyan pulse"
                                        ><i class="material-icons"
                                            >edit</i
                                        ></router-link
                                    >
                                </td>
                                <td>
                                    <button
                                        class="btn red"
                                        :disabled="saving"
                                        @click.prevent="deleteBook(book.id)"
                                    >
                                        <i class="material-icons">delete</i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
                    this.books = response.data.data;
                }, 5000);
            })
            .catch(err => console.error.response.data.data);
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
