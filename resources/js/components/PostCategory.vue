<template>
    <div class="container">
        <div class="articles">
            <div class="main-container">
            
                <div v-for="post in posts" :key="post.id"  class="row">
                    <p class="uppercase">{{post.categoryName}}</p>
                    <div class="col l3 s12">
                        <div>
                            <img :src="'/blogImages/'+post.imageName" class="responsive-img"/>
                        </div>
                    </div>
                    <div class="col l4 offset-l2 s12 mb-5">
                        
                        <p class="grey-text">
                            <router-link :to="{name: 'post', params: {title: post.title}}">
                                {{post.title}}
                            </router-link>
                        </p>
                    </div>
                </div>
                <pagination 
                    :meta_data="meta_data"
                    v-on:next="fetchPosts">
                </pagination>
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
        font-size: 1.5em;
        font-weight: 450;
        color: steelblue;
    }
    .mb-5 {
        padding-bottom: 50px;
    }
</style>
<script>
import Pagination from './reusable/Pagination'
import axios from 'axios'

export default {
    props: [

    ],
    components: {
        Pagination
    },
    data() {
        return {
            posts: [],
            meta_data: {
                last_page: null,
                current_page: 1,
                prev_page_url: null
            }
        }
    },
    mounted() {
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
                this.posts = res.data.data;
                this.meta_data.last_page = res.data.last_page;
                this.meta_data.current_page = res.data.current_page;
                this.meta_data.prev_page_url = res.data.prev_page_url; 
                console.log(res.data.data)
                
            })
            .catch(err => 
                console.error.response.data.data
            )
        },
        
    },
}
</script>