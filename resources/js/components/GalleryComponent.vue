<template>
    <div class="container articles">
        <div class="main-container">
            <div class="row dictHeader">
                <div class="col s12 l8">
                    <h1>Gallery</h1>
                </div>
            </div>
            <div class="row" v-if="galleries.length > 0" >
                <div
                    class="col s2 l3"
                    v-for="gallery in galleries"
                    :key="gallery.id"
                    v-viewer
                >
                    <img
                        class="materialboxed"
                        width="250"
                        :src="'/images/' + gallery.name"
                        :data-caption="gallery.desc"
                    />
                </div>
            </div>

            <div v-else>
                <h6 class="center">Images Are Loading...</h6>
            </div>
            
        </div>
    </div>
</template>
<style scoped>
.articles {
    margin-top: 2vh;
    box-shadow: 13px 13px 20px grey;
}

.dictHeader h1 {
    margin-top: 0px;
}
</style>
<script>
export default {
    data() {
        return {
            galleries: [],
            word: "",
            images: [],
        };
    },
    created() {
        this.axios.get("api/gallery").then(response => {
            // console.log(response);
            this.galleries = response.data.image_gallery;
            let image = [];
            response.data.image_gallery.forEach(element => {
                image.push(element.name)
            });
            this.images = image

            // this.images = .name
        });
    },
    mounted() {
        document.addEventListener("DOMContentLoaded", function() {
            var elems = document.querySelectorAll(".materialboxed");
            var instances = M.Materialbox.init(elems);
        });
    }
};
</script>
