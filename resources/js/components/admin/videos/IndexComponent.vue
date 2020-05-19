<template>
  <div class="container">
      <h1>Videos</h1>
        <div class="row">
            <div class="col m10"></div>
            <div class="col m2">
                <router-link :to="{ name: 'create-vid' }" class="btn grey">Create Video</router-link>
            </div>
        </div><br />

        <table class="striped highlight responsive-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Video</th>
                    <th>Category</th>
                    <th>Title</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="video in videos" :key="video.id">
                    <td>{{ video.id }}</td>
                    <td>{{ video.videoName }}</td>
                    <td>{{ video.categoryName }}</td>
                    <td>{{ video.title }}</td>
                    <td><router-link :to="{name: 'edit-video', params: { id: video.id }}" class="btn cyan pulse"><i class="material-icons">edit</i></router-link></td>
                    <td><button class="btn red" :disabled="saving"  @click.prevent="deleteVideo(video.id)"><i class="material-icons">delete</i></button></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios'
    export default {
        data() {
            return {
                saving: false,
                videos: [],
            }
        },
        created() {
            let uri = 'http://127.0.0.1:8000/api/getAllVideos';
            axios.get(uri).then(response => {
                this.videos = response.data.data;
            })
            .catch(err => 
                console.error.response.data
            )
        },
        methods: {
            deleteVideo(id)
            {
                this.saving = true
                let uri = `http://127.0.0.1:8000/api/deleteVideo/${id}`;
                axios.delete(uri).then(response => {
                    console.log(response)
                    this.videos.splice(this.videos.findIndex(video => video.id === id), 1);
                    this.saving = false
                }).catch(err => {
                    console.log(err.response.header)
                    console.log(err.response.data)
                })
            }
        },

    }
</script>