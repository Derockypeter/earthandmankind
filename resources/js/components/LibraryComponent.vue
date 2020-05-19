<template>
    <div class="container">
        <div class="articles">
            <div class="main-container">
                <h1>Library</h1>
                <p class="lead">
                    Our Wealth of books and videos to feed your mind with daily motivation and guidance.

                </p>
                <div class="section videos">
                    <div>
                        <h4>Videos</h4>
                    </div>
                    <video class="responsive-video" width="800" height="400" controls>
                        <source src="videos/1-Basic-Databinding.mp4" type="video/mp4">
                        <source src="movie.ogg" type="video/ogg">
                        Your browser does not support the video tag.
                    </video>
                    <p>Making the Best Life</p>
                    <div  v-for="video in videos" :key="video.id" class="row">
                        <div class="col l6 s12">
                            <div>
                                <video class="responsive-video" controls>
                                    <source :src="'/videos/'+video.videoName" type="video/mp4">
                                    <source src="movie.ogg" type="video/ogg">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>
                        <div class="col l4 offset-l2 s12">
                            <p class="uppercase">{{video.categoryName}}</p>
                            <h6 class="grey-text">
                                {{video.title}}
                            </h6>
                        </div>
                    </div>
                </div>
                
                <div class="section books">
                    <div>
                        <h4>Books</h4>
                    </div>
                    
                    <div  v-for="book in books" :key="book.id" class="row">
                        <div class="col l4 s12">
                            <a :href="'books/path/'+book.path">
                                <div>
                                    <img :src="'/books/images/'+book.image" class="responsive-image"/>
                                </div>
                            
                                <p>{{book.name}}</p>
                            </a>
                        </div>
                        <div class="col l4 s12">
                            <p class="uppercase">{{book.categoryName}}</p>
                            <h6 class="grey-text">
                                {{book.description}}
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import router from '../router.js'
    export default {
        data() {
            return {
                videos: [],
                books: [],
            }
        },
        created() {
            let video_uri = 'http://127.0.0.1:8000/api/getAllVideos';
            axios.get(video_uri).then(response => {
                this.videos = response.data.data;
                console.log(response.data)
            })
            .catch(err => 
                console.error.response.data
            )
            // For Books
            let book_uri = 'http://127.0.0.1:8000/api/books';
            axios.get(book_uri).then(response => {
                this.books = response.data.data;
                console.log(response.data)
            })
            .catch(err => 
                console.error.response.data
            )
            
        },
        methods: {
            
        },

    }
</script>
<style scoped>
</style>