<template>
    <div class="container">
        <div class="articles">
            <div class="main-container">
                <section class="library-banner">
                    <h1>Library</h1>
                    <p class="lead">
                        Our Wealth of books and videos to feed your mind with daily motivation and guidance.
                    </p>
                </section>
                <section class="videos">
                    <div>
                        <h4>Courses</h4>
                    </div>
                    <div class="course row">
                        <div  v-for="video in videos" :key="video.id" class="col s12 m6 l4">
                            <div class="card">
                                <!-- TODO ON HOVER OVER IMAGE ADD VIDEO BUTTON AND BUY THIS COURSE?PREVIEW-->
                                <router-link :to="{name: 'course', params: { coursename: video.coursename }}">
                                    <div class="card-image">
                                        <img :src="'/courseImages/'+video.image" alt="preview image" />
                                        <span class="card-title"></span>
                                    </div>
                                </router-link>
                                <div class="card-content">
                                    <p class="coursename">{{video.coursename}}</p>
                                    <p class="bold">
                                        Created by Zurich <span class="right">{{video.language.language}}</span>
                                    </p>
                                    <!-- <p>Category: </p> -->
                                </div>
                                <div class="card-action">
                                    <span>{{video.videos.length}} videos</span>
                                <router-link :to="{name: 'course', params: { coursename: video.coursename }}">
                                    <span class="right"><i class="material-icons smaller">play_circle_outline</i> preview</span>
                                </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                <section class="books">
                    <div>
                        <h4>Books</h4>
                    </div>
                     <div class="rowed">
                        <div class="column3" v-for="book in books" :key="book.id">
                            <img :src="'/books/images/'+book.image" width="100" class="responsive-image"/>
                            <a :href="'books/path/'+book.path">
                                <p>{{book.name}}</p>
                            </a>
                             <div class="col l4 s12">
                            <p class="uppercase">Language: {{book.language.language}}</p>
                            <h6 class="grey-text">
                                {{book.description}}
                            </h6>
                        </div>
                        </div>
                       
                        
                    </div>
                    <!-- <div  v-for="book in books" :key="book.id" class="row">
                        <div class="col l4 s12">
                            <a :href="'books/path/'+book.path">
                                <div>
                                    <img :src="'/books/images/'+book.image" class="responsive-image"/>
                                </div>
                            
                                <p>{{book.name}}</p>
                            </a>
                        </div>
                        
                    </div> -->
                </section>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                videos: [],
                books: [],
            }
        },
        created() {
            let video_uri = '/api/courses';
            this.axios.get(video_uri).then(response => {
                this.videos = response.data;
                console.log(response)
            })
            .catch(err => 
                console.log(error.response)
            )
            // For Books
            let book_uri = '/api/books';
            this.axios.get(book_uri).then(response => {
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
    .bold {
        font-weight: bold;
    }
    .coursename {
        font-size: 24px;
        text-transform: capitalize;
    }
    .card .card-action span:not(.btn):not(.btn-large):not(.btn-small):not(.btn-large):not(.btn-floating){
        margin-right: 24px;
        transition: color .3s ease;
        text-transform: uppercase;
    }
    a:hover {
        color: darkgrey;
        text-decoration: underline;
    }
    .material-icons {
        font-size: 18px;
    }
    .rowed::after {
        content: "";
        clear: both;
        display: table;
    }
    @media screen and (max-width: 500px) {
        .column, .column3 {
            width: 100%;
        }
    }
    .column3 {
        float: left;
        width: 20%;
        padding: 5px;
        background-color: rgb(253, 253, 253);
        margin-left: 1px;
    }
</style>