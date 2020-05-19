<template>
    <div class="container mt-5">
        <div class="articles">
            <div class="main-container">
                <div v-for="post in posts" :key="post.id" class="body row">
                    <img :src="'/blogImages/'+post.imageName" class="responsive-img">
                    <em>{{post.imageName}}</em>
                    <h4>{{post.title}}</h4>
                    <p class="text-muted">Created on {{post.created_at}}</p>
                    <div class="col s12">
                        {{post.body}}
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
<style scoped>
    .uppercase {
        text-transform: uppercase;
        font-weight: 300;
    }
    a {
        text-transform: capitalize;
        font-size: 1em;
        font-weight: 450;
    }
    .body {
        padding-bottom: 30px;
    }
</style>
<script>
import axios from 'axios'
export default {
    props: [

    ],
    data() {
        return {
            posts: []
        }
    },
    created() {
        let uri = `http://127.0.0.1:8000/api/post/${this.$route.params.title}`;
        axios.get(uri).then(response => {
            this.posts = response.data;
            console.log(response.data)
        })
        .catch(err => 
            console.error.response.data.data
        )
        M.AutoInit()
    },
    mounted() {
        M.AutoInit()
    },
}
</script>