<template>
    <div class="container">
        <div class="articles">
            <div class="main-container">
                <center>
                    <h2>Create New Post</h2>
                    <div v-if="message" class="alert">{{ message }}</div>
                    <div class="row">
                        <form class="col s12" @submit="publishPost" enctype="multipart/form-data">
                            <div class="row">
                                <div class="input-field col s6">
                                    <input v-model="post.title" name="title" required placeholder="Enter Title" type="text" class="validate">
                                </div>
                                <div class="input-field col s6">
                                    <input v-model="post.imagename" name="imagename" required placeholder="Enter name for image" type="text" class="validate">
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <textarea id="body" class="materialize-textarea" v-model="post.body" placeholder="Type post"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <select class="browser-default" v-model="post.category_id">
                                        <option value="" disabled selected>Select Category</option>
                                        <option v-for="option in options" :key="option.id" :value="option.id" v-text="option.categoryName"></option>
                                    </select>
                                </div>
                                <div class="file-field input-field col s6">
                                    <div class="btn">
                                        <span>File</span>
                                        <input type="file" v-on:change="onImageChange">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" 
                                            name="image" type="text" placeholder="Upload Image" v-model="post.image">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="info">
                                    <p><strong>Info!</strong> Please check this box if you want to make the post to be featured.</p>
                                </div>
                                <p>
                                    <label>
                                        <input id="indeterminate-checkbox" v-model="post.featured" value="1" type="checkbox" />
                                        <span>Featured Post</span>
                                    </label>
                                </p>
                                <button :disabled="saving" class="btn waves-effect" type="submit">{{ saving ? 'Creating...' : 'Create' }}</button>
                            </div>
                        </form>
                    </div>
                </center>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    data() {
		return {
			saving: false,
			message: false,
			post: {
				title: '',
				body: '',
				image: null,
                category_id: '',
                name: '',
                imagename: '',
                featured: ''
			},
			options: [],
		}
    },
    created() {
		let uri = 'http://127.0.0.1:8000/api/getAllCat';
		this.axios.get(uri).then(response => {
            this.options = response.data;
		});
    },
    methods: {
		publishPost(evt) {
            evt.preventDefault();
            this.saving = true
			const data = new FormData();
			data.append('title', this.post.title)
			data.append('body', this.post.body)
			data.append('category_id', this.post.category_id)
            data.append('image', this.post.image)
			data.append('imagename', this.post.imagename)
            data.append('featured', this.post.featured)
            
            let uri = '/api/savePost';
			this.axios.post(uri, data)
				.then((response) => {
                    console.log(response)
					// this.$router.push({name: 'admin'});
				})
				.catch(err => {
                    this.message = err.response.data || 'Error while creating post'
                    this.saving = false
                });
		},
		onImageChange(event) {
			if(!event.target.files.length) return;

			this.post.image = event.target.files[0];
		},
    }
  }
</script>
<style scoped>
    .info {
        background-color: #e7f3fe;
        border-left: 6px solid #2196F3;
    }
</style>
