<template>
    <div class="container">
        <div class="articles">
            <div class="main-container">
                <center>
                    <h2>Create New Post</h2>
                    <div v-if="message" class="alert">{{ message }}</div>

                    <div class="row">
                        <form class="col s12" @submit="publishPost">
                            <div class="row">
                                <div class="input-field col s6">
                                    <input
                                        v-model="post.title"
                                        name="title"
                                        required
                                        placeholder="Enter Title"
                                        type="text"
                                        class="validate"
                                    />
                                </div>
                                <div class="input-field col s6">
                                    <select
                                        class="browser-default"
                                        v-model="post.language_id"
                                        required
                                    >
                                        <option value="" disabled selected
                                            >Select language</option
                                        >
                                        <option
                                            v-for="option in options"
                                            :key="option.id"
                                            :value="option.id"
                                            v-text="option.language"
                                        ></option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <tinymce
                                        v-model="post.body"
                                        :plugins="myPlugins"
                                        :toolbar="myToolbar1"
                                        :init="myInit"
                                    >
                                    </tinymce>
                                </div>
                            </div>
                            <div class="row">
                                <!-- <div class="info">
                                    <p><strong>Info!</strong> Please check this box if you want to make the post to be featured.</p>
                                </div>
                                <p>
                                    <label>
                                        <input id="indeterminate-checkbox" v-model="post.featured" value='1' type="checkbox" />
                                        <span>Featured Post</span>
                                    </label>
                                </p> -->
                                <button
                                    :disabled="saving"
                                    class="btn waves-effect"
                                    type="submit"
                                >
                                    {{ saving ? "Creating..." : "Create" }}
                                </button>
                            </div>
                        </form>
                    </div>
                </center>
            </div>
        </div>
    </div>
</template>

<script>
import Editor from "@tinymce/tinymce-vue";
import axios from "axios";

export default {
    data() {
        return {
            saving: false,
            message: false,
            post: {
                title: "",
                body: "",
                language_id: "",
                featured: ""
            },
            options: [],
            myToolbar1:
                "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            myPlugins:
                "advlist autolink lists link image charmap print preview anchor searchreplace visualblocks code fullscreen, insertdatetime media table paste imagetools",
            file_picker_types: "image",
            myInit: {
                // images_upload_url: '/api/postImageUploader',
                images_dataimg_filter: function(img) {
                    return false;
                    return img.hasAttribute("internal-blob");
                },
                convert_urls: false,
                height: 1000,
                automatic_uploads: true,
                images_upload_handler: function(blobInfo, success, failure) {
                    let data = new FormData();
                    data.append("image", blobInfo.blob(), blobInfo.filename());
                    axios
                        .post("/api/postImageUploader", data)
                        .then(function(res) {
                            success(res.data.location);
                        })
                        .catch(function(err) {
                            failure("HTTP Error: " + err.message);
                        });
                }
            }
        };
    },
    components: {
        tinymce: Editor // <- Important part
    },
    created() {
        let uri = "/api/languages";
        this.axios.get(uri).then(response => {
            this.options = response.data;
        });
    },
    methods: {
        publishPost(evt) {
            evt.preventDefault();
            this.saving = true;
            let uri = "/api/savePost";
            if (
                this.post.title != "" &&
                this.post.body != "" &&
                this.post.language_id != "" &&
                this.post.featured != ""
            ) {
                const data = new FormData();
                data.append("title", this.post.title);
                data.append("body", this.post.body);
                data.append("language_id", this.post.language_id);
                data.append("featured", this.post.featured);

                this.axios
                    .post(uri, data)
                    .then(response => {
                        if (response.data.errors) {
                            this.message = "Error while creating post";
                            this.saving = false;
                        } else {
                            M.toast({ html: "Post created" });
                            this.$router.push({ name: "admin" }).catch(()=>{});
                        }
                        // console.log(response)
                    })
                    .catch(err => {
                        this.message = "Error while creating post";
                        console.log(err);
                        this.saving = false;
                    });
            } else if (
                this.post.title != "" &&
                this.post.body != "" &&
                this.post.language_id != "" &&
                this.post.featured == ""
            ) {
                const data = new FormData();
                data.append("title", this.post.title);
                data.append("body", this.post.body);
                data.append("language_id", this.post.language_id);

                this.axios
                    .post(uri, data)
                    .then(response => {
                        if (response.data.errors) {
                            this.message = "Error while creating post";
                            this.saving = false;
                        } else {
                            M.toast({ html: "Post created" });
                            this.$router.push({ name: "admin" }).catch(()=>{});
                        }
                        // console.log(response)
                    })
                    .catch(err => {
                        this.message = "Error while creating post";
                        this.saving = false;
                    });
            }
        }
    }
};
</script>
<style scoped>
.info {
    background-color: #e7f3fe;
    border-left: 6px solid #2196f3;
}
</style>
