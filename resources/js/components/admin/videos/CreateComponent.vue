<template>

    <div class="container">
        <div class="articles">
            <div class="main-container">
                <center>
                    <h2>Create New Video</h2>
                    <div v-if="message" class="alert">{{ message }}</div>
                    <div class="row">
                        <form class="col s12" @submit="createVideo" enctype="multipart/form-data" novalidate>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input v-model="video.title" name="title" required placeholder="Enter Title" type="text" class="validate">
                                </div>
                                <div class="input-field col s6">
                                    <select v-model="video.category_id" required class="browser-default">
                                        <option value="" disabled selected>Select Category</option>
                                        <option v-for="option in options" v-bind:value="option.id" :key="option.id" >{{option.categoryName}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="file-field input-field col s9">
                                    <div class="btn">
                                        <span>File</span>
                                        <input type="file" v-on:change="onVideoChange">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate"  v-model="video.videoName"
                                          name="videoName"
                                          placeholder="Choose a video or drop it here... One video per upload"
                                          required>
                                    </div>
                                </div>
								<div class="col s3">
                                	<button :disabled="saving"  class="btn waves-effect" type="submit">{{ saving ? 'Creating...' : 'Create' }}</button>
                            	</div>
                            </div>
                        </form>
                    </div>
                </center>
            </div>
        </div>
    </div>
    
</template>

<script>
    import axios from 'axios'
    import router from '../../../router.js'

  export default {
    data() {
		return {
			message: false,
			video: {
                videoName: null,
				category_id: '',
				title: '',
			},
			options: [],
			novalidate: true,
			saving: false,
		}
    },
    created() {
      let uri = 'http://127.0.0.1:8000/api/getAllCat';
      axios.get(uri).then(response => {
		this.options = response.data;
		console.log(response.data)
      });
    },
    methods: {
      	createVideo(evt) {
			evt.preventDefault();
			// if(this.video.title != '' && this.video.videoName != '' && this.video.category_id != ''){
				this.saving = true
				const data = new FormData();
				data.append('category_id', this.video.category_id)
				data.append('videoName', this.video.videoName)
				data.append('title', this.video.title)
				let uri = 'http://127.0.0.1:8000/api/saveVideo';
				axios.post(uri, data).then((response) => {
					router.push({name: 'admin'});
				})
				.catch(err => {
					this.message = err.response.data || err.response.header || 'Invalid'
				})
			
		},
		onVideoChange(event) {
			this.video.videoName = event.target.files[0];
		},
    }
  }
</script>
