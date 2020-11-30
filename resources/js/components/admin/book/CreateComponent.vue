<template>
    <div class="container">
        <div class="articles">
            <div class="main-container">
                <h1>Create A new Book</h1>
                <div class="alert" v-if="messer">{{messer}}</div>
                <ul v-if="message.length > 0" class="collection">
                    <li class="red lighten-3 white-text collection-item" v-for="mess in message" :key="mess">{{ mess }}</li>
                </ul>
                <div class="row">
                    <form
                        class="col s12"
                        @submit="publishBook"
                        enctype="multipart/form-data"
                    >
                        <div class="row">
                            <div class="input-field col s6">
                                <input
                                    placeholder="Book name"
                                    v-model="book.name"
                                    id="name"
                                    type="text"
                                    class="validate"
                                    required
                                />
                            </div>
                            <div class="input-field col s6">
                                <textarea
                                    id="description"
                                    placeholder="Description"
                                    v-model="book.description"
                                    class="validate materialize-textarea"
                                    required
                                ></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="file-field input-field col s6">
                                <div class="btn">
                                    <span>File</span>
                                    <input
                                        type="file"
                                        v-on:change="onImageChange"
                                    />
                                </div>
                                <div class="file-path-wrapper">
                                    <input
                                        class="file-path validate"
                                        name="image"
                                        type="text"
                                        placeholder="Upload book cover"
                                        required
                                    />
                                </div>
                            </div>
                            <div class="file-field input-field col s6">
                                <div class="btn">
                                    <span>File</span>
                                    <input
                                        type="file"
                                        v-on:change="onPathChange"
                                    />
                                </div>
                                <div class="file-path-wrapper">
                                    <input
                                        class="file-path validate"
                                        name="path"
                                        type="text"
                                        placeholder="Upload Book"
                                        required
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input
                                        placeholder="Amount"
                                        v-model="book.amount"
                                        id="amount"
                                        type="text"
                                        class="validate"
                                    />
                                </div>
                                <div class="file-field input-field col s6">
                                    <div class="btn purple lighten-4">
                                        <span>File</span>
                                        <input
                                            type="file"
                                            v-on:change="onPreviewChange"
                                        />
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input
                                            class="file-path validate"
                                            name="path"
                                            type="text"
                                            placeholder="Upload Book Preview"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s7">
                                    <select
                                        class="browser-default"
                                        v-model="book.language_id"
                                    >
                                        <option value="" disabled selected
                                            >Select language for this
                                            book</option
                                        >
                                        <option
                                            v-for="option in options"
                                            :key="option.id"
                                            v-bind:value="option.id"
                                            >{{ option.language }}</option
                                        >
                                    </select>
                                </div>
                                <div class="col s5">
                                    <button
                                        :disabled="saving"
                                        class="btn waves-effect"
                                        type="submit"
                                    >
                                        {{
                                            saving ? "Publishing..." : "Publish"
                                        }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .alert {
        background-color: rgb(248, 196, 196);
        border-color: aliceblue;
    }
</style>
<script>
export default {
    data() {
        return {
            saving: false,
            message: [],
            messer: false,
            book: {
                name: "",
                description: "",
                image: null,
                language_id: "",
                path: "",
                amount: "",
                preview: ""
            },
            options: []
        };
    },
    created() {
        let uri = "/api/languages";
        this.axios.get(uri).then(response => {
            this.options = response.data;
        });
    },
    methods: {
        publishBook(evt) {
            evt.preventDefault();
            this.saving = true;
            if (
                this.book.name != "" &&
                this.book.description != "" &&
                this.book.language_id != ""
            ) {
                const data = new FormData();
                data.append("name", this.book.name);
                data.append("description", this.book.description);
                data.append("language_id", this.book.language_id);
                data.append("image", this.book.image);
                data.append("path", this.book.path);
                data.append("amount", this.book.amount);
                data.append("preview", this.book.preview);

                let uri = "/api/saveBook";
                this.axios
                    .post(uri, data)
                    .then(response => {
                        // console.log(response);
                        if (response.data.error) {
                            this.message = response.data.error;
                            this.messer = false;
                            this.saving = false;
                        } else if (response.data.status == "success") {
                            this.$router.push({ name: "admin" });
                        }
                    })
                    .catch(e => {
                        // console.log(e);
                        this.saving = false;
                    });
            } else {
                this.messer = "Invalid data, fill out all required fields";
                this.saving = false;
            }
        },
        onImageChange(event) {
            if (!event.target.files.length) return;

            this.book.image = event.target.files[0];
        },
        onPathChange(event) {
            if (!event.target.files.length) return;

            this.book.path = event.target.files[0];
        },
        onPreviewChange(event) {
            if (!event.target.files.length) return;

            this.book.preview = event.target.files[0];
        }
    }
};
</script>
