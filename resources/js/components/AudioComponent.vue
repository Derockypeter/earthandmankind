<template>
    <div class="container articles">
        <div class="main-container">
            <h1>Audio</h1>
            <div class="row">
                <div class="col s12 m7" v-for="audio in audios" :key="audio.id">
                    <div class="card horizontal" >
                        <div class="card-image">
                           <img
                            :src="'/audio/images/' + audio.cover_image"
                        />
                        </div>
                        <div class="card-stacked">
                            <div class="card-content">
                                <p>
                                    <audio class="responsive-audio" controls>
                                        <source
                                            :src="
                                                '/audio/audio_path/' +
                                                    audio.audio_path
                                            "
                                            type="audio/mpeg"
                                        />
                                        Your browser does not support the audio
                                        element.
                                    </audio>
                                </p>
                                <p>
                                    {{ audio.description }}
                                </p>
                            </div>
                            <div class="card-action">
                                <a>{{ audio.name }}</a>
                            </div>
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
            audios: []
        }
    },
    created() {
        let uri = "/api/audio";
        this.axios
            .get(uri)
            .then(response => {
                setTimeout(() => {
                    this.audios = response.data.audio;
                }, 1000);
            })
            // .catch(err => console.error.response.data.data);
    },
};
</script>
<style scoped>
.articles {
    margin-top: 2vh;
    box-shadow: 13px 13px 20px grey;
}
.responsive-audio {
    width: 200px;
}
</style>
