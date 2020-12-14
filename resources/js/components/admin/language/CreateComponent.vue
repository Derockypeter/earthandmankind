<template>
    <div class="container">
        <div class="articles">
            <div class="main-container">
                <center>
                    <div class="row">
                        <h5>Create a New Language</h5>
                        <div v-if="message" class="alert">{{message}}</div>
                        <form @submit="addLanguage">
                            <div class="row">
                                <div class="input-field col s6">
                                    <input placeholder="Enter language" v-model="lang.language" name="lang" id="lang" 
                                        required type="text" class="validate">
                                </div>
                            

                                <div class="col s6">
                                    <button type="submit" :disabled="creating" class="btn waves-effect">{{ creating ? 'Creating...' : 'Create' }}</button>
                                </div>
                            </div>
                        </form>
                    
                    </div>
                </center>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    data() {
		return {
            lang: {
                language: '',
            },
            creating: false,
            message: false,
		}
    },
    created() {
        
    },
    methods: {
      	addLanguage(evt) {
            evt.preventDefault();
            this.creating = true
			let uri = '/api/language-save';
            this.axios.post(uri, this.lang)
            .then((response) => {
                M.toast({html: 'Language created'})
				this.$router.push({name: 'admin'}).catch(()=>{});
			})
			.catch(err => {
                this.message = err.response.data || 'Error encountered'
                this.creating = false
			})
		},
    }
  }
</script>
