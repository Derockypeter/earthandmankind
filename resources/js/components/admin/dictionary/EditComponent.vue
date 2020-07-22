<template>
    <div class="container">
        <div class="articles">
            <div class="main-container">
                <h1>Edit Dictionary</h1>
                <div v-if="message" class="alert">{{ message }}</div>
                <div v-if="! loaded" class="progress">
                    <div class="indeterminate"></div>
                </div>
                <div class="row" v-else>
                    <form class="col s12" @submit="updateDictionary" enctype="multipart/form-data">
                        <div class="row">
                            <div class="input-field col s12">
                                <input placeholder="Enter Word" v-model="dictionary.word" id="word" type="text" class="validate">
                            </div>
                        </div>
                         <div class="row">
                            <div class="input-field col s12">
                                <tinymce v-model="dictionary.meanings"
                                    :plugins="myPlugins" 
                                    :toolbar ="myToolbar1"
                                >
                                </tinymce>   
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                <button class="btn waves waves-effect grey">Edit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
   
</style>
<script>
import Editor from '@tinymce/tinymce-vue';
  export default {
    data() {
		return {
            loaded: false,
            saving: false,
            message: false,
            dictionary: {},
            myToolbar1: 'undo redo | bold italic underline preview | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link',
            myPlugins: "link code preview imagetools insertdatetime paste spellchecker autosave autoresize",
		}
    },
    components: {
         'tinymce': Editor // <- Important part
    },
    created() {
         let uri = `/api/dictionary/${this.$route.params.id}`;
            this.axios.get(uri).then((response) => {
				setTimeout(() => {
                    this.loaded = true;
                    this.dictionary = response.data.dictionary;
                    console.log(response.data)
                }, 5000);
			});
    },
    methods: {
		updateDictionary() {
            this.saving = true
            let uri = `/api/dictionary/${this.$route.params.id}`;
            this.axios.put(uri, this.dictionary).then((response) => {
                M.toast({html: 'Dictionary updated'})
                this.$router.push({name: 'admin'});
            }).catch(err => {
                this.message = err.response.data.errors
                this.saving = false
            });
        },
    }
  }
</script>
