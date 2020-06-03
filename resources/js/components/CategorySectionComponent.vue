<template>
    <div class="articles">
        <div class="main-container">
            <h5>Featured</h5>
            <div class="rowed featured">
                <div class="column featured-1">
                   <router-link :to="{name: 'bible-teachings'}">
                        <img src="\images\carousel-img\5_principles_of_the_faith-filled_life_159634769.jpg" style="width: 100%" alt="">
                    </router-link>
                   <router-link :to="{name: 'bible-teachings'}">Drawing close to God</router-link>
                </div>
                <div class="column featured-2">

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
                </div>
            </div>
            <h5>Select a Category</h5>
            <div class="category">

                <div class="rowed mrl-auto">
                    <router-link :to="{name: 'bible-teachings' }"><div class="column cols cat-1">Bible Teachings</div></router-link>
                    <router-link :to="{name: 'post', params: {categoryName: post.category_id} }"><div class="column cols cat-2">Godly Living</div></router-link>
                    <router-link :to="{name: 'post', params: {categoryName: post.category_id} }"><div class="column cols cat-3">Spirit-Controlled Life</div></router-link>
                </div>
                <div class="rowed">
                    <router-link :to="{name: 'post', params: {categoryName: post.category_id} }"><div class="column cols  cat-4">In his Presence</div></router-link>
                    <router-link :to="{name: 'post', params: {categoryName: post.category_id} }"><div class="column cols  cat-5">Seeking Comfort</div></router-link>
                    <router-link :to="{name: 'post', params: {categoryName: post.category_id} }"><div class="column cols  cat-6">Breaking Habits</div></router-link>
                </div>
            </div>
            <div class="row video">
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
            </div>
        </div>
        <!-- <div >
            <a href=""><div class="col s6 m4 3 cat-7"></div></a>
            <a href=""><div class="col s6 m4 3 cat-8"></div></a>
            <a href=""><div class="col s6 m4 3 cat-9"></div></a>
        </div> -->
    </div>
</template>
<script>
    export default {
        props: {
            featurePosts: Array
        },
        data() {
            return {
                post:[],
            }
        },
        created() {
          
        },
        mounted() {
            // console.log(this.featurePosts)
        },
    }
</script>
<style scoped>
    .column {
        float: left;
        width: 33.33%;
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
    }
    .cols {
        margin-left: 1%;
        margin-bottom: 20px;
        width: 32.35%;
    }
    @media screen and (max-width: 500px) {
         .cols {
            width: 100%;
        }
    }
    .column:hover {
        text-decoration: underline;
    }
    .cat-1 {
        background-image: url("/images/article-img/502014315_univ_lss_lg.jpg");
        background-repeat: repeat-x;
        background-position: center;
        color: #ffffff;
        padding-top: 60px;
        font-size: 1.2em;
        font-weight: 500;
        /* width: 280px; */
        margin-left: 0;
        height: 100px;
    }
    .cat-2 {
        background-image: url("/images/article-img/501000004_univ_lss_lg.jpg");
        background-repeat: repeat-x;
        background-position: center;
        color: #ffffff;
        padding-top: 60px;
        font-size: 1.2em;
        font-weight: 500;
        /* width: 280px; */
        height: 100px;
    }
    .cat-3 {
        background-image: url("/images/article-img/501100004_univ_lss_lg.jpg");
        background-repeat: repeat-x;
        background-position: center;
        color: #ffffff;
        padding-top: 60px;
        font-size: 1.2em;
        font-weight: 500;
        /* width: 280px; */
        height: 100px;
    }
    .cat-4 {
        background-image: url("/images/article-img/501600101_univ_lss_lg.jpg");
        background-repeat: repeat-x;
        background-position: center;
        color: #ffffff;
        padding-top: 60px;
        font-size: 1.2em;
        font-weight: 500;
        margin-left: 0;
        height: 100px;
    }
    .cat-5 {
        background-image: url("/images/article-img/502014311_univ_lss_lg.jpg");
        background-repeat: repeat-x;
        background-position: center;
        color: #ffffff;
        padding-top: 60px;
        font-size: 1.2em;
        font-weight: 500;
        /* width: 280px; */
        height: 100px;
    }
    .cat-6 {
        background-image: url("/images/article-img/502014315_univ_lss_lg.jpg");
        background-repeat: repeat-x;
        background-position: center;
        color: #ffffff;
        padding-top: 60px;
        font-size: 1.2em;
        font-weight: 500;
        /* width: 280px; */
        height: 100px;
    }
    .inline-block {
        display: inline-block;
    }
    .btn-small {
        float: right;
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

</style>