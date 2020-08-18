<template>
    <div class="container">
        <div class="articles">
            <div class="main-container">
                <div class="center" v-if="!loaded" style="height:500px">
                    <div style="top:250px" class="preloader-wrapper small active">
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
                    <div class="article-banner">
                        <div class="right col s6 l4">
                            <select class="browser-default" @change="changeLang">
                                <option value="" disabled selected>Select language</option>
                                <option  v-for="option in options" :key="option.id" :value="option.id">{{option.language}}</option>
                            </select>
                        </div>
                        <h1>Article</h1>
                        <p class="lead mb-5">Reading the articles in sequence will make much understanding.</p>
                        
                    </div>
                    <div class="rowed">
                        <div v-if="posts.length == 0">
                                <h5 class="grey-text">No Post with Selected Language</h5>
                        </div>
                        <div v-for="post in posts" :key="post.id" class="column hoverable">
                            <!-- <div class="col s12 m7"> -->
                                <div class="card">
                                    <div class="card-image">
                                        <img :src="post.imageSrc" width="200" height="200">
                                        <span class="card-title dark-text">{{post.content.title.substr(0, 20)}}</span>
                                    </div>
                                    <div class="card-content dark-text">
                                    <p>{{synopsis(post.content.body)}}....</p>
                                    </div>
                                    <div class="card-action center">
                                        <router-link :to="{name: 'post-title', params: {title: post.content.title}}" class="btn-flat">
                                            Read
                                        </router-link>
                                        <i class="material-icons">language</i>
                                        <span class="grey-text text-darken-4 uppercase"> {{post.content.language.language}}</span>

                                    </div>
                                </div>
                            <!-- </div> -->
                        </div>
                        <!-- <div >
                            <div class="card">
                                <div class="card-content white-text">
                                    <span class="card-title">
                                       
                                    </span>
                                    <div></div>
                                </div>
                                <div class="card-action center">
                                    <router-link :to="{name: 'post-title', params: {title: post.title}}" class="btn-flat">
                                        Read
                                    </router-link>
                                    <i class="material-icons">language</i>
                                    <span class="grey-text text-darken-4 uppercase"> {{post.language.language}}</span>

                                </div>
                            </div>
                        </div> -->
                    </div>
                    <pagination 
                        :meta_data="meta_data"
                        v-on:next="fetchPosts">
                    </pagination>
                </div>

            </div>
        </div>
    </div>
</template>
<style scoped>
    .articles{
        margin-top: 2vh;
        box-shadow: 13px 13px 20px grey;
    }
    .article-banner h1 {
        margin: 1.5rem 0rem;
    }
    .uppercase {
        text-transform: uppercase;
        /* font-weight: ; */
    }
    .card .card-image .card-title {
        color: black;
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
        /* background-image: url('/images/1011537_univ_pnr_md.jpg'); */
        background-position: top left;
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
                loaded: false,
                options: [],
                posts: {},
                meta_data: {
                    last_page_url: null,
                    current_page: 1,
                    prev_page_url: null,
                    next_page_url: null
                }
            }
        },
        created() {
            let uri = '/api/languages';
            this.axios.get(uri).then(response => {
                // console.log(response);
                this.options = response.data;
            });
        },
        mounted() {
            this.fetchPosts()
        },
        methods: {
            fetchPosts(page = 1) {
                this.axios.get('/api/getDefaultPosts', {
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
                     
                       var src = []
                        
                        
                    res.data.data.forEach(element => {
                        var m, rex = /<img.*?src="(.*?)"[^\>]+>/g;
                        m = rex.exec( element.body ) 
                        src.push({imageSrc: m[1], content: element}) ;
                    });
                        this.posts = src

                    
                }, 5000);
                ; 
                })
                .catch(err => {} 
                    // console.error.response.data.post
                )
            },
            changeLang()
            {
                let id = event.target.value;
                let uri = `/api/getPostsByLanguage/${id}`
                if (uri) {
                    this.axios.get(uri)
                    .then( res => {
                        this.posts = res.data;
                    })
                }
            },
            synopsis (inputString){
                var div = document.createElement('div')
                div.innerHTML = inputString
                return div.textContent.slice(0, 150)
            },
            
        },
    }
</script>