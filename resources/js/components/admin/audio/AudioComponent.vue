<template>
    <div class="container">
        <h1>Audio</h1>
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
                <div class="col m10"></div>
                <div class="col m2">
                    <router-link :to="{ name: 'create-audio' }" class="btn grey"
                        >Create Audio</router-link
                    >
                </div>
            </div>
            <br />
            <div class="row">
                <div
                    class="col s4 l4 card"
                    v-for="audio in audios"
                    :key="audio.id"
                >
                    <div
                        class="card-image waves-effect waves-block waves-light"
                    >
                        <img
                            class="activator"
                            :src="'/audio/images/' + audio.cover_image"
                        />
                    </div>
                    <div class="card-content">
                        <span
                            class="card-title activator grey-text text-darken-4 font-1"
                            >{{ audio.name
                            }}<i class="material-icons right"
                                >more_vert</i
                            ></span
                        >
                        <p>
                            <router-link
                                :to="{
                                    name: 'edit-audio',
                                    params: { id: audio.id }
                                }"
                                class="btn cyan pulse"
                                ><i class="material-icons">edit</i></router-link
                            >
                            <button
                                class="btn red right"
                                :disabled="saving"
                                @click.prevent="deleteAudio(audio.id)"
                            >
                                <i class="material-icons">delete</i>
                            </button>
                        </p>
                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4"
                            >{{ audio.name
                            }}<i class="material-icons right">close</i></span
                        >
                        <p>
                            <audio class="responsive-audio" controls>
                                <source
                                    :src="
                                        '/audio/audio_path/' + audio.audio_path
                                    "
                                    type="audio/mpeg"
                                />
                                Your browser does not support the audio element.
                            </audio>
                        </p>
                        <p>{{ audio.description.substr(0, 250) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped></style>
<script>
export default {
    data() {
        return {
            saving: false,
            loaded: false,
            audios: []
        };
    },
    created() {
        let uri = "/api/audio";
        this.axios
            .get(uri)
            .then(response => {
                setTimeout(() => {
                    this.loaded = true;
                    this.audios = response.data.audio;
                }, 1000);
            })
            .catch(err => console.error.response.data.data);
    },
    methods: {
        deleteAudio(id) {
            this.saving = true;
            let uri = `/api/audio/${id}`;
            this.axios
                .delete(uri)
                .then(response => {
                    M.toast({ html: "Audio deleted" });
                    this.audios.splice(
                        this.audios.findIndex(audio => audio.id === id),
                        1
                    );
                    this.saving = false;
                })
                .catch(err => {
                    this.saving = false;
                });
        }
    }
};
</script>
<style scoped>
.responsive-audio {
    width: 200px;
}
.font-1 {
    font-size: 1em;
}
</style>
