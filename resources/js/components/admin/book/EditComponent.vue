<template>
    <div class="container">
        <div class="articles">
            <div class="main-container">
                <h5>Edit Book</h5>
                <div v-if="message" class="alert">{{ message }}</div>
                <div class="center" v-if="!loaded" style="height: 100vh;">
                    <div class="preloader-wrapper small active loaderStyle">
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
                <div v-else class="row">
                    <form
                        class="col s12"
                        @submit="updateBook"
                        enctype="multipart/form-data"
                    >
                        <div class="row">
                            <div class="input-field col s6">
                                <input
                                    v-model="book.name"
                                    id="name"
                                    type="text"
                                    class="validate"
                                />
                            </div>
                            <div class="input-field col s6">
                                <textarea
                                    id="description"
                                    v-model="book.description"
                                    class="validate materialize-textarea"
                                ></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <select
                                    v-model="book.language_id"
                                    class="browser-default"
                                >
                                    <option :value="null" disabled selected
                                        >Select Category</option
                                    >
                                    <option
                                        v-for="option in options"
                                        :key="option.id"
                                        v-bind:value="option.id"
                                        >{{ option.language }}</option
                                    >
                                </select>
                            </div>
                            <div class="input-field col s6">
                                <input
                                    v-model="book.amount"
                                    id="amount"
                                    type="text"
                                    class="validate"
                                />
                            </div>
                           
                            <button
                                class="btn waves-effect"
                                :disabled="saving"
                                type="submit"
                            >
                                Edit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .loaderStyle {
        margin-top: 50vh;
    }
</style>

<script>
export default {
    data() {
        return {
            message: false,
            loaded: false,
            saving: false,
            book: {},
            options: []
        };
    },
    created() {
        let uri = `/api/book/${this.$route.params.id}`;
        this.axios.get(uri).then(response => {
            setTimeout(() => {
                this.loaded = true;
                this.book = response.data;
            }, 5000);
        });
        let uri2 = "/api/languages";
        this.axios.get(uri2).then(response => {
            this.options = response.data;
        });
    },
    methods: {
        updateBook(evt) {
            evt.preventDefault();
            this.saving = true;
            let uri = `/api/bookEdit/${this.$route.params.id}`;

            this.axios
                .put(uri, this.book)
                .then(response => {
                    if(response.data.status == 200){
                        this.$router.push({ name: "admin" }).catch(()=>{});
                    }
                    else {
                        this.saving = false;
                    }
                })
                .catch(e => {
                    this.message =
                        "There was an issue updating this book.";
                    this.saving = false;
                });
        }
    }
};
</script>
