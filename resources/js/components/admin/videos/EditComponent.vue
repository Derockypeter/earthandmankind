<template>
  <b-container>
    <h1>Edit Video</h1>
    <b-form @submit="updateCategory">
        <p size="sm">{{videos.videoName}}</p>
        <b-form-group id="input-group-1" label="Title:" label-for="input-1">
            <b-form-input
                id="input-1"
                v-model="videos.title"
                name="title"
                required
                placeholder="Enter Title">
            </b-form-input>
        </b-form-group>
        <b-form-group id="input-group-2" label="Video:" label-for="category">
            <b-form-file
            	accept="video/*"
                v-on:change="onVideoChange"
                name="videoName"
                placeholder="Choose a video or drop it here... One video per upload"
                drop-placeholder="Drop file here..."
                size="sm"
            ></b-form-file>
        </b-form-group>
         <b-form-select v-model="videos.category_id" class="mb-3" size="sm" required>
            <b-form-select-option :value="null">Please select an option</b-form-select-option>
            <b-form-select-option v-for="option in options" :key="option.id" v-bind:value="option.id">{{ option.categoryName }}</b-form-select-option>
        ></b-form-select>
        <b-row class="ml-auto">
            <b-col>
                <b-button type="submit" pill variant="secondary">Update</b-button>
            </b-col>
        </b-row>
    </b-form>
  </b-container>
</template>

<script>
    export default {

        data() {
            return {
                videos: {},
                options: [],
            }
        },
        created() {
            let uri = `http://127.0.0.1:8000/api/edit/${this.$route.params.id}`;
            this.axios.get(uri).then((response) => {
                this.videos = response.data;
                console.log(response.data)
            });
            let uri2 = 'http://127.0.0.1:8000/api/getAllCat';
            this.axios.get(uri2).then(response => {
                this.options = response.data;
                console.log(response.data)

            });
        },
        methods: {
            updateCategory(evt) {
                evt.preventDefault();
                let uri = `http://127.0.0.1:8000/api/updateVideo/${this.$route.params.id}`;
                const data = new FormData();
                data.append('category_id', this.videos.category_id)
                data.append('videoName', this.videos.videoName)
                data.append('title', this.videos.title)
                this.axios.put(uri, data).then((response) => {
                    console.response
                    this.$router.push({name: 'admin'});
                }).catch(err => {
                    console.log(err.response.data)
                    console.log(err.response.header)
                })
            },
            onVideoChange(event) {
                if(!event.target.files.length) return;
                // let reader = new FileReader();
                // reader.readAsDataURL(file);
                // reader.onload = event => {
                //     let src = event.target.result;
                //     this.$emit('loaded', {src, file});
                // }
                console.log(event.target.files[0])
                this.videos.videoName = event.target.files[0];
            },
        }
    }
</script>