<template>
    <div class="container">
        <div class="articles">
            <div class="main-container">
                <h1>Add Image</h1>
                <div v-if="message" class="alert">{{ message }}</div>
                <div class="row">
                    <form
                        class="col s12"
                        @submit="addImage"
                        enctype="multipart/form-data"
                    >
                        <div class="row">
                            <div class="input-field col s12">
                                <input
                                    placeholder="Enter Description"
                                    v-model="images.desc"
                                    id="name"
                                    type="text"
                                    class="validate"
                                />
                            </div>
                        </div>
                        <div class="row">
                            <div class="file-field input-field col s12">
                                <div class="btn">
                                    <span>File</span>
                                    <input
                                        type="file"
                                        v-on:change="onImageChange"
                                    />
                                </div>
                                <div class="file-path-wrapper">
                                    <input
                                        class="file-path validate"
                                        name="image"
                                        type="text"
                                        placeholder="Upload Image"
                                        required
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <div class="input-field col s12">
                                    <input class="validate" v-model="images.tags" placeholder="tags"/>
                                </div>
                                <button class="btn waves waves-effect green lighten-1" :disabled="saving">
                                    {{ saving ? 'Uploading Image..' : 'Create Image' }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
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
            message: false,
            images: {
                name: null,
                desc: "",
                tags: "",
            },
        };
    },
    methods: {
        addImage(evt) {
            evt.preventDefault();
            this.saving = true;
            if (this.images.desc != "" && this.images.name != "") {
                let uri = "/api/image-gallery";
                let formData = new FormData;
                formData.append('name', this.images.name);
                formData.append('desc', this.images.desc)
                formData.append('tags', this.images.tags)
                this.axios
                    .post(uri, formData)
                    .then(response => {
                        if (response.data.status == 200){
                            M.toast({ html: response.data.message });
                   
                            this.$router.push({ name: "admin" }).catch(()=>{});
                        }
                    })
                    .catch(error => {
                        this.message =
                            "There was an issue creating the image.";
                        this.saving = false;
                    });
            }
        },
        onImageChange(event) {
            if (!event.target.files.length) return;

            this.images.name = event.target.files[0];
        },
    }
};
</script>
