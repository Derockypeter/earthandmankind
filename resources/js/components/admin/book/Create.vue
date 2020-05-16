<template>
    <b-container>
        <b-form enctype="multipart/form-data">
           <div class="row">
                <form class="col s12" @submit="registerUser">
                    <div class="row">
                        <div class="input-field col s6">
                            <input placeholder="Name" v-model="book.name" id="name" type="text" class="validate">
                        </div>
                        <div class="input-field col s6">
                            <textarea id="description" placeholder="Description" v-model="book.description" class="validate materialize-textarea"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s4">
                            <select>
                                <option :value="null" disabled selected>Select Category</option>
                                <option v-for="option in options" :key="option.id" v-bind:value="option.id">{{ option.categoryName }}</option>
                            </select>
                        </div>
                        <div class="file-field input-field col s4">
                            <div class="btn">
                                <span>File</span>
                                <input type="file">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder="Upload book cover">
                            </div>
                        </div>
                        <div class="file-field input-field col s4">
                            <div class="btn">
                                <span>File</span>
                                <input type="file">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder="Upload Book">
                            </div>
                        </div>
                    </div>
                </form>
           </div>
    </b-container>
</template>'image
<script>
  export default {
    data() {
		return {
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
      this.axios.get(uri).then(response => {
        this.options = response.data;
      });
    },
    methods: {
		publishBook(evt) {
			evt.preventDefault();
			const data = new FormData();
			data.append('title', this.book.name)
			data.append('body', this.book.description)
			data.append('category_id', this.book.category_id)
			data.append('imageName', this.book.image)
            let uri = 'http://127.0.0.1:8000/api/publishPost';
            this.axios.post(uri, data).then((response) => {
            	this.$router.push({name: 'admin'});
            });
		},
		onImageChange(event) {
			if(!event.target.files.length) return;

			this.post.imageName = event.target.files[0];
		},
    }
  }
</script>
