<template>
    <main class="container">
        <div class="banner">
            <!-- <img class="responsive-img "> -->
            <div class="row" style="padding-left:50px; ">
                <div class="col l6 s12 m6" style="padding-top:30px;" >
                    <div style="max-width:250px; max-height:30px;">
                        <a class="leadP">Getting to know Jesus is one of the most important things</a>
                        <p class="lead">Getting to know Jesus is one of the most important things</p>
                        <button class="btn">Learn More</button>
                    </div>
                    
                </div>
            </div>
        </div>
        <CategorySelection :posts="posts" :options="options" ></CategorySelection>
    </main>
</template>
<style scoped>
    .banner {
        background-image: url('/images/carousel-img/d2cj6h.jpg');
        background-repeat: repeat;
        /* width: 25000px; */
        color: #ffff;
        height: 350px;
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
    import Carousel from './CarouselComponent'
    import CategorySelection from './CategorySectionComponent'
    export default {
        props: [
            
        ],
        data() {
            return {
                posts: [],
                options: []
            }
        },
        created() {
            // let uri = 'http://127.0.0.1:8000/api/getAllCat';
            //     this.axios.get(uri).then(response => {
            //         this.options = response.data;
            //         console.log(response.data)
            //     });

            // let post_uri = `http://127.0.0.1:8000/api/category/${this.$route.params.category_id}`;
            // this.axios.get(post_uri).then(response => {
            //     this.posts = response.data.data;
            //     console.log(response.data)
            // })
            // .catch(err => 
            //     console.error.response.data
            // )
        },
        components: {
            Carousel,
            CategorySelection
        }
    }
</script>
