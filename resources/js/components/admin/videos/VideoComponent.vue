<template>
  <div >
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
        <div v-else class="articles">
            <div class="row main-container">
                <h2>Video</h2>

                <div class="col m10"></div>
                <div class="col m2">
                    <router-link :to="{ name: 'create-vid' }" class="btn grey">Create</router-link>
                </div>
            </div><br />
            <div class="row">
                <div class="col s12 l9">
                    <table class="striped highlight responsive-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Video Name</th>
                                <th>Language</th>
                                <th>About</th>
                                <th>Youtube Embed Url</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="video in videos" :key="video.id">
                                <td>{{ video.id }}</td>
                                <td>{{ video.name }}</td>
                                <td>{{ video.language }}</td>
                                <td>{{ video.about }}</td>
                                <td>{{ video.youtubeEmbedUrl }}</td>
                                <td><router-link :to="{name: 'edit-course', params: { id: video.id }}" class="btn cyan"><i class="material-icons">edit</i></router-link></td>
                                <td><button class="btn red" :disabled="saving"  @click.prevent="deleteVideo(video.id)"><i class="material-icons">delete</i></button></td>
                            </tr>
                        </tbody>
                    </table>
                   
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                loaded: false,
                saving: false,
                videos: [],
                
            }
        },
        
        created() {
            let uri = '/api/getAllVideos';
            this.axios.get(uri).then(response => {
                setTimeout(() => {
                    this.loaded = true;
                    this.videos = response.data;
                }, 1000);
            })
            .catch(err => 
                console.log(err)
            )
        },
        methods: {
            deleteVideo(id)
            {
                this.saving = true
                let uri = `/api/deleteVideo/${id}`;
                this.axios.delete(uri).then(response => {
                    this.videos.splice(this.videos.findIndex(video => video.id === id), 1);
                    this.saving = false
                }).catch(err => {
                    console.log(err.response.header)
                    console.log(err.response.data)
                })
            },
        },

    }
</script>