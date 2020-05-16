<template>
    <main class="container">
        <div class="articles">
            <div class="main-container">
                <Category></Category>
                <hr/>
                <Post></Post>
                <hr/>
                <Video></Video>
                <hr/>
                <Book>
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
        Video
    }
}
</script>