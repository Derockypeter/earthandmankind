<template>
<div class="container">
        <div class="articles">
            <div class="main-container">
				<h1>Edit Video</h1>
                <div v-if="message" class="alert">{{ message }}</div>
                <div v-if="! loaded">Loading...</div>
                <div v-else-if="loaded" class="row">
                    <form class="col s12" @submit.prevent="updateCategory" enctype="multipart/form-data">
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="input-1"
                                    v-model="videos.title"
                                    name="title"
                                    required
                                    placeholder="Enter Title" type="text" class="validate">
                            </div>
                            <div class="input-field col s6">
                                <select v-model="videos.category_id" class="browser-default">
                                    <option value="" disabled selected>Select Category</option>
                                    <option v-for="option in options" :key="option.id" v-bind:value="option.id">{{ option.categoryName }}</option>
                                </select>
                            </div>
                            <button class="btn waves-effect" :disabled="saving" type="submit">Edit</button>

                        </div>
                        <!-- <div class="row"> -->
                            
                            <!-- <div class="file-field input-field col s4">
                                <div class="btn">
                                    <span>File</span>
                                    <input type="file">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" 
										accept="video/*"
                                        v-on:change="onVideoChange"
                                        name="videoName"
                                        placeholder="Choose a video or drop it here... One video per upload"
                                        drop-placeholder="Drop file here..."">
                                </div>
                            </div> -->
                        <!-- </div> -->
                    </form>
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
                videos: {},
                options: [],
            }
        },
        created() {
            let uri = `http://127.0.0.1:8000/api/edit/${this.$route.params.id}`;
            this.axios.get(uri).then((response) => {
                setTimeout(() => {
                    this.loaded = true
                    this.videos = response.data;
                console.log(response.data)

                }, 5000);
            });
            let uri2 = 'http://127.0.0.1:8000/api/getAllCat';
            this.axios.get(uri2).then(response => {
                this.options = response.data;

            });
        },
        methods: {
            updateCategory(evt) {
                evt.preventDefault();
                this.saving = true
                // console.log(this.videos)
                let uri = `http://127.0.0.1:8000/api/updateVideo/${this.$route.params.id}`;
                const data = new FormData();
                data.append('category_id', this.videos.category_id)
                // data.append('videoName', this.videos.videoName)
                data.append('title', this.videos.title)
                this.axios.put(uri, data).then((response) => {
                    this.$router.push({name: 'admin'});
                }).catch(err => {
                    this.message = err.response.data.message 
                    this.saving = false
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