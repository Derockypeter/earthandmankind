<template>
    <main class="container">
        <div class="banner">
            <div class="row" style="padding-left:50px; ">
                <div class="col l8 s12 m6" style="padding-top:30px;">
                    <div style="min-height:30px;">
                        <p class="lead">
                            God is the term given to lightest state of being,
                            with its consciousness. While death is the term
                            given to the hardest state of being with no
                            consciousness. Life is the term given to the product
                            of God and a being, through which the extent of
                            their difference can be determined. 
                        </p>
                        <p class="lead">Our life, began
                            when the consciousness of God was inserted into the
                            unconscious death. This action, gave birth to life
                            and the first living beings. It is as a result of
                            the successful evolution and integration in life ,
                            that a lighter state of being termed earth was
                            achieved, from which mankind the culminated specie
                            or kind of being from the product of God and earth
                            was made, to further the ultimate purpose of life.
                            </p>
                            <p class="lead waves-effect ">
                            Welcome, as we embark on the journey of discovering
                            more about life.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <CategorySelection
            :featurePosts="featurePosts"
            :books="books"
        ></CategorySelection>
    </main>
</template>
<style scoped>
.banner {
    background-image: url("/images/carousel-img/pexels-photo-scaled.jpeg");
    background-position: center;
    color: #ffff;
    height: 350px;
    margin-top: 1vh;
}
</style>
<script>
import CategorySelection from "./CategorySectionComponent";
export default {
    props: [],
    data() {
        return {
            featurePosts: [],
            books: []
        };
    },
    created() {
        // For Books
        let book_uri = "/api/books";
        this.axios
            .get(book_uri)
            .then(response => {
                this.books = response.data.data;
            })
            .catch(err => console.error.response.data);

        let featuredPost = `/api/featuredPost`;
        this.axios
            .get(featuredPost)
            .then(response => {
                this.featurePosts = response.data;
            })
            .catch(err => console.log(err.response));
    },
    components: {
        CategorySelection
    }
};
</script>
