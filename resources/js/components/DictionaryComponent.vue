<template>
    <div class="container articles">
        <div class="main-container">
            <div class="nav-wrapper">
                <form>
                    <div class="input-field">
                    <input id="search" type="search" required v-model="search">
                    <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                    <i class="material-icons">close</i>
                    </div>
                </form>
            </div>
            <h1>Dictionary</h1>
            <div>
                <div class="chip waves-effect waves-light btn modal-trigger" href="#modal1" v-for="diction in filteredList" :key="diction.id" @click="getMeaning(diction.id, diction.meanings, diction.word)">
                    {{diction.word}}
                </div>
            </div>

            
            <!-- Modal Structure -->
            <div class="row">
                <div class="col s12 m6">
                    <div class="card blue lighten-5  modal" id="modal1">
                        <div class="card-content">
                        <a href="#!" class="modal-close waves-effect waves-green btn-flat right"><i class="material-icons">close</i></a>
                        <span class="card-title">{{word}}</span>
                        <p v-html="meanings">.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .nav-wrapper{
        width: 500px;
        float: right;
        border: thin solid;
        border-radius: 20px;
    }
    .chip:hover {
        cursor: pointer;
    }
</style>
<script>
    export default {
        data() {
            return {
                dictionary: [],
                word: "",
                meanings: "",
                search: "",
            }
        },
        computed: {
            filteredList() {
                return this.dictionary.filter(diction => {
                    return diction.word.toLowerCase().includes(this.search.toLowerCase())
                })
            }
        },
        created() {
            this.axios.get('api/dictionary')
            .then((response) => {
                this.dictionary = response.data.dictionary
            })
        },
        methods: {
            getMeaning($id, $mean, $word) {
                this.word = $word
                this.meanings = $mean
            }
        },
    }
</script>