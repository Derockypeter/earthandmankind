<template>
<div class="container">
        <div class="articles">
            <div class="main-container">
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
                <div v-else class="row">
    				<h1>Edit Video</h1>
                    <div v-if="message" class="alert">{{ message }}</div>
                    <div class="row">
                        <form class="col s12" @submit="updateVideo" novalidate>
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
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                message: false,
                loaded: false,
                saving: false,
                video: [],
                options: [],
            }
        },
        created() {
            let uri = `/api/video/${this.$route.params.id}`;
            this.axios.get(uri).then((response) => {
                setTimeout(() => {
                    this.loaded = true
                    this.video = response.data;
                }, 5000);
            });
            let uri2 = '/api/languages';
            this.axios.get(uri2).then(response => {
                this.options = response.data;

            });
        },
        methods: {
            updateVideo(evt) {
                evt.preventDefault();
                this.saving = true
                let uri = `/api/updateVideo/${this.$route.params.id}`;
                this.axios.put(uri, this.video).then((response) => {
                    if(response.data === 1){
                        this.$router.push({name: 'admin'}).catch(()=>{});
                        M.toast({html: "Video Updated Successfuly"})
                    }
                }).catch(error => {
                    this.message = error 
                    this.saving = false
                    console.log(error)
                })
            },
        }
    }
</script>