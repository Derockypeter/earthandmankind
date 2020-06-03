<template>
    <div class="container">
        <div class="articles">
            <div class="main-container">
                <div class="latest">
                    <h2>Latest</h2>
                    <div class="latest-img">
                        <img src="\images\article-img\102018046_univ_lss_lg.jpg" alt="Latest bible" class="responsive-img">
                    </div>
                    <p class="grey bold"></p>
                    <router-link :to="{name: 'featured-bible'}">Story of Joshua - The Courageous</router-link>
                    <p class="description">Being courageous at all Times matters a lot</p>
                </div>
                <div style="margin-top: 5px">
                    <button class="btn-small">ALL</button>
                </div>
                <div class="row">
                    <div v-for="bible in bibleTeaching" :key="bible.id" class="col s12 l4 m4 hoverable">
                        <div class="card small">
                            <div class="card-image waves-effect waves-block waves-light">
                                <img :src="'/blogImages/'+bible.imageName" class="responsive-img">
                            </div>
                            <div class="card-content">
                                <span class="card-title activator grey-text text-darken-4"><i class="material-icons right">more_vert</i></span>
                                <p class="grey-text link-size">
                                    <router-link :to="{name: 'post-title', params: {title: bible.title}}">
                                        {{bible.title}}
                                    </router-link>
                                </p>
                            </div>
                            <div class="card-reveal">
                                <span class="card-title grey-text text-darken-4 uppercase">{{bible.categoryName}}<i class="material-icons right">close</i></span>
                                <p>{{bible.body.substr(0, 100)}}...</p>
                                <router-link :to="{name: 'post-title', params: {title: bible.title}}" class="btn-small">Read More &rarr;</router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .latest {
       border-bottom: 0.8px rgba(212, 210, 210, 0.933) solid;
    }
    .latest a {
        font-size: x-large;
    }
    a:hover {
        text-decoration: underline;
    }
    a:visited {
        color: rgb(113,101,149);
    }
    .link-size {
        font-size: 1.3em;
    }
</style>
<script>
    import axios from 'axios'
    export default {
        data() {
            return {
                bibleTeaching: [],
            }
        },
        created() {
            let uri = 'http://127.0.0.1:8000/api/post';
            axios.get(uri).then(response => {
                this.bibleTeaching = response.data;
                console.log(response.data)
            })
            .catch(err => 
                console.error.response.data
            )
        },
    }
</script>