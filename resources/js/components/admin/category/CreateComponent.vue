<template>
    <b-container>
        <b-form @submit="addCategory">
            <b-form-group id="input-group-1" label="Category:" label-for="category">
				<b-form-input
                    id="category"
                    v-model="category.categoryName"
					name="categoryName"
                    required
                    placeholder="Enter Category">
                </b-form-input>
            </b-form-group>

            <b-row class="ml-auto">
                <b-col>
                    <b-button type="submit" pill variant="secondary">Create</b-button>
                </b-col>
            </b-row>
        </b-form>
    </b-container>
</template>

<script>
  export default {
    data() {
		return {
            category: {
                categoryName: ''
            }
		}
    },
    created() {
        
    },
    methods: {
      	addCategory(evt) {
            evt.preventDefault();
			let uri = 'http://127.0.0.1:8000/api/saveCat';
			this.axios.post(uri, this.category).then((response) => {
				this.$router.push({name: 'admin'});
			})
			.catch(err => {
                console.log(err.response.data)
				console.log(err.response.header)
			})
		},
    }
  }
</script>
