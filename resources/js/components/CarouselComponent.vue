<template>
    <div>
        <div class="main-body">
            <div class="container">
                <div class="carousel carousel-slider" indicators>
                    <a class="carousel-item" href="#one!"><img src="/images/carousel-img/Screen-Shot-2015-05-14-at-11.47.11-AM.png" alt=""></a>
                    <a class="carousel-item" href="#two!"><img src="/images/carousel-img/Women_of_faith_final_800_460_80_c1.jpg" alt=""></a>
                    <a class="carousel-item white-text" href="#three!">
                        <img src="\images\carousel-img\FB_IMG_15022934673036856.jpg" alt=""></a>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    img, .carousel {
        width: 800px;
        height: 400px;
    }
</style>
<script>
    export default {
        data() {
        return {
            indicators: true
        }
        },
        mounted() {
        },
        methods: {
       
        }
    }
</script>