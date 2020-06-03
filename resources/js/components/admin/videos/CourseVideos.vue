<template>
    <div class="container dark">
        <div class="articles">
            <div class="main-container">
                <h4>Videos</h4>
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
                <div v-else>
                    <div class="row">
                        <div class="col s12 l12">
                            <table class="striped highlight responsive-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Coursename</th>
                                        <th>Preview</th>
                                        <th>Section</th>
                                        <th>Name</th>
                                        <th>Created on</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(video,index) in videos" :key="index">
                                        <td>{{index+1}}</td>
                                        <td>{{ video.videoName }}</td>
                                        <td>{{ video.preview }}</td>
                                        <td>{{video.section}}</td>
                                        <td>{{video.name}}</td>
                                        <td>{{ (video.created_at).substr(0, 10) }}</td> <!--MAke a computed func for substring-->
                                        <td><button class="btn red" :disabled="saving"  @click.prevent="deleteVideo(video.id)"><i class="material-icons">delete</i></button></td>
                                    </tr>
                                </tbody>
                            </table>
                        
                        </div>
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
                saving: false,
                loaded: false,
                videos: [],
            }
        },
        
        created() {
            let uri = `/api/course/${this.$route.params.id}`;
            this.axios.get(uri).then(response => {
                setTimeout(() => {
                    this.loaded = true;
                    this.videos = response.data;
                    console.log(response)
                }, 5000);
            })
            .catch(err => 
                console.error.response.data
            )
        },
        methods: {
            deleteVideo(id)
            {
                this.saving = true
                let uri = `/api/deleteVideo/${id}`;
                this.axios.delete(uri).then(response => {
                    console.log(response)
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
