<template>
    <div class="container">
        <div class="articles">
            <div class="main-container">
                <div v-if="message" class="alert">{{ message }}</div>
                <div class="row">
                    <form class="col s12" @submit="publishBook" enctype="multipart/form-data">
                        <div class="row">
                            <div class="input-field col s6">
                                <input placeholder="Name" v-model="book.name" id="name" type="text" class="validate">
                            </div>
                            <div class="input-field col s6">
                                <textarea id="description" placeholder="Description" v-model="book.description" class="validate materialize-textarea"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="file-field input-field col s6">
                                <div class="btn">
                                    <span>File</span>
                                    <input type="file" v-on:change="onImageChange">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" 
                                        name="image" type="text" placeholder="Upload book cover">
                                </div>
                            </div>
                            <div class="file-field input-field col s6">
                                <div class="btn">
                                    <span>File</span>
                                    <input type="file" v-on:change="onPathChange">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate"  
                                        name="path" type="text" placeholder="Upload Book">
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s7">
                                    <select class="browser-default" v-model="book.category_id">
                                        <option value="" disabled selected>Select Category</option>
                                        <option v-for="option in options" :key="option.id" v-bind:value="option.id">{{ option.categoryName }}</option>
                                    </select>
                                </div>
                                <div class="col s5">
                                    <button :disabled="saving" class="btn waves-effect" type="submit">{{ saving ? 'Publishing...' : 'Publish' }}</button>
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
   
</style>
<script>
import axios from 'axios'

  export default {
    data() {
		return {
            saving: false,
            message: false,
			book: {
				name: '',
				description: '',
				image: null,
                category_id: '',
                path: ''
			},
			options: [],
		}
    },
    created() {
      let uri = 'http://127.0.0.1:8000/api/getAllCat';
      axios.get(uri).then(response => {
        this.options = response.data;
      });
    },
    methods: {
		publishBook(evt) {
            evt.preventDefault();
            this.saving = true
            if(this.book.name != '' && this.book.description != '' && this.book.category_id != ''){
                const data = new FormData();
                data.append('name', this.book.name)
                data.append('description', this.book.description)
                data.append('category_id', this.book.category_id)
                data.append('image', this.book.image)
                data.append('path', this.book.path)
                let uri = 'http://127.0.0.1:8000/api/saveBook';
                axios.post(uri, data).then((response) => {
                    this.$router.push({name: 'admin'});
                }).catch((e) => {
                    this.message = e.response || 'There was an issue creating the book.';
                    this.saving = false
                })
            }
            else{
                this.message = 'Invalid data, fill out all fields'
                this.saving = false
            }
			
		},
		onImageChange(event) {
			if(!event.target.files.length) return;

			this.book.image = event.target.files[0];
        },
        onPathChange(event) {
			if(!event.target.files.length) return;

			this.book.path = event.target.files[0];
		},
    }
  }
</script>
