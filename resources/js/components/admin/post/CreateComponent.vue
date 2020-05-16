<template>
    <b-container>
        <b-form enctype="multipart/form-data">
            <b-form-group id="input-group-1" label="Title:" label-for="input-1">
				<b-form-input
                    id="input-1"
                    v-model="post.title"
					name="title"
                    required
                    placeholder="Enter Title">
                </b-form-input>
            </b-form-group>

            <b-form-group id="input-group-2" label="Post:" label-for="post">
                <b-form-textarea
					id="post"
					v-model="post.body"
					name="body"
					placeholder="Enter Post..."
					rows="3"
					max-rows="6">
                </b-form-textarea>
            </b-form-group>
            <b-form-file
              accept="image/*"
              v-on:change="onImageChange"
			  name="imageName"
              placeholder="Choose a file or drop it here..."
              drop-placeholder="Drop file here..."
            ></b-form-file>
            <b-form-group id="input-group-3" label="Category:" label-for="input-3">
				<b-form-select v-model="post.category_id" class="mb-3" size="sm" required name="category">
					<b-form-select-option :value="null">Please select an option</b-form-select-option>
					<b-form-select-option v-for="option in options" :key="option.id" v-bind:value="option.id">{{ option.categoryName }}</b-form-select-option>
				></b-form-select>
			</b-form-group>
            <b-row class="ml-auto">
                <b-col>
                    <b-button type="submit" @click="publishPost" pill variant="secondary" value="published" v-b-tooltip.hover title="Save post to website">Publish</b-button>
                </b-col>
            </b-row>
        </b-form>
    </b-container>
</template>

<script>
  export default {
    data() {
		return {
			post: {
				title: '',
				body: '',
				imageName: null,
				category_id: ''
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
		publishPost(evt) {
			evt.preventDefault();
			const data = new FormData();
			data.append('title', this.post.title)
			data.append('body', this.post.body)
			data.append('category_id', this.post.category_id)
			data.append('imageName', this.post.imageName)
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
