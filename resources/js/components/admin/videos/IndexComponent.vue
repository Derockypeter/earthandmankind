<template>
  <b-container>
      <h1>Videos</h1>
        <div class="row">
            <div class="col-md-10"></div>
            <div class="col-md-2">
                <router-link :to="{ name: 'create-vid' }" class="btn btn-primary">Create Video</router-link>
            </div>
        </div><br />

        <table class="table table-hover">
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
                    <td><router-link :to="{name: 'edit-video', params: { id: video.id }}" class="btn btn-primary">Edit</router-link></td>
                    <td><button class="btn btn-danger" @click.prevent="deleteVideo(video.id)">Delete</button></td>
                </tr>
            </tbody>
        </table>
    </b-container>
</template>

<script>
    export default {
        data() {
            return {
                videos: [],
            }
        },
        created() {
            let uri = 'http://127.0.0.1:8000/api/getAllVideos';
            this.axios.get(uri).then(response => {
                this.videos = response.data.data;
                console.log(response.data)
            })
            .catch(err => 
                console.error.response.data
            )
        },
        methods: {
            deleteVideo(id)
            {
                let uri = `http://127.0.0.1:8000/api/deleteVideo/${id}`;
                this.axios.delete(uri).then(response => {
                    console.log(response)
                    this.videos.splice(this.videos.findIndex(video => video.id === id), 1);
                }).catch(err => {
                    console.log(err.response.header)
                    console.log(err.response.data)
                })
            }
        },

    }
</script>