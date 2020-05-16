<template>
    <b-container>
		<div class="mt-5"></div>
        <b-form  @submit="createVideo" enctype="multipart/form-data" novalidate>
         	<b-form-group id="input-group-1" label="Title:" label-for="input-1">
				<b-form-input
                    id="input-1"
                    v-model="video.title"
					name="title"
                    required
                    placeholder="Enter Title">
                </b-form-input>
            </b-form-group>
            <b-form-file
            	accept="video/*"
                v-on:change="onVideoChange"
                name="videoName"
                placeholder="Choose a video or drop it here... One video per upload"
                drop-placeholder="Drop file here..."
                required=""
            ></b-form-file>
            <b-form-group id="input-group-3" label="Category:" label-for="input-3">
				<b-form-select v-model="video.category_id" class="mb-3" size="sm" required name="category">
					<b-form-select-option :value="null">Please select an option</b-form-select-option>
					<b-form-select-option v-for="option in options" :key="option.id" v-bind:value="option.id">{{ option.categoryName }}</b-form-select-option>
				></b-form-select>
			</b-form-group>
            <b-row class="ml-auto">
                <b-col>
                    <b-button type="submit" pill variant="secondary">Save</b-button>
                </b-col>
            </b-row>
        </b-form>
    </b-container>
</template>

<script>
  export default {
    data() {
		return {
			video: {
                videoName: null,
				category_id: '',
				title: '',
			},
			options: [],
			novalidate: true
		}
    },
    created() {
      let uri = 'http://127.0.0.1:8000/api/getAllCat';
      this.axios.get(uri).then(response => {
        this.options = response.data;
      });
    },
    methods: {
      	createVideo(evt) {
			evt.preventDefault();
            const data = new FormData();
            data.append('category_id', this.video.category_id)
			data.append('videoName', this.video.videoName)
			data.append('title', this.video.title)
			let uri = 'http://127.0.0.1:8000/api/saveVideo';
			this.axios.post(uri, data).then((response) => {
				this.$router.push({name: 'admin'});
			})
			.catch(err => {
				console.log(err.response.data, err.response.header)
			})
		},
		onVideoChange(event) {
			this.video.videoName = event.target.files[0];
		},
    }
  }
</script>
