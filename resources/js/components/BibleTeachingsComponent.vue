<template>
    <div class="container">
        <div class="articles">
            <div class="main-container">
                <h1>Bible Teachings</h1>
                <p class="lead">Get all the bible teachings you need here</p>
                <div></div>
                <div v-for="bible in bibleTeaching" :key="bible.id" class="row">
                    <div class="col l6 s12">
                        <div>
                            <img :src="'/blogImages/'+bible.imageName" class="responsive-img"/>
                        </div>
                    </div>
                    <div class="col l5 s12">
                        <p class="uppercase">{{bible.categoryName}}</p>
                        <h6 class="grey-text">
                            <router-link :to="{name: 'post-title', params: {title: bible.title}}">
                                {{bible.title}}
                            </router-link>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .articles {
        border-bottom: solid;
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