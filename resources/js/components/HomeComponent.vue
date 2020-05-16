<template>
    <main class="container">
        <img class="responsive-img" src="\images\carousel-img\d2cj6h.jpg">
        <CategorySelection></CategorySelection>
    </main>
</template>
<style scoped>
    img {
        width: 2500px;
        height: 500px;
    }
</style>
<script>
    import Carousel from './CarouselComponent'
    import CategorySelection from './CategorySectionComponent'
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        components: {
            Carousel,
            CategorySelection
        }
    }
</script>
