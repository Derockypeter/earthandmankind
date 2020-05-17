<template>
    <main class="container">
        <div class="articles">
            <div class="main-container">
                <div class="row">
                    <div class="col s12">
                        <Category></Category>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col s12">
                        <Post></Post>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col s12">
                        <Video></Video>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col s12">
                        <Book/>
                    </div>
                </div>
            </div>
        </div>
        
    </main>
</template>
<style scoped>

</style>
<script>
import Post from './post/IndexComponent'
import Category from './category/IndexComponent'
import Video from './videos/IndexComponent'
import Book from './book/IndexComponent'

export default {
    components: {
        Post,
        Category,
        Video,
        Book,
    }
}
</script>