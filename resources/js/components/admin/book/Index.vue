<template>
  <b-container>
      <h1>Posts</h1>
        <div class="row">
            <div class="col-md-10"></div>
            <div class="col-md-2">
                <router-link :to="{ name: 'create-post' }" class="btn btn-primary">Create Post</router-link>
            </div>
        </div><br />

        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Post</th>
                <th>Category</th>
                <th>Image</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="post in posts" :key="post.id">
                    <td>{{ post.id }}</td>
                    <td>{{ post.title }}</td>
                    <td>{{ post.body }}</td>
                    <td>{{ post.categoryName }}</td>
                    <td><b-img thumbnail fluid :src="'/blogImages/'+post.imageName"></b-img></td>
                    <td><router-link :to="{name: 'edit-post', params: { id: post.id }}" class="btn btn-primary">Edit</router-link></td>
                    <td><button class="btn btn-danger"  @click.prevent="deletePost(post.id)">Delete</button></td>
                </tr>
            </tbody>
        </table>
    </b-container>
</template>
<style scoped>
 
 
</style>
<script>
    export default {
        data() {
            return {
                isBusy: false,
                posts: [],
            }
        },
        created() {
            let uri = 'http://127.0.0.1:8000/api/posts';
            this.axios.get(uri).then(response => {
                this.posts = response.data.data;
                console.log(response.data)
            })
            .catch(err => 
                console.error.response.data.data
            )
        },
        methods: {
            // myProvider(){
            //     let uri = 'http://127.0.0.1:8000/api/posts';
            //     this.axios.get(uri).then(response => {
            //         this.posts = response.data.data;
            //         console.log(response.data)
            //     })
            //     .catch(err => 
            //         console.error.response.data.data
            //     )
            // },
            deletePost(id)
            {
                let uri = `http://127.0.0.1:8000/api/deletePost/${id}`;
                this.axios.delete(uri).then(response => {
                    console.log(response)
                    this.posts.splice(this.posts.findIndex(post => post.id === id), 1);
                }).catch(err => {
                    console.log(err.response.header)
                    console.log(err.response.data)
                })
            }
        },

    }
</script>