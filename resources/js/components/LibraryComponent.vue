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
                    <section class="library-banner">
                        <h1>Library</h1>
                        <p class="lead">
                            Our Wealth of books and videos to feed your mind with daily motivation and guidance.
                        </p>
                    </section>
                    <div class="row">
                        <div class="col s12 tabsCol">
                            <ul class="tabs">
                                <li class="tab col s6"><a @click="showVideosTab" href="#">Videos</a></li>
                                <li class="tab col s6"><a @click="showBooksTab" href="#">Books</a></li>
                            </ul>
                        </div>
                        <!-- <div id="vidoes" v-if="showVids" class="col s12">
                            <section class="videos">
                                <div>
                                    <h4>Videos</h4>
                                </div>
                                <div class="course row">
                                    <div  v-for="video in videos" :key="video.id" class="col s12 m6 l4">
                                        <div class="card">
                                            <router-link :to="{name: 'course', params: { coursename: video.coursename }}">
                                                <div class="card-image">
                                                    <img :src="'/courseImages/'+video.image" alt="preview image" />
                                                    <span class="card-title"></span>
                                                </div>
                                            </router-link>
                                            <div class="card-content">
                                                <p class="coursename">{{video.coursename}}</p>
                                                <p class="bold">
                                                    Created by Zurich <span class="right">{{video.language}}</span>
                                                </p>
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
                        </div> -->
                        <div id="vidoes" v-if="showVids" style="color: grey; font-size: 30px; text-align: center;" class="col s12"><marquee>VIDEOS ARE COMING SOON</marquee></div>
                        <div id="books" v-if="showBooks" class="col s12">
                            <section class="books">
                                <div>
                                    <h4>Books</h4>
                                </div>
                                <div class="rowed">
                                    <div class="column3" v-for="book in books" :key="book.id">
                                        <div>
                                            <img :src="'/books/images/'+book.image" width="100" class="responsive-image"/>
                                            <p><em>Name: {{book.name}}</em></p>
                                            <a class="btn btn-small downloadBook waves waves-effect right grey darken-4" :href="'books/path/'+book.path" >Download</a>
                                            <p class="uppercase"><em>Language: {{book.language.language}}</em></p>
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
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                loaded: false,
                videos: [],
                books: [],
                showVids: true,
                showBooks: false
            }
        },
        created() {
            let video_uri = '/api/courses';
            this.axios.get(video_uri).then(response => {
                setTimeout(() => {
                    this.loaded = true;
                    this.videos = response.data;
                    console.log(response)
                }, 5000);
            })
            .catch(err => 
                console.log(error.response)
            )
            // For Books
            let book_uri = '/api/books';
            this.axios.get(book_uri).then(response => {
                this.books = response.data.data;
            })
            .catch(err => 
                console.log(response.data)
            )
            
        },
        methods: {
            showVideosTab(){
                this.showVids = true;
                this.showBooks = false;
            },
            showBooksTab(){
                this.showVids = false;
                this.showBooks = true;
            }
        },
    }
</script>
<style scoped>
    .articles{
        margin-top: 2vh;
        box-shadow: 13px 13px 20px grey;
    }
    .library-banner h1 {
        margin: 1.5rem 0rem;
    }
    .tabs .tab a, .tabs .tab a:hover, .tabs .tab a.active {
        background-color: grey;
        color: #f1e8e8;
    }
    .tabsCol {
        padding: 0px;
    }
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
    .column3 {
        float: left;
        width: 50%;
        padding: 5px;
        background-color: rgb(253, 253, 253);   
    }
    @media screen and (max-width: 500px) {
        .column3 {
            width: 100%;
        }
    }
   
</style>