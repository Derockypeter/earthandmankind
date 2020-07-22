<template>
    <main >
        <div class="hide-on-large-only">
            <div class="banner">
                <img src="/images/background-logo/background_logo.jpg" alt="site logo" width="100%" height="490px" class="responsive-img">
            </div>
        </div>
        
        <div class="container">
            <div class="banner hide-on-med-and-down">
                <img src="/images/background-logo/background_logo.jpg" alt="site logo" class="responsive-img">
            </div>
            <div class="row">
                <div class="col s12" style="padding-top:30px;">
                    <p class="lead">
                        God is the term given to lightest and brightest state of being
                        with its consciousness, while death is the term
                        given to the hardest and hardest state of being with no
                        consciousness. 
                    </p>
                    <p>
                        Life is the term given to the product
                        of God and death through which the extent of
                        their difference can be determined. 
                    </p>
                    <p class="lead">
                        Our life, began
                        when the consciousness of God was inserted into the
                        unconscious death and this action gave birth to life
                        and the first living beings. It is as a result of
                        the successful evolution and integration in life from death
                        that a lighter state of being termed earth was
                        achieved from which mankind; the culminated specie
                        or kind of being from the product of God and earth
                        was made, to further the ultimate purpose of life.
                    </p>
                    <p class="lead blue-text text-darken-2">
                        Welcome, as we embark on the journey of discovering
                        more about life.
                    </p>
                </div>
            </div>
        </div>
        
        <!-- <CategorySelection
            :featurePosts="featurePosts"
            :books="books"
        ></CategorySelection> -->
    </main>
</template>
<style scoped>
.banner.hide-on-med-and-down img {
   /* margin-top: 1vh; */
   width: 100%;
   height: 480px;
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
