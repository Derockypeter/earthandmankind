<template>

    <div class="container">
        <div class="articles">
            <div class="main-container">
                <center>
                    <h2>Create New Course</h2>
                    <div v-if="message" class="alert">{{ message }}</div>
                    <div class="row">
                        <form class="col s12" @submit="createVideo" enctype="multipart/form-data" novalidate>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input v-model="videos.coursename" name="coursename" required placeholder="Enter Name of this Course" type="text" class="validate">
                                </div>
                                <div class="input-field col s6">
                                    <input v-model="videos.requirements" name="requirements" required placeholder="Enter Course Requirements" type="text" class="validate">
                                </div>
                            </div>
                            <div class="row">
                               <div class="input-field col s12">
                                    <textarea v-model="videos.to_learn" name="to_learn" required placeholder="What are we going to learn" type="text" class="validate"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <textarea id="description" class="materialize-textarea" required placeholder="Please enter a description for this course" v-model="videos.description" ></textarea>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="input-field col s12">
                                    <select v-model="videos.language_id" required class="browser-default">
                                        <option value="" selected>Select language</option>
                                        <option v-for="option in options" v-bind:value="option.id" :key="option.id" >{{option.language}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="file-field input-field col s12">
                                    <div class="btn">
                                        <span>File</span>
                                        <input type="file" v-on:change="onImageChange">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate"  v-model="videos.image"
                                          name="videoName"
                                          placeholder="Choose an Image or drop it here..."
                                          required>
                                    </div>
                                </div>
                            </div>
                            <div class="video">
                                <h6>Video</h6>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input v-model="videos.name" name="name" required type="text" class="validate" placeholder="Enter name of video">
                                    </div>
                                    <div class="input-field col s6">
                                        <select v-model="videos.section" required class="browser-default">
                                            <option value="" selected>Which section will I attach this video</option>
                                            <option v-for="section in sections" v-bind:value="section.value" :key="section.id">{{section.text}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <textarea v-model="videos.about" name="about" required type="text" class="validate materialize-textarea" placeholder="About this video"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="file-field input-field col s12">
                                        <div class="btn">
                                            <span>File</span>
                                            <input type="file" v-on:change="onVideoChange">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path validate"  v-model="videos.video"
                                            name="videoName"
                                            placeholder="Choose a video or drop it here... One video per upload"
                                            required>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="row">
                                    <div class="col s8">
                                        <select v-model="videos.preview" required class="browser-default">
                                            <option value="" selected>Select preview for this course</option>
                                            <option v-for="preview in previews" v-bind:value="preview.value" :key="preview.value" >{{preview.text}}</option>
                                        </select>
                                    </div>
                                    <div class="col s4">
                                        <button :disabled="saving"  class="btn waves-effect" type="submit">{{ saving ? 'Creating...' : 'Create' }}</button>
                                    </div>
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
			videos: {
                preview: '',
                description: '',
                video: null,
				language_id: '',
                coursename: '',
                name: '',
                section: '',
                about: '',
                requirements: '',
                image: null,
                to_learn: '',
			},
			options: [],
			novalidate: true,
			saving: false,
		}
    },
    created() {
      let uri = '/api/languages';
      this.axios.get(uri).then(response => {
		this.options = response.data;
		// console.log(response.data)
      });
      M.AutoInit();
    },
    methods: {
      	createVideo(evt) {
			evt.preventDefault();
			// if(this.video.title != '' && this.video.videoName != '' && this.video.category_id != ''){
				this.saving = true
				const data = new FormData();
				data.append('language_id', this.videos.language_id)
				data.append('video', this.videos.video)
				data.append('coursename', this.videos.coursename)
                data.append('description', this.videos.description)
                data.append('preview', this.videos.preview) 
				data.append('section', this.videos.section)                
                data.append('about', this.videos.about)   
                data.append('requirements', this.videos.requirements)
                data.append('image', this.videos.image)
                data.append('to_learn', this.videos.to_learn)
                data.append('name', this.videos.name)             
                                              
				let uri = '/api/saveVideo';
                this.axios.post(uri, data)
                .then((response) => {
                    this.$router.push({name: 'admin'});
                    this.saving = false
				})
				.catch(error => {
                    // this.message = error.response || 'Invalid'
                    this.saving = false
				})
			
		},
		onVideoChange(event) {
			this.videos.video = event.target.files[0];
        },
        onImageChange(event) {
			this.videos.image = event.target.files[0];
		},
    }
  }
</script>
