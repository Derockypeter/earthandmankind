<template>
  <div class="container">
        <div class="articles">
            <div class="main-container">
				<h1>Edit Post</h1>
                <div v-if="message" class="alert">{{ message }}</div>
                <div v-if="!loaded">Loading...</div>
                <div class="row" v-else>
                    <form class="col s12" @submit.prevent="updatePost" enctype="multipart/form-data">
                        <div class="row">
                            <div class="input-field col s6">
                                <input v-model="post.title" id="title" type="text" class="validate" required>
                            </div>
                             <div class="input-field col s6">
                                <select v-model="post.language_id" class="browser-default">
                                    <option :value="null" disabled selected>Select Language</option>
                                    <option v-for="option in options" :key="option.id" v-bind:value="option.id">{{ option.language }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <tinymce v-model="post.body"
                                    :plugins="myPlugins" 
                                    :toolbar ="myToolbar1"
                                    :init="myInit"
                                >
                                </tinymce> 
                            </div>
                        </div>
                        <div class="row">
                           
                            <!-- <div class="file-field input-field col s4">
                                <div class="btn">
                                    <span>File</span>
                                    <input type="file">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" 
										v-on:change="onImageChange"
										name="imageName"
										v-model="post.imageName"
										placeholder="Choose a file or drop it here...">
                                </div>
                            </div> -->
                            <button class="btn waves-effect" :disabled="saving" type="submit">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import Editor from '@tinymce/tinymce-vue';

    export default {
        data() {
            return {
				saving: false,
				loaded: false,
				message: false,
                post: {
                    // image: {}
                },
                options: [],
                myToolbar1: 'undo redo | bold italic underline preview | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                myPlugins: "link image code preview imagetools insertdatetime paste spellchecker autosave",
                myInit: {
                    automatic_uploads: false, 
                    images_upload_url: '/api/upload-image',  
                    // images_upload_handler: function (blobInfo, success, failure) {
                    //     var xhr, formData;
                    //     xhr = new XMLHttpRequest();
                    //     xhr.withCredentials = false;
                    //     xhr.open('POST', '/api/upload-image');
                    //     var token = document.head.querySelector("[name=csrf-token]").content;
                    //     xhr.setRequestHeader("X-CSRF-Token", token);
                    //     xhr.onload = function() {
                    //     var json;

                    //     if (xhr.status != 200) {
                    //         failure('HTTP Error: ' + xhr.status);
                    //         return;
                    //     }
                    //     json = JSON.parse(xhr.responseText);

                    //     if (!json || typeof json.location != 'string') {
                    //         failure('Invalid JSON: ' + xhr.responseText);
                    //         return;
                    //     }
                    //     success(json.location);
                    //     };
                    //     formData = new FormData();
                    //     formData.append('file', blobInfo.blob(), blobInfo.filename());
                    //     xhr.send(formData);
                    // } 
                },
            }
        },
        components: {
            'tinymce': Editor // <- Important part
        },
        created() {
            let uri = `/api/editPost/${this.$route.params.id}`;
            this.axios.get(uri).then((response) => {
				setTimeout(() => {
                    this.loaded = true;
                    this.post = response.data;
                    console.log(response.data)
                }, 5000);
			});
			let uri2 = '/api/languages';
			this.axios.get(uri2).then(response => {
				this.options = response.data;
			});
        },
        methods: {
            updatePost() {
				this.saving = true
                let uri = `/api/post/${this.$route.params.id}`;
				this.axios.put(uri, this.post).then((response) => {
					M.toast({html: 'Post updated'})
					this.$router.push({name: 'admin'});
				}).catch(err => {
                    this.message = err.response.data
                    this.saving = false
				});
            },
            // onImageChange(event) {
            //     this.post.imageName = event.target.files[0];
            // },
        }
    }
</script>