<template>
  <div class="container">
      <h1>Posts</h1>
        <div class="row">
            <div class="col m10"></div>
            <div class="col m2">
                <router-link :to="{ name: 'create-post' }" class="btn grey">Create Post</router-link>
            </div>
        </div><br />
        <div v-if="! loaded">Loading...</div>
        <table class="striped highlight responsive-table">
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
                    <td><img :src="'/blogImages/'+post.imageName" class="circle responsive-img" height="100" width="100"></td>
                    <td><router-link :to="{name: 'edit-post', params: { id: post.id }}" class="btn cyan pulse"><i class="material-icons">edit</i></router-link></td>
                    <td><button class="btn red" :disabled="saving" @click.prevent="deletePost(post.id)"><i class="material-icons">delete</i></button></td>
                </tr>
            </tbody>
        </table>
        <pagination 
            :meta_data="meta_data"
            v-on:next="fetchPosts">
        </pagination>
    </div>
</template>
<style scoped>
 
 
</style>
<script>
    import Pagination from '../../reusable/Pagination'    
    import axios from 'axios'
    export default {
        components: {
            Pagination
        },
        data() {
            return {
                saving: false,
                loaded: false,
                posts: [],
                 meta_data: {
                    last_page_url: null,
                    current_page: 1,
                    prev_page_url: null,
                    next_page_url: null
                }
            }
        },
        created() {
            this.fetchPosts()
        },
        methods: {
            fetchPosts(page = 1) {
                axios.get('http://127.0.0.1:8000/api/posts', {
                    params: {
                        page
                    }
                })
                .then( res => {
                   setTimeout(() => {
                    this.loaded = true;
                    this.posts = res.data.data;
                    this.meta_data.last_page_url = res.data.last_page_url;
                    this.meta_data.current_page = res.data.current_page;
                    this.meta_data.prev_page_url = res.data.prev_page_url; 
                    this.meta_data.next_page_url = res.data.next_page_url
                }, 5000);
                    
                })
                .catch(err => 
                    console.error.res.data.data
                );
            },
            deletePost(id){
                this.saving = true
                let uri = `http://127.0.0.1:8000/api/deletePost/${id}`;
                axios.delete(uri).then(response => {
                    console.log(response)
                    this.posts.splice(this.posts.findIndex(post => post.id === id), 1);
                    thsi.saving = false
                }).catch(err => {
                    // this.$router.push({ name: '404' });
                    this.saving = false
                })
            }
        },

    }
</script>