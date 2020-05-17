<template>
    <div class="container">
        <div class="articles">
            <div class="main-container">
                <h2>Edit Category</h2>
                <div class="row">
                    <form @submit="updateCategory" class="col s12">
                        <div class="row">
                             <div class="input-field col s6">
                                <div class="input-field col s6">
                                    <input v-model="category.categoryName" id="category" type="text" class="validate">
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
                category: {}
            }
        },
        created() {
            let uri = `http://127.0.0.1:8000/api/editCat/${this.$route.params.id}`;
            this.axios.get(uri).then((response) => {
                this.category = response.data;
            });
        },
        methods: {
            updateCategory(evt) {
                evt.preventDefault();
                let uri = `http://127.0.0.1:8000/api/editCat/${this.$route.params.id}`;
                this.axios.put(uri, this.category).then((response) => {
                    this.$router.push({name: 'admin'});
                }).catch(err => {
                    console.log(err.response.data)
                    console.log(err.response.header)
                })
            },
        }
    }
</script>