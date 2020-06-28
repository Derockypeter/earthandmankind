<template>
    <div class="articles">
        <div class="main-container">
            <h2>Featured Articles</h2>
            <div class="rowed featured">
                <!-- <div class="row"> -->
                    <div v-for="featurePost in featurePosts" :key="featurePost.id" class="column hoverable">
                        <div class="card cardBackground">
                            <div class="card-content white-text">
                                <span class="card-title">
                                    {{featurePost.post.title.substr(0, 30)}}
                                </span>
                                <div class="cardBody">
                                    {{synopsis(featurePost.post.body)}}....
                                </div>
                            </div>
                            <div class="card-action center">
                                <router-link :to="{name: 'post-title', params: {title: featurePost.post.title}}" class="btn-flat">
                                    Read
                                </router-link>
                            </div>
                        </div>
                    </div>
                <!-- </div> -->
            </div>
            <div class="row book">
                <h2 class="inline-block ">Library</h2>
                <router-link :to="{name: 'library'}" class="waves-effect waves-light btn-small librarysect"><i class="material-icons sm right">chevron_right</i>See all</router-link>
                <div class="rowed">
                    <div class="column" v-for="book in books" :key="book.id">
                        <div class="card">
                            <div class="card-image">
                                <img :src="'/books/images/'+book.image" width="100"/>
                                <span class="card-title">
                                    {{book.name}}
                                </span>
                            </div>
                            <div class="card-content">
                                <p>{{book.description.substr(0, 50)}}...</p>
                            </div>
                            <div class="card-action">
                                <a :href="'books/path/'+book.path">
                                    {{book.name}}
                                </a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <!-- <div class="row video">
                <h5 class="inline-block">Videos</h5>
                <div class="col s12">
                    <router-link :to="{name: 'library'}" class="waves-effect waves-light btn-small"><i class="material-icons sm right">chevron_right</i>See all</router-link>
                    <div>
                        <video width="800" height="400" class="responsive-video" controls>
                            <source src="videos/1-Basic-Databinding.mp4" type="video/mp4">
                            <source src="movie.ogg" type="video/ogg">
                            Your browser does not support the video tag.
                        </video>
                        <p>Making the Best Life</p>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            featurePosts: Array,
            books: Array
        },
        data() {
            return {
                post:[]
            }
        },
        methods: {
            synopsis (inputString){
                var div = document.createElement('div')
                div.innerHTML = inputString
                return div.textContent.slice(0, 200)
            }
        },
        mounted() {
        },
    }
</script>
<style scoped>
    .featured, .category {
        padding-bottom: 30px;
        border-bottom: 0.4px rgba(209, 204, 204, 0.933) solid;
        margin-bottom: 30px;
    }
    /* Clear floats after image containers */
    
    .inline-block {
        display: inline-block;
    }
    .librarysect {
        float: right;
        margin: 3.9733333333rem 0 1.424rem 0
    }
    div.row.video {
        margin-bottom: 0px;
    }
    div.col.s12 {
        padding: 0px;
    }
    .video {
        padding-bottom: 50px;
    }
    i.right {
        margin-left: 1px;
    }
    a.waves-effect.waves-light.btn-small {
        padding: 0 4px 1px 4px;
    }
    .cardBackground {
        background-image: url('/images/carousel-img/1011537_univ_pnr_lg.jpg');
    }
    .card .card-title {
        font-size: 20px;
    }
    .card .cardBody {
        font-size: 13px;
    }
</style>