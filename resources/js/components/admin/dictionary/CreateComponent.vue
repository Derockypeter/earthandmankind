<template>
    <div class="container">
        <div class="articles">
            <div class="main-container">
                <h1>Create Word</h1>
                <div v-if="message" class="alert">{{ message }}</div>
                <div class="row">
                    <form class="col s12" @submit="dictionary" enctype="multipart/form-data">
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
                                        :init="myInit"
                                    >
                                    </tinymce>   
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
            saving: false,
            message: false,
            dictionary: {
                word: "",
                meanings: "",
            },
            myToolbar1: 'undo redo | bold italic underline preview | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link',
            myPlugins: "link code preview imagetools insertdatetime paste spellchecker autosave autoresize",
            
		}
    },
    components: {
         'tinymce': Editor // <- Important part
    },
    methods: {
		dictionary(evt) {
            evt.preventDefault();
            this.saving = true
            if(this.dictionary.word != '' && this.dictionary.meanings != ''){
                let uri = '/api/dictionary';
                this.axios.post(uri, this.dictionary)
                .then((response) => {
                    M.toast({html: response.data.message})
                    this.$router.push({name: 'admin'});
                }).catch((error) => {
                    this.message = error.response.data.message || 'There was an issue creating the dictionary.';
                    this.saving = false
                })
            }
		},
    }
  }
</script>
