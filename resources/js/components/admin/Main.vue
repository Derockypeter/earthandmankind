<template>
    <div class="container mb">
        <div class="row">
            <div class="col m3 product-box big-text">
                <a href='/admin/languages'>Languages<span class="badge"> ({{languages.length}})</span></a>
            </div>
            <div class="col m1">
            </div>
            <div class="col m3 product-box big-text">
                <a href='/admin/tour'>Tour<span class="badge"> ({{tour.length}})</span></a>
            </div>
            
            <div class="col m1">
            </div>
            <div class="col m3 product-box big-text">
                <a href='/admin/users'>Users<span class="badge"> ({{users.length}})</span></a>
            </div>
        </div>
        <div class="row">
            <div class="col m3 product-box big-text">
                <a href='/admin/videos'>Videos<span class="badge"> ({{videos.length}})</span></a>
            </div>
            <div class="col m1">
            </div>
            <div class="col m3 product-box big-text">
                <a href='/admin/books'>Books<span class="badge"> ({{books.length}})</span></a>
            </div>
             <div class="col m1">
            </div>
            <div class="col m3 product-box big-text">
                <a href='/admin/audio'>Audio<span class="badge"> ({{audio.length}})</span></a>
            </div>
           
        </div>
        <div class="row">
             <!-- <div class="col m3 product-box big-text">
                <a href='/admin/images'>Images<span class="badge"> ({{images.length}})</span></a>
            </div> -->
            <div class="col m1">
            </div>
            <!-- <div class="col m3 product-box big-text">
                <a href='/admin/posts'>Posts<span class="badge"> ({{posts.length}})</span></a>
            </div> -->
        </div>
    </div>
        
</template>

<script>
    export default {
        data() {
            return {
                user : null,
                languages : [],
                // posts : [],
                videos: [],
                books: [],
                users : [],
                audio: [],
                // images: [],
                tour: [],
            }
        },
        mounted() {
            this.axios.get('/api/users/').then(response => this.users = response.data)
            // this.axios.get('/api/posts/').then(response => this.posts = response.data.data)
            this.axios.get('/api/languages/').then(response => this.languages = response.data)
            this.axios.get('/api/books/').then(response => this.books = response.data)
            this.axios.get('/api/getAllVideos/').then(response => this.videos = response.data)
            // this.axios.get('/api/image-gallery/').then(response => this.images = response.data.image_gallery)
            this.axios.get('/api/audio/').then(response => this.audio = response.data.audio)
            this.axios.get('/api/tour').then(response => this.tour = response.data)
        }
    }
</script>

<style scoped>
    .mb {
        padding-bottom: 30px;
    }
    .big-text { font-size: 4vh; }
    .product-box { border: 1px solid #cccccc; padding: 10px 15px; height: 10vh }
</style>