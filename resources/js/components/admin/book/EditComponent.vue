<template>
  <div class="container">
        <div class="articles">
            <div class="main-container">
                <div v-if="message" class="alert">{{ message }}</div>
                <div v-if="! loaded">Loading...</div>
                <div v-else class="row">
                    <form class="col s12" @submit="updateBook" enctype="multipart/form-data">
                        <div class="row">
                            <div class="input-field col s6">
                                <input v-model="book.name" id="name" type="text" class="validate">
                            </div>
                            <div class="input-field col s6">
                                <textarea id="description" v-model="book.description" class="validate materialize-textarea"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <select v-model="book.language_id" class="browser-default">
                                    <option :value="null" disabled selected>Select Category</option>
                                    <option v-for="option in options" :key="option.id" v-bind:value="option.id">{{ option.language }}</option>
                                </select>
                            </div>
                            <div class="input-field col s6">
                                <input v-model="book.amount" id="amount" type="text" class="validate">
                            </div>
                            <!-- <div class="file-field input-field col s4">
                                <div class="btn">
                                    <span>File</span>
                                    <input type="file">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" v-on:change="onImageChange"
                                        name="image" type="text" placeholder="Upload book cover">
                                </div>
                            </div> -->
                            <!-- <div class="file-field input-field col s4">
                                <div class="btn">
                                    <span>File</span>
                                    <input type="file">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" v-on:change="onPathChange" 
                                        name="path" type="text" placeholder="Upload Book">
                                </div>
                            </div> -->
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
                book: {},
                options: [],
            }
        },
        created() {
            let uri = `/api/book/${this.$route.params.id}`;
            this.axios.get(uri).then((response) => {
                setTimeout(() => {
                    this.loaded = true;
                    this.book = response.data;
                    console.log(response.data)
                }, 5000);
			});
			let uri2 = '/api/languages';
			this.axios.get(uri2).then(response => {
				this.options = response.data;
			});
        },
        methods: {
            updateBook(evt) {
                evt.preventDefault();
                this.saving = true
                let uri = `/api/bookEdit/${this.$route.params.id}`;
                this.axios.put(uri, this.book)
                    .then((response) => {
                        this.$router.push({name: 'admin'});
                    })
                    .catch((e) => {
                        this.message = e.response.data || 'There was an issue updating the book.';
                        this.saving = false
                    })
            },
            // onImageChange(event) {
            //     this.books.imageName = event.target.files[0];
            // },
        }
    }
</script>