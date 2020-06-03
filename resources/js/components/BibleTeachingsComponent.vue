<template>
    <div class="container">
        <div class="articles">
            <div class="main-container">
                <div class="head">
                    <h1>Bible Teachings</h1>
                    <p class="lead">The Bible is a holy book for inculcating moral values, gaining wisdom, knowlegde and
                         understanding, learning things about how to make the best spiritual life possible. It can also be our reference
                         point in our time of distress, pain or discomfort using the verses to present your challenge</p>
                </div>
                <div class="featured">
                    <h2>Featured</h2>
                    <div class="featured-img">
                        <img src="\images\carousel-img\images (3).jfif" alt="Featured bible" width="100%" height="350vh">
                    </div>
                    <p class="text-grey bold rmMargin-top">BIBLE QUESTIONS ANSWERED</p>
                    <router-link :to="{name: 'featured-bible'}">Story of Joshua - The Courageous</router-link>
                    <p class="description rmMargin-top">Being courageous at all Times matters a lot</p>
                </div>
                <div class="bibleCategories">
                    <div class="row">
                        <h4 style="display: inline-block">See ways the Bible can help us</h4>
                        <router-link :to="{name: 'bible-teach_all'}" style="float:right; clear:both; padding-top: 25px; ">See All Bible Teachings</router-link>
                    </div>
                    <div class="sinImg catRow">
                        <div class="column">
                            <img src="\images\carousel-img\images (1).jfif" alt="The bible teaching on sin" width="100%" height="200vh">
                            <router-link :to="{name: 'sin'}">What the bible says about sin</router-link>
                            <p class="catDescription">
                                What can separate us from the Love of God, is it sin, clothe, death, olo, in all these we have vicory in Christ Jesus
                            </p>
                        </div>
                        
                    <!-- </div> -->
                        <div class="loveBanner column">
                            <!-- <div class=""> -->
                                <img src="\images\carousel-img\images (2).jfif" alt="The bible teaching on Love" width="100%" height="200vh">
                            <!-- </div> -->
                            <router-link :to="{name: 'love'}">What the bible says about Love</router-link>
                            <p class="catDescription">
                                For God so loved the world that He gave His only begotten son, whosoever beleives in Him shall not perish but have eternal life.
                            </p>
                        </div>
                        <div class="givingImg column">
                            <!-- <div class=""> -->
                                <img src="\images\carousel-img\images (3).jfif" alt="The bible teaching on Giving" width="100%" height="200vh">
                            <!-- </div> -->
                            <router-link :to="{name: 'giving'}">What the bible says about Giving</router-link>
                            <p class="catDescription">
                                Giving opens door of breakthrough, Name gave, and Angel Gabriel went with his son to pick a wife
                            </p>
                        </div>
                    </div>
                    <!-- <div class="faithImg column">
                        <div class="column">
                            <img src="\images\carousel-img\5_principles_of_the_faith-filled_life_159634769.jpg" alt="The bible teaching on Faith">
                        </div>
                        <router-link :to="{name: 'faith'}">What the bible says about Faith</router-link>
                        <p class="catDescription">
                            Faith is the substance of things hoped for but not seen, but beleiving that you have already grasped unto what ye seek.
                        </p>
                    </div>
                    <div class="childrenImg column">
                        <div class="column">
                            <img src="\images\carousel-img\maxresdefault.jpg" alt="Teaching guide for chidren">
                        </div>
                        <router-link :to="{name: 'children'}">What the bible says about Faith</router-link>
                        <p class="catDescription">
                            Bid thy child to come to me, for the Kingdom of Heaven is theirs
                        </p>
                    </div> -->
                   
                </div>
                
            </div>
        </div>
    </div>
</template>
<style scoped>
    .featured, .articles, .head {
        border-bottom: 0.8px rgba(212, 210, 210, 0.933) solid;
    }
    .column {
        float: left;
        width: 50%;
        padding: 5px;
    }
    .catRow::after {
        content: "";
        clear: both;
        display: table;
    }
    @media screen and (max-width: 500px) {
        .column {
            width: 100%;
        }
    }
    @media screen and (max-width: 600px) {
        .column {
            width: 100%;
        }
    }
    @media screen and (max-width: 800px) {
        .column {
            width: 100%;
        }
    }
    a {
        font-size: x-large;
    }
    a:hover {
        text-decoration: underline;
    }
    a:visited {
        color: rgb(113,101,149);
    }
    .rmMargin-top {
        margin-top: 5px;
    }
    .bold {
        margin-bottom: 5px;
    }
    img {
        box-shadow: 5px 4px rgb(240, 240, 240);
    }
</style>
<script>
export default {
    
}
</script>