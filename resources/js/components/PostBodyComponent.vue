<template>
    <div class="container mt-5">
        <div class="articles">
            <div class="main-container">
                <div v-for="post in posts" :key="post.id" class="body row">
                    <div class="col s12 l9 m7">
                        <img :src="'/blogImages/'+post.image" class="responsive-img" width="80%">
                        <p>{{post.imagename}}</p>
                        <h4>{{post.title}}</h4>
                        <p class="text-muted">Created on {{created}}.</p>
                        <div>
                            {{post.body}}
                        </div>
                    </div>
                </div>
                <div class="sharePrint">
                    <button class="btn-small grey" style="margin-right: 40px" @click="print">Print<i class="small material-icons">print</i></button>
                    <button class="btn-small grey" @click="share">Share<i class="small material-icons">share</i></button>
                </div>
            </div>
        </div>

    </div>
</template>
<style scoped>
    .uppercase {
        text-transform: uppercase;
        font-weight: 300;
    }
    a {
        text-transform: capitalize;
        font-size: 1em;
        font-weight: 450;
    }
    .body {
        padding-bottom: 30px;
    }
    .text-muted {
        text-decoration: darkgray;
        font-weight: 500;
        font-style: oblique;
    }
    .sharePrint {
        padding: 35px 0px 50px 20px;
    }
</style>
<script>
export default {
    props: [

    ],
    data() {
        return {
            posts: [],
            created: []
        }
    },
    created() {
        let uri = `/api/post/${this.$route.params.title}`;
        this.axios.get(uri).then(response => {
            this.posts = response.data.post;
            this.created = response.data.created
            console.log(this.posts)
        })
        .catch(err => 
            console.error.response.data
        )
        M.AutoInit()
    },
    mounted() {
        M.AutoInit()
    },
    methods: {
        print(){
            window.print()
        },
        share(){
            console.log('shared')
        }
    }
}
</script>