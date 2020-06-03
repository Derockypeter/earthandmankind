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
                                    <input v-model="video.coursename" name="coursename" required placeholder="Enter Name of this Course" type="text" class="validate">
                                </div>
                                <div class="input-field col s6">
                                    <input v-model="video.name" disabled name="name" required type="text" class="validate">
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <select v-model="video.category_id" required class="browser-default">
                                        <option value="" disabled selected>Select Category</option>
                                        <option disabled v-for="option in options" v-bind:value="option.id" :key="option.id" >{{option.categoryName}}</option>
                                    </select>
                                </div>
                                <div class="input-field col s6">
                                    <select v-model="video.section" required class="browser-default">
                                        <option value="" disabled selected>Which section will I attach this video</option>
                                        <option disabled v-for="section in sections" v-bind:value="section.id" :key="section.id" >{{section.text}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="file-field input-field col s12">
                                    <div class="btn">
                                        <span>File</span>
                                        <input type="file" v-on:change="onVideoChange">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate"  v-model="video.video"
                                          name="videoName"
                                          placeholder="Choose a video or drop it here... One video per upload"
                                          required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <textarea id="description" class="materialize-textarea" required placeholder="Please enter a description for the course" v-model="video.description" ></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s8">
                                     <select v-model="video.preview" required class="browser-default">
                                        <option value="" disabled selected>Select a preview for the course</option>
                                        <option v-for="preview in previews" v-bind:value="preview.value" :key="preview.value" >{{preview.text}}</option>
                                    </select>
                                </div>
                                <div class="col s4">
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

  export default {
    data() {
		return {
            message: false,
            sections: [
                {text: 'Section 1', value: '1'},
                {text: 'Section 2', value: '2'},
                {text: 'Section 3', value: '3'},
                {text: 'Section 4', value: '4'},
                {text: 'Section 5', value: '5'},
                {text: 'Section 6', value: '6'},
                {text: 'Section 7', value: '7'},
                {text: 'Section 8', value: '8'},
                {text: 'Section 9', value: '9'},
                {text: 'Section 10', value: '10'},

            ],
            previews: [
                    {text: 'False', value: 'false'},
                    {text: 'True', value: 'true'}
                ],
			video: {
                preview: '',
                description: '',
                video: null,
				category_id: '',
                coursename: '',
                name: '',
                section: '',
			},
			options: [],
			novalidate: true,
			saving: false,
		}
    },
    created() {
      let uri = '/api/getAllCat';
      this.axios.get(uri).then(response => {
		this.options = response.data;
		console.log(response.data)
      });
      M.AutoInit();
    },
    methods: {
      	createVideo(evt) {
			evt.preventDefault();
			// if(this.video.title != '' && this.video.videoName != '' && this.video.category_id != ''){
				this.saving = true
				const data = new FormData();
				data.append('category_id', this.videos.category_id)
				data.append('video', this.videos.video)
				data.append('coursename', this.videos.coursename)
                data.append('description', this.videos.description)
                data.append('preview', this.videos.preview) 
				data.append('section', this.videos.section)                
				data.append('name', this.videos.name)                
                                              
				let uri = '/api/saveVideo';
                this.axios.post(uri, data)
                .then((response) => {
					this.$router.push({name: 'admin'});
				})
				.catch(error => {
					this.message = error.response || 'Invalid'
				})
			
		},
		onVideoChange(event) {
			this.video.video = event.target.files[0];
		},
    }
  }
</script>
