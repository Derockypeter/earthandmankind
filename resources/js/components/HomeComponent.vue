<template>
    <main class="container">
        <div class="banner">
            <div class="row" style="padding-left:50px; ">
                <div class="col l6 s12 m6" style="padding-top:30px;" >
                    <div style="max-width:250px; max-height:30px;">
                        <a class="leadP">Getting to know Jesus is one of the most important things</a>
                        <p class="lead">Getting to know Jesus is one of the most important things, use our Bible Teachings to improve your life</p>
                        <router-link :to="{name: 'article'}" class="btn">Learn More</router-link>
                    </div>
                    
                </div>
            </div>
        </div>
        <CategorySelection :featurePosts="featurePosts" :books="books" ></CategorySelection>
    </main>
</template>
<style scoped>
    .banner {
        background-image: url('/images/carousel-img/pexels-photo-scaled.jpeg');
        background-position: center;
        color: #ffff;
        height: 350px;
        margin-top: 1vh;
    }
    .leadP {
        font-size: 15px;
        color: #ffff;
        cursor: pointer;
    }
    .leadP:hover {
        color: #ffff;
        text-decoration: underline;
    }
    
</style>
<script>
    import CategorySelection from './CategorySectionComponent'
    export default {
        props: [
            
        ],
        data() {
            return {
                featurePosts: [],
                books: []
            }
        },
        created() {
            // For Books
            let book_uri = '/api/books';
            this.axios.get(book_uri).then(response => {
                this.books = response.data.data;
                console.log(response.data)
            })
            .catch(err => 
                console.error.response.data
            )

            let featuredPost = `/api/featuredPost`;
            this.axios.get(featuredPost).then(response => {
                this.featurePosts = response.data;
                console.log(response.data)
            })
            .catch(err => 
                console.log(err.response)
            )
        },
        components: {
            CategorySelection
        }
    }
</script>
