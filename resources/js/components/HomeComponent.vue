<template>
    <main class="container">
        <img class="responsive-img" src="\images\carousel-img\d2cj6h.jpg">
        <CategorySelection :posts="posts" :options="options" ></CategorySelection>
    </main>
</template>
<style scoped>
    img {
        width: 2500px;
        height: 300px;
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
