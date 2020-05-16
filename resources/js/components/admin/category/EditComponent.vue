<template>
  <b-container>
        <b-form @submit="updateCategory">
            <b-form-group id="input-group-1" label="Category:" label-for="category">
				<b-form-input
                    id="category"
                    v-model="category.categoryName"
					name="category"
                    required>
                </b-form-input>
            </b-form-group>

            <b-row class="ml-auto">
                <b-col>
                    <b-button type="submit" pill variant="secondary">Update</b-button>
                </b-col>
            </b-row>
        </b-form>
    </b-container>
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