<template>
  <div class="container">
    <h1>Edit Post</h1>
    <form @submit.prevent="updatePost" enctype="multipart/form-data">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Post Title:</label>
            <input type="text" class="form-control" v-model="post.title">
          </div>
        </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Post Body:</label>
              <textarea class="form-control" v-model="post.body" rows="5"></textarea>
            </div>
          </div>
        </div><br />
        <!-- <b-form-file
            accept="image/*"
            v-on:change="onImageChange"
            name="imageName"
            placeholder="Choose a file or drop it here..."
            drop-placeholder="Drop file here..."
        ></b-form-file> -->
         <b-form-group id="input-group-3" label="Category:" label-for="input-3">
           <b-form-select v-model="post.category_id" class="mb-3" size="sm" required name="category">
					<b-form-select-option :value="null">Please select an option</b-form-select-option>
					<b-form-select-option v-for="option in options" :key="option.id" v-bind:value="option.id">{{ option.categoryName }}</b-form-select-option>
				></b-form-select>
        </b-form-group><br />
        <div class="form-group">
          <button class="btn btn-primary">Update</button>
        </div>
    </form>
  </div>
</template>

<script>
    export default {
        data() {
            return {
                post: {},
                options: [],
            }
        },
        created() {
            let uri = `http://127.0.0.1:8000/api/editPost/${this.$route.params.id}`;
            this.axios.get(uri).then((response) => {
                this.post = response.data;
			});
			let uri2 = 'http://127.0.0.1:8000/api/getAllCat';
			this.axios.get(uri2).then(response => {
				this.options = response.data;
			});
        },
        methods: {
            updatePost() {
            let uri = `http://127.0.0.1:8000/api/post/${this.$route.params.id}`;
            this.axios.put(uri, this.post).then((response) => {
                this.$router.push({name: 'admin'});
            }).catch(err => {
                console.log(err.response.data)
                console.log(err.response.header)
            })
            },
            // onImageChange(event) {
            //     this.post.imageName = event.target.files[0];
            // },
        }
    }
</script>