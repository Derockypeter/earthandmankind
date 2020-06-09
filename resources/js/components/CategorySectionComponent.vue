<template>
    <div class="articles">
        <div class="main-container">
            <h2>Featured Articles</h2>
            <div class="rowed featured">
                <div class="column featured-1"  v-for="featurePost in featurePosts" :key="featurePost.id" >
                    <h5>{{featurePost.post.title}}</h5>
                    <p style="width: 100%">{{featurePost.post.body.substr(0, 200)}}....</p>
                    <router-link :to="{name: 'post-title', params: {title: featurePost.post.title}}" class="waves-effect waves-light btn-small">
                        Read More
                    </router-link>
                </div>
                <!-- <div class="column featured-2">

                    <router-link :to="{name: 'bible-teachings'}">
                        <img src="\images\carousel-img\images.jfif" style="width: 100%" alt="">
                    </router-link>
                    <router-link :to="{name: 'post'}">Christianity and Technology</router-link>
                </div>
                <div class="column featured-3">
                   <router-link :to="{name: 'bible-teachings'}">
                       <img src="\images\carousel-img\images (3).jfif" style="width: 100%" alt="">
                   </router-link>
                   <router-link :to="{name: 'post'}">Understanding God's Creatures</router-link>
                </div> -->
            </div>
            <div class="row book">
                <h2 class="inline-block ">Library</h2>
                <router-link :to="{name: 'library'}" class="waves-effect waves-light btn-small librarysect"><i class="material-icons sm right">chevron_right</i>See all</router-link>
                <div class="col s12">
                    <div class="rowed">
                        <div class="column3" v-for="book in books" :key="book.id">
                            <img :src="'/books/images/'+book.image" width="100" class="responsive-image"/>
                            <a :href="'books/path/'+book.path">
                                <p>{{book.name}}</p>
                            </a>
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
        created() {
          
        },
        mounted() {
        },
    }
</script>
<style scoped>
    .column {
        float: left;
        width: 33.33%;
        padding: 5px;
    }
    .column3 {
        float: left;
        width: 20%;
        padding: 5px;
    }
    .featured, .category {
        padding-bottom: 30px;
        border-bottom: 0.4px rgba(209, 204, 204, 0.933) solid;
        margin-bottom: 30px;
    }
    /* Clear floats after image containers */
    .rowed::after {
        content: "";
        clear: both;
        display: table;
    }
    @media screen and (max-width: 500px) {
        .column {
            width: 100%;
        }
        .column3 {
            width: 50%;
        }
    }
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
    .bottomleft {
        position: absolute;
        bottom: 15px;
        left: 16px;
        color: #ffffff;
        font-size: 1.2em;
        font-weight: 500;
    }
    .bottomleft:hover {
        text-decoration: underline;
    }
</style>