<template>
    <div class="container dark">
        <div class="articles">
            <div class="main-container">
                <h4>Courses</h4>
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
                <div v-else>
                    <div class="row">
                        <div class="col s12 l12">
                            <table class="striped highlight responsive-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Coursename</th>
                                        <th>Preview</th>
                                        <th>Section</th>
                                        <th>Name</th>
                                        <th>Created on</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(course,index) in courses" :key="index">
                                        <td>{{index+1}}</td>
                                        <td>{{ course.videoName }}</td>
                                        <td>{{ course.preview }}</td>
                                        <td>{{course.section}}</td>
                                        <td>{{course.name}}</td>
                                        <td>{{ (course.created_at).substr(0, 10) }}</td> <!--MAke a computed func for substring-->
                                        <td><button class="btn red" :disabled="saving"  @click.prevent="deleteVideo(course.id)"><i class="material-icons">delete</i></button></td>
                                    </tr>
                                </tbody>
                            </table>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                saving: false,
                loaded: false,
                courses: [],
            }
        },
        
        created() {
            let uri = `/api/course/${this.$route.params.id}`;
            this.axios.get(uri).then(response => {
                setTimeout(() => {
                    this.loaded = true;
                    this.courses = response.data;
                }, 5000);
            })
            .catch(err => 
                console.log(err)
            )
        },
        methods: {
            deleteVideo(id)
            {
                this.saving = true
                let uri = `/api/deleteCourse/${id}`;
                this.axios.delete(uri).then(response => {
                    this.courses.splice(this.courses.findIndex(video => video.id === id), 1);
                    this.saving = false
                }).catch(err => {
                    console.log(err.response.header)
                    console.log(err.response.data)
                })
            },
        },

    }
</script>
