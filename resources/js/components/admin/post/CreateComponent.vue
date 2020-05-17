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
                                    <select class="browser-default" v-model="post.category_id">
                                        <option value="" disabled selected>Select Category</option>
                                        <option v-for="option in options" :key="option.id" :value="option.id" v-text="option.categoryName"></option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <textarea id="body" class="materialize-textarea" v-model="post.body" placeholder="Type post"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="file-field input-field col s9">
                                    <div class="btn">
                                        <span>File</span>
                                        <input type="file" v-on:change="onImageChange">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" 
                                            name="image" type="text" placeholder="Upload Image" v-model="post.imageName">
                                    </div>
                                </div>
                                <button  class="btn waves-effect" type="submit">{{ saving ? 'Creating...' : 'Create' }}</button>
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
				imageName: null,
				category_id: ''
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
			data.append('imageName', this.post.imageName)
            let uri = 'http://127.0.0.1:8000/api/publishPost';
			this.axios.post(uri, data)
				.then((response) => {
					this.$router.push({name: 'admin'});
				})
				.catch(err => {
                    this.message = err.response.data || 'Error while creating post'
                    this.saving = false
                });
		},
		onImageChange(event) {
			if(!event.target.files.length) return;

			this.post.imageName = event.target.files[0];
		},
    }
  }
</script>
