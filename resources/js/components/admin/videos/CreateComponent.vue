<template>

    <div class="container">
        <div class="articles">
            <div class="main-container">
                <center>
                    <h2>Create New Course</h2>
                    <div v-if="error.length > 0" class="red">
                        <div v-for="err in error" class="collection">
                            <a class="white-text collection-item">{{ err }}</a>
                        </div>
                    </div>
                    <div class="row">
                        <form class="col s12" @submit="createVideo" enctype="multipart/form-data" novalidate>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input v-model="video.name" name="name" required type="text" class="validate" placeholder="Enter name of video">
                                </div> 
                                <div class="input-field col s12">
                                    <input v-model="video.youtubeEmbedUrl" name="youtubeEmbedUrl" required type="text" class="validate" placeholder="//www.youtube.com/embed/Q8TXgCzxEnw?rel=0">
                                </div>  
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <textarea v-model="video.about" name="about" required placeholder="About the video" type="text" class="validate materialize-textarea"></textarea>
                                </div>
                            </div>
                                <button :disabled="saving"  class="btn waves-effect center" type="submit">{{ saving ? 'Creating...' : 'Create' }}</button>
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
            
			video: {
                about: '',
                video: null,
				language_id: '',
                name: '',
                youtubeEmbedUrl: ""
			},
			novalidate: true,
			saving: false,
            error: [],
		}
    },
    created() {
      let uri = '/api/languages';
      this.axios.get(uri).then(response => {
		this.options = response.data;
      });
      M.AutoInit();
    },
    methods: {
      	createVideo(evt) {
			evt.preventDefault();
				this.saving = true                              
				let uri = '/api/addVideo';
                this.axios.post(uri, this.video)
                .then((response) => {
                    if (response.data.success == 200){
                        this.$router.push({name: 'admin'}).catch(()=>{});
                    }
                    else if (response.data.error) {
                        this.error = response.data.error
                    }
                    this.saving = false

				})
				.catch(error => {
                    // this.message = error.response || 'Invalid'
                    this.saving = false
				})
			
		},
    }
  }
</script>
