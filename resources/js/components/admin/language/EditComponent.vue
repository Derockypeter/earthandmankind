<template>
    <div class="container">
        <div class="articles">
            <div class="main-container">
                <h2>Edit Language</h2>
                <div class="row">
                    <div v-if="success">{{success}}</div>
                    <form @submit="updateLanguage" class="col s12">
                        <div class="row">
                             <div class="input-field col s6">
                                <div class="input-field col s6">
                                    <input v-model="language.language" id="language" type="text" class="validate">
                                </div>
                            </div>
                            <button type="submit" class="btn waves-effect">Edit</button>
                        </div>
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
                language: {},
                success: false,
            }
        },
        created() {
            let uri = `/api/edit/${this.$route.params.id}`;
            this.axios.get(uri).then((response) => {
                this.language = response.data;
            });
        },
        methods: {
            updateLanguage(evt) {
                evt.preventDefault();
                let uri = `/api/update/${this.$route.params.id}`;
                this.axios.put(uri, this.language).then((response) => {
                    this.success = 'Updated succesfuly'
                    this.$router.push({name: 'admin'});
                }).catch(error => {console.log(error)});
            },
        }
    }
</script>