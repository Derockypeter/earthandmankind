<template>
  <div class="container">
      <h1>Category</h1>
        <div class="row">
            <div class="col m10"></div>
            <div class="col m2">
                <router-link :to="{ name: 'create-cat' }" class="btn grey">Create Category</router-link>
            </div>
        </div><br />

        <table class="striped highlight responsive-table">
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
                    <td><router-link :to="{name: 'edit-cat', params: { id: category.id }}" class="btn cyan pulse"><i class="material-icons">edit</i></router-link></td>
                    <td><button class="btn red" :disabled="saving" @click.prevent="deleteCategory(category.id)"><i class="material-icons">delete</i></button></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                saving: false,
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
                this.saving = true
                let uri = `http://127.0.0.1:8000/api/delCat/${id}`;
                this.axios.delete(uri).then(response => {
                    this.categories.splice(this.categories.findIndex(category => category.id === id), 1);
                }).catch(err => {
                    this.$router.push({ name: '404' });
                }).then(
                    this.saving = false
                )
            }
        },

    }
</script>