<template>
    <div class="container">
        <h1>Language</h1>
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
                <div class="col m5"></div>
                <div class="col m4">
                    <router-link :to="{ name: 'create-lang' }" class="btn grey">Create Language</router-link>
                </div>
            </div><br />

            <table class="striped highlight responsive-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Language</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="language in languages" :key="language.id">
                        <td>{{ language.id }}</td>
                        <td>{{ language.language }}</td>
                        <td><router-link :to="{name: 'edit-lang', params: { id: language.id }}" class="btn cyan pulse"><i class="material-icons">edit</i></router-link></td>
                        <td><button class="btn red" :disabled="saving" @click.prevent="deleteLanguage(language.id)"><i class="material-icons">delete</i></button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                loaded:false,
                saving: false,
                languages: [],
            }
        },
        created() {
            let uri = '/api/languages';
            this.axios.get(uri).then(response => {
                 setTimeout(() => {
                    this.loaded = true;
                    this.languages = response.data;
                }, 5000);
                
            })
            .catch(err => 
                console.log(err)
            )
        },
        methods: {
            deleteLanguage(id)
            {
                this.saving = true
                let uri = `/api/delLang/${id}`;
                this.axios.delete(uri)
                .then(response => {
                    this.languages.splice(this.languages.findIndex(language => language.id === id), 1);
                }).catch(err => {
                    console.log(err)
                    // this.$router.push({ name: '404' });
                }).then(
                    this.saving = false
                )
            }
        },

    }
</script>