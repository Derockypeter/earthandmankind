<template>
<div class="container">
        <div class="articles">
            <div class="main-container">
                 <div class="center" v-if="!loaded">
                    <div class="preloader-wrapper small active">
                        <div class="spinner-layer spinner-red-only">
                            <div class="circle-clipper left">
                                <div class="circle"></div>
                            </div>
                            <div class="gap-patch">
                                <div class="circle"></div>
                            </div>
                            <div class="circle-clipper right">
                                <div class="circle"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-else class="row">
    				<h1>Edit Course</h1>
                    <div v-if="message" class="alert">{{ message }}</div>
                    <form class="col s12" @submit.prevent="updateCourse">
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="input-1"
                                    v-model="videos.coursename"
                                    name="coursename"
                                    required type="text" class="validate">
                            </div>
                             <div class="input-field col s6">
                                <input id="input-1"
                                    v-model="videos.name"
                                    name="coursename"
                                    required type="text" class="validate">
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <select v-model="videos.category_id" class="browser-default">
                                    <option value="" disabled selected>Select Category</option>
                                    <option v-for="option in options" :key="option.id" v-bind:value="option.id">{{ option.categoryName }}</option>
                                </select>
                            </div>
                            <div class="input-field col s6">
                                <select v-model="videos.section" required class="browser-default">
                                    <option value="" disabled selected>Which section will I attach this video</option>
                                    <option disabled v-for="section in sections" v-bind:value="section.id" :key="section.id" >{{section.text}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <textarea id="description" class="materialize-textarea" required placeholder="Please enter a description for the course" v-model="videos.description" ></textarea>
                            </div>
                        </div>
                        <button class="btn waves-effect" :disabled="saving" type="submit">Edit</button>
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
                message: false,
                loaded: false,
                saving: false,
                sections: [
                    {text: 'Section 1', value: '1'},
                    {text: 'Section 2', value: '2'},
                    {text: 'Section 3', value: '3'},
                    {text: 'Section 4', value: '4'},
                    {text: 'Section 5', value: '5'},
                    {text: 'Section 6', value: '6'},
                    {text: 'Section 7', value: '7'},
                    {text: 'Section 8', value: '8'},
                    {text: 'Section 9', value: '9'},
                    {text: 'Section 10', value: '10'},

                ],
                videos: {},
                options: [],
            }
        },
        created() {
            let uri = `/api/editcourse/${this.$route.params.id}`;
            this.axios.get(uri).then((response) => {
                setTimeout(() => {
                    this.loaded = true
                    this.videos = response.data[0];
                    console.log(response.data)
                }, 5000);
            });
            let uri2 = '/api/getAllCat';
            this.axios.get(uri2).then(response => {
                this.options = response.data;

            });
        },
        methods: {
            updateCourse(evt) {
                evt.preventDefault();
                this.saving = true
                let uri = `/api/updatecourse/${this.$route.params.id}`;
                this.axios.put(uri, this.videos).then((response) => {
                    if(response.data === 1){
                        this.$router.push({name: 'admin'});
                    }
                    else {
                        this.message = response.error
                    }
                }).catch(error => {
                    this.message = error 
                    this.saving = false
                    console.log(error)
                })
            },
        }
    }
</script>