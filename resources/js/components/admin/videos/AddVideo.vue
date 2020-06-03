<template>

    <div class="container">
        <div class="articles">
            <div class="main-container">
                <center>
                    <h2>Add New Video</h2>
                    <div v-if="message" class="alert">{{ message }}</div>
                    <div class="row">
                        <form class="col s12" @submit="addVideo" enctype="multipart/form-data">
                            <div class="row">
                                <div class="input-field col s6">
                                    <input v-model="videos.coursename" disabled name="coursename" required type="text" class="validate">
                                </div>
                                <div class="input-field col s6">
                                    <input v-model="videos.name" disabled name="name" required type="text" class="validate">
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <select v-model="videos.category_id" required class="browser-default">
                                        <!-- <option value="" disabled selected>Select Category</option> -->
                                        <option disabled v-for="option in options" v-bind:value="option.id" :key="option.id" >{{option.categoryName}}</option>
                                    </select>
                                </div>
                                <div class="input-field col s6">
                                    <select v-model="videos.section" required class="browser-default">
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
                                        <input class="file-path validate"
                                          name="videoName"
                                          placeholder="Choose a video... One video per upload"
                                          required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <textarea id="description" disabled class="materialize-textarea" required placeholder="Please enter a description for the course" v-model="videos.description" ></textarea>
                                </div>
                            </div>
                        
                            <input type="hidden" name="preview" v-model="videos.preview">
                            <div class="col s4">
                                <button :disabled="saving"  class="btn waves-effect" type="submit">{{ saving ? 'Creating...' : 'Create' }}</button>
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
			options: [],
			saving: false,
		}
    },
    created() {
        let uri = `/api/editcourse/${this.$route.params.id}`;
            this.axios.get(uri).then((response) => {
                setTimeout(() => {
                    this.loaded = true
                    this.videos = response.data[0];
                    console.log(response)
                }, 5000);
            });
        let uri2 = '/api/getAllCat';
        this.axios.get(uri2).then(response => {
            this.options = response.data;
            console.log(response.data)
        });
        M.AutoInit();
    },
    methods: {
      	addVideo(evt) {
            evt.preventDefault();
				this.saving = true
            
                this.videos.preview = false
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
                    M.toast({html: 'Video Added'})
					this.$router.push({name: 'admin'});
				})
				.catch(error => {
					this.message = error.response.data.message || 'Invalid'
				})
		},
		onVideoChange(event) {
			this.videos.video = event.target.files[0];
		},
    }
  }
</script>
