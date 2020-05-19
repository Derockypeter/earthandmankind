<template>
  <div class="container">
      <h1>Books</h1>
        <div class="row">
            <div class="col m10"></div>
            <div class="col m2">
                <router-link :to="{ name: 'create-book' }" class="btn grey">Create Book</router-link>
            </div>
        </div><br />

        <table class="striped highlight responsive-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Category</th>
                <th>Image</th>
            </tr>
            </thead>
            <tbody>
                <div v-if="! loaded">Loading...</div>
                <tr v-else v-for="book in books" :key="book.id">
                    <td>{{ book.id }}</td>
                    <td>{{ book.name }}</td>
                    <td>{{ book.description }}</td>
                    <td>{{ book.categoryName }}</td>
                    <td><img :src="'/books/images/'+book.image"></td>
                    <td><router-link :to="{name: 'edit-book', params: { id: book.id }}" class="btn cyan pulse"><i class="material-icons">edit</i></router-link></td>
                    <td><button class="btn red" :disabled="saving" @click.prevent="deleteBook(book.id)"><i class="material-icons">delete</i></button></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<style scoped>
 
 
</style>
<script>
import axios from 'axios'
    export default {
        data() {
            return {
                saving: false,
                loaded: false,
                books: [],
            }
        },
        created() {
            let uri = 'http://127.0.0.1:8000/api/books';
            axios.get(uri).then(response => {
                setTimeout(() => {
                    this.loaded = true;
                    this.books = response.data.data;
                }, 5000);
                console.log(response.data.data)
            })
            .catch(err => 
                console.error.response.data.data
            )
        },
        methods: {
            deleteBook(id)
            {
                this.saving = true
                let uri = `http://127.0.0.1:8000/api/delBook/${id}`;
                axios.delete(uri).then(response => {
                    M.toast({html: 'Book deleted'})
                    this.books.splice(this.books.findIndex(book => book.id === id), 1);
                    this.saving = false
                }).catch(err => {
                    // this.$router.push({ name: '404' });
                    this.saving = false
                })
            }
        },

    }
</script>