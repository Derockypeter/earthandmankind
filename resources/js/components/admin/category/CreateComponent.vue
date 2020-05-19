<template>
    <div class="container">
        <div class="articles">
            <div class="main-container">
                <center>
                    <div class="row">
                        <h5>Create a New Category</h5>
                        <div v-if="message" class="alert">{{message}}</div>
                        <form @submit="addCategory">
                            <div class="row">
                                <div class="input-field col s6">
                                    <input placeholder="Enter Category" v-model="category.categoryName" name="categoryName" id="category" 
                                        required type="text" class="validate">
                                </div>
                            

                                <div class="col s6">
                                    <button type="submit" :disabled="creating" class="btn waves-effect">{{ creating ? 'Creating...' : 'Create' }}</button>
                                </div>
                            </div>
                        </form>
                    
                    </div>
                </center>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import router from '../../../router.js'
  export default {
    data() {
		return {
            category: {
                categoryName: ''
            },
            creating: false,
            message: false,
		}
    },
    created() {
        
    },
    methods: {
      	addCategory(evt) {
            evt.preventDefault();
            this.creating = true
			let uri = 'http://127.0.0.1:8000/api/saveCat';
			axios.post(uri, this.category).then((response) => {
				router.push({name: 'admin'});
			})
			.catch(err => {
                this.message = err.response.data || 'Error encountered'
			})
		},
    }
  }
</script>
