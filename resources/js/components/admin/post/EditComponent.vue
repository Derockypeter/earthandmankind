<template>
  <div class="container">
        <div class="articles">
            <div class="main-container">
				<h1>Edit Post</h1>
                <div v-if="message" class="alert">{{ message }}</div>
                <div v-if="! loaded">Loading...</div>
                <div class="row">
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
                                <textarea id="description" v-model="post.body" class="validate materialize-textarea"></textarea>
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
            }
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