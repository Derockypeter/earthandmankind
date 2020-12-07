<template>
    <div class="container">
        <h1>Gallery</h1>
        <div class="center" v-if="!loaded">
            <div class="preloader-wrapper small active">
                <div class="spinner-layer spinner-red-only">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <div class="row">
                <div class="col m10"></div>
                <div class="col m2">
                    <router-link
                        :to="{ name: 'create-gallery' }"
                        class="btn grey"
                        >New</router-link
                    >
                </div>
            </div>
            <br />

            <div class="row" v-if="galleries.length > 0">
                <div
                    class="col s2 l3"
                    v-for="gallery in galleries"
                    :key="gallery.id"
                >
                    <img
                        class="responsive-img"
                        width="250"
                        :src="'/images/' + gallery.name"
                    />
                    <p>
                        <!-- <router-link :to="{name: 'edit-gallery', params: { id: gallery.id }}" class="btn cyan pulse"><i class="material-icons">edit</i></router-link> -->
                        <button class="btn red" :disabled="saving" @click.prevent="deleteGallery(gallery.id)"><i class="material-icons">delete</i></button>
                    </p>
                </div>
            </div>
            <div v-else>
                <h6 class="center">No Image Have been created</h6>
            </div>
        </div>
    </div>
</template>
<style scoped></style>
<script>
export default {
    data() {
        return {
            saving: false,
            loaded: false,
            galleries: []
        };
    },
    created() {
        let uri = "/api/image-gallery";
        this.axios
            .get(uri)
            .then(response => {
                this.galleries = response.data.image_gallery;
                this.loaded = true;
            })
            .catch(err => console.log(err));
    },
    methods: {
        deleteGallery(id) {
            this.saving = true;
            let uri = `/api/image-gallery/${id}`;
            this.axios
                .delete(uri)
                .then(response => {
                    M.toast({ html: "Image deleted" });
                    this.galleries.splice(
                        this.galleries.findIndex(gallery => gallery.id === id),
                        1
                    );
                    this.saving = false;
                })
                .catch(err => {
                    this.saving = false;
                });
        }
    },
   
};
</script>
