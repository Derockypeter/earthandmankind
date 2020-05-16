<template>
    <b-container>
        <b-form enctype="multipart/form-data">
           <div class="row">
                <form class="col s12" @submit="registerUser">
                    <div class="row">
                        <div class="input-field col s6">
                            <input placeholder="Name" v-model="book.name" id="title" type="text" class="validate">
                        </div>
                        <div class="input-field col s6">
                            <textarea id="description" placeholder="Description" v-model="book.description"  type="text" class="validate materialize-textarea">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input placeholder="Name" v-model="book.name" id="title" type="text" class="validate">
                        </div>
                        <div class="input-field col s6">
                            <textarea id="description" placeholder="Description" v-model="book.description"  type="text" class="validate materialize-textarea">
                        </div>
                    </div>
                </form>
           </div>
    </b-container>
</template>
'category_id', 'image
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
