<template>
  <div class="container">
        <div class="articles">
            <div class="main-container">
                <div v-if="message" class="alert">{{ message }}</div>
                <div v-if="! loaded">Loading...</div>
                <div v-else class="row">
                    <form class="col s12" @submit="updateAudio" enctype="multipart/form-data">
                        <div class="row">
                            <div class="input-field col s6">
                                <input v-model="audio.name" id="name" type="text" class="validate">
                            </div>
                            <div class="input-field col s6">
                                <textarea id="description" v-model="audio.description" class="validate materialize-textarea"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <select v-model="audio.language_id" class="browser-default">
                                    <option :value="null" disabled selected>Select Category</option>
                                    <option v-for="option in options" :key="option.id" v-bind:value="option.id">{{ option.language }}</option>
                                </select>
                            </div>
                           
                            <button class="btn waves-effect" :disabled="saving" type="submit">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    
</style>
</template>

<script>
    export default {
        data() {
            return {
                message: false,
                loaded: false,
                saving: false,
                audio: {},
                options: [],
            }
        },
        created() {
            let uri = `/api/audiop/${this.$route.params.id}`;
            this.axios.get(uri).then((response) => {
                setTimeout(() => {
                    this.loaded = true;
                    this.audio = response.data;
                    console.log(response)
                }, 5000);
			});
			let uri2 = '/api/languages';
			this.axios.get(uri2).then(response => {
				this.options = response.data;
			});
        },
        methods: {
            updateAudio(evt) {
                evt.preventDefault();
                this.saving = true
                let uri = `/api/audio/${this.$route.params.id}`;
                this.axios.put(uri, this.audio)
                    .then((response) => {
                        this.$router.push({name: 'admin'});
                    })
                    .catch((e) => {
                        this.message = e.response.data || 'There was an issue updating the book.';
                        this.saving = false
                    })
            },
            
        }
    }
</script>