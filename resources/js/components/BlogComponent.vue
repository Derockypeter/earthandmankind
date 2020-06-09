<template>
    <div class="container">
        <div class="articles">
            <div class="main-container">
                <!-- <div class="nav-wrapper grey"> -->
                    <div class="col s12 ">
                        <a href="#!" class="breadcrumb ">Home</a>
                        <a href="#!" class="breadcrumb ">Blog</a>
                        <a href="#!" class="breadcrumb ">Post</a>
                    </div>
                <!-- </div> -->
                <h1>Article</h1>
                <p class="lead mb-5">Read my article digest for Inspiration, growth, success, and to maintain a healthy balance in Life.</p>
                <div class="row">
                    <div v-for="post in posts" :key="post.id" class="col s12 l4 m4 hoverable">
                        <div class="card">
                            <div class="card-content white-text">
                                <span class="card-title">
                                    {{post.title}}
                                </span>
                                {{post.body.substr(0, 200)}}....
                            </div>
                            <div class="card-action center">
                                <router-link :to="{name: 'post-title', params: {title: post.title}}" class="btn-flat">
                                    Read
                                </router-link>
                                <i class="material-icons">language</i>
                                <span class="grey-text text-darken-4 uppercase"> {{post.language.language}}</span>

                            </div>
                        </div>
                        <!-- <div class="card small">
                            <div class="card-image waves-effect waves-block waves-light">
                            </div>
                            <div class="card-content">
                                <span class="card-title activator grey-text text-darken-4"><i class="material-icons right">more_vert</i></span>
                                <p class="grey-text link-size">
                                    <router-link :to="{name: 'post-title', params: {title: post.title}}">
                                        {{post.title}}
                                    </router-link>
                                </p>
                            </div>
                            <div class="card-reveal">
                                <span class="card-title grey-text text-darken-4 uppercase">{{post.categoryName}}<i class="material-icons right">close</i></span>
                                <p>{{post.body.substr(0, 100)}}...</p>
                                <router-link :to="{name: 'post-title', params: {title: post.title}}" class="btn-small">Read More &rarr;</router-link>
                            </div>
                        </div> -->
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
        /* font-weight: ; */
    }
    a, .card-title {
        text-transform: capitalize;
        font-weight: 500;
    }
    .mb-5 {
        padding-bottom: 50px;
    }
    .link-size {
        font-size: 1.3em;
    }
    .card {
        background-image: url('/images/carousel-img/1011537_univ_pnr_lg.jpg');
    }
</style>
<script>
    import Pagination from './reusable/Pagination'
    export default {
        props: [

        ],
        components: {
            Pagination
        },
        data() {
            return {
                posts: {
                
                },
                meta_data: {
                    last_page_url: null,
                    current_page: 1,
                    prev_page_url: null,
                    next_page_url: null
                }
            }
        },
        mounted() {
            this.fetchPosts()
        },
        methods: {
            fetchPosts(page = 1) {
                this.axios.get('/api/posts', {
                    params: {
                        page
                    }
                })
                .then( res => {
                    this.posts = res.data.data;
                    this.meta_data.last_page_url = res.data.last_page_url;
                    this.meta_data.current_page = res.data.current_page;
                    this.meta_data.prev_page_url = res.data.prev_page_url; 
                    this.meta_data.next_page_url = res.data.next_page_url  
                    console.log(res)                  
                })
                .catch(err => 
                    console.error.response.data.post
                )
            },
            
        },
        computed: {
            // WRITE FOR SUBSTR
            // truncate(){
            //     return this.posts.body.s;
            // }
        },
    }
</script>