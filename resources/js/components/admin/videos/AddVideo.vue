<template>

    <div class="container">
        <div class="articles">
            <div class="main-container">
                <center>
                    <h2>Add New Video</h2>
                    <div v-if="message" class="alert">{{ message }}</div>
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
                    <div class="row" v-else>
                        <form class="col s12" @submit="addVideo" enctype="multipart/form-data">
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
                                    <div class="col s4">
                                        <button :disabled="saving"  class="btn waves-effect" type="submit">{{ saving ? 'Creating...' : 'Create' }}</button>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="preview" v-model="videos.preview">
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
            loaded: false,
            message: false,
            videos: {},
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
			saving: false,
		}
    },
    created() {
        // let uri = `/api/editcourse/${this.$route.params.id}`;
        //     this.axios.get(uri).then((response) => {
                setTimeout(() => {
                    this.loaded = true
                }, 5000);
        //     });
        // let uri2 = '/api/languages';
        // this.axios.get(uri2).then(response => {
        //     this.options = response.data;
        //     console.log(response.data)
        // });
        M.AutoInit();
    },
    methods: {
      	addVideo(evt) {
            evt.preventDefault();
				this.saving = true
            
                this.videos.preview = false
				const data = new FormData();
				data.append('video', this.videos.video)
                data.append('preview', this.videos.preview) 
				data.append('section', this.videos.section)                
                data.append('about', this.videos.about)   
                data.append('name', this.videos.name) 
                data.append('course_id', this.$route.params.id)            
                               
				let uri = '/api/addVideo';
                this.axios.post(uri, data)
                .then((response) => {
                    M.toast({html: 'Video Added'})
					this.$router.push({name: 'admin'});
				})
				.catch(error => {
                    this.message = error.response.data.message || 'Invalid'
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
