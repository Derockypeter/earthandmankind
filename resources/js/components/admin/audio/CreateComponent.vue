<template>
    <div class="container">
        <div class="articles">
            <div class="main-container">
                <h1>Create A new Audio</h1>
                <ul v-if="message.length != 0 " class="alert">
                    <li v-for="mess in message" :key="mess">
                        {{ mess }}
                    </li>
                </ul>
                <div class="row">
                    <form
                        class="col s12"
                        @submit="publishAudio"
                        enctype="multipart/form-data"
                    >
                        <div class="row">
                            <div class="input-field col s6">
                                <input
                                    placeholder="Audio name"
                                    v-model="audio.name"
                                    id="name"
                                    type="text"
                                    required
                                    class="validate"
                                />
                            </div>
                            <div class="input-field col s6">
                                <textarea
                                    id="description"
                                    placeholder="Description"
                                    v-model="audio.description"
                                    class="validate materialize-textarea"
                                    required
                                ></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="file-field input-field col s6">
                                <div class="btn">
                                    <span>File</span>
                                    <input
                                        type="file"
                                        v-on:change="onImageChange"
                                    />
                                </div>
                                <div class="file-path-wrapper">
                                    <input
                                        class="file-path validate"
                                        name="image"
                                        type="text"
                                        placeholder="Upload Audio cover Image (if any)"
                                    />
                                </div>
                            </div>
                            <div class="file-field input-field col s6">
                                <div class="btn">
                                    <span>File</span>
                                    <input
                                        type="file"
                                        v-on:change="onPathChange"
                                    />
                                </div>
                                <div class="file-path-wrapper">
                                    <input
                                        class="file-path validate"
                                        name="path"
                                        type="text"
                                        placeholder="Upload Audio"
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s7">
                                    <select
                                        class="browser-default"
                                        v-model="audio.language_id"
                                    >
                                        <option value="" disabled selected
                                            >Select language for this
                                            Audio</option
                                        >
                                        <option
                                            v-for="option in options"
                                            :key="option.id"
                                            v-bind:value="option.id"
                                            >{{ option.language }}</option
                                        >
                                    </select>
                                </div>
                                <div class="col s5">
                                    <button
                                        :disabled="saving"
                                        class="btn waves-effect"
                                        type="submit"
                                    >
                                        {{
                                            saving ? "Publishing..." : "Publish"
                                        }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
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
            message: [],
            audio: {
                name: "",
                description: "",
                cover_image: null,
                language_id: "",
                audio_path: ""
            },
            options: []
        };
    },
    created() {
        let uri = "/api/languages";
        this.axios.get(uri).then(response => {
            this.options = response.data;
        });
    },
    methods: {
        publishAudio(evt) {
            evt.preventDefault();
            this.saving = true;
                const data = new FormData();
                data.append("name", this.audio.name);
                data.append("description", this.audio.description);
                data.append("language_id", this.audio.language_id);
                data.append("cover_image", this.audio.cover_image);
                data.append("audio_path", this.audio.audio_path);

                let uri = "/api/audio";
                this.axios
                    .post(uri, data)
                    .then(response => {
                        if (response.data == 200) {
                            this.$router.replace({ name: "admin" }).catch(()=>{});
                        }
                        else if(response.data.error){
                            this.message = response.data.error
                            this.saving = false
                        }
                    })
                    .catch(e => {
                        // this.message =
                        //     e.response ||
                        //     "There was an issue creating the Audio.";
                        this.saving = false;
                    });
           
        },
        onImageChange(event) {
            if (!event.target.files.length) return;

            this.audio.cover_image = event.target.files[0];
        },
        onPathChange(event) {
            if (!event.target.files.length) return;

            this.audio.audio_path = event.target.files[0];
        }
    }
};
</script>
