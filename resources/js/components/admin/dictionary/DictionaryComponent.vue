<template>
  <div class="container">
        <h1>Dictionary</h1>
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
                    <router-link :to="{ name: 'create-dictionary' }" class="btn grey">Create Dictionary</router-link>
                </div>
            </div><br />

            <table class="striped highlight responsive-table">
                <thead>
                <tr>
                    <th>S?N</th>
                    <th>Word</th>
                    <th>Meaning</th>
                </tr>
                </thead>
                <tbody>
                    <tr v-for="(diction, index) in dictionary" :key="diction.id">
                        <td>{{ index + 1 }}</td>
                        <td>{{ diction.word }}</td>
                        <td>{{ diction.meanings }}</td>
                        <td><router-link :to="{name: 'edit-dictionary', params: { id: diction.id }}" class="btn cyan pulse"><i class="material-icons">edit</i></router-link></td>
                        <td><button class="btn red" :disabled="saving" @click.prevent="deleteDiction(diction.id)"><i class="material-icons">delete</i></button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<style scoped>
 
 
</style>
<script>
    export default {
        data() {
            return {
                saving: false,
                loaded: false,
                dictionary: [],
            }
        },
        created() {
            let uri = '/api/dictionary';
            this.axios.get(uri).then(response => {
                setTimeout(() => {
                    this.loaded = true;
                    this.dictionary = response.data;
                    console.log(response)
                }, 5000);
            })
            .catch(err => 
                console.error.response.data.data
            )
        },
        methods: {
            deleteDiction(id)
            {
                this.saving = true
                let uri = `/api/dictionary/${id}`;
                this.axios.delete(uri).then(response => {
                    M.toast({html: 'Dictionary deleted'})
                    this.dictionary.splice(this.dictionary.findIndex(diction => diction.id === id), 1);
                    this.saving = false
                }).catch(err => {
                    this.saving = false
                })
            }
        },

    }
</script>