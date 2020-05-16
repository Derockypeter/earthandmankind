<template>
  <b-container>
      <h1>Category</h1>
        <div class="row">
            <div class="col-md-10"></div>
            <div class="col-md-2">
                <router-link :to="{ name: 'create-cat' }" class="btn btn-primary">Create Category</router-link>
            </div>
        </div><br />

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="category in categories" :key="category.id">
                    <td>{{ category.id }}</td>
                    <td>{{ category.categoryName }}</td>
                    <td><router-link :to="{name: 'edit-cat', params: { id: category.id }}" class="btn btn-primary">Edit</router-link></td>
                    <td><button class="btn btn-danger sm" @click.prevent="deleteCategory(category.id)">Delete</button></td>
                </tr>
            </tbody>
        </table>
    </b-container>
</template>

<script>
    export default {
        data() {
            return {
                isBusy: false,
                categories: [],
            }
        },
        created() {
            let uri = 'http://127.0.0.1:8000/api/getAllCat';
            this.axios.get(uri).then(response => {
                this.categories = response.data;
            })
            .catch(err => 
                console.error.response.data.data
            )
        },
        methods: {
            deleteCategory(id)
            {
                let uri = `http://127.0.0.1:8000/api/delCat/${id}`;
                this.axios.delete(uri).then(response => {
                    this.categories.splice(this.categories.findIndex(category => category.id === id), 1);
                }).catch(err => {
                    console.log(err.response.header)
                    console.log(err.response.data)
                })
            }
        },

    }
</script>