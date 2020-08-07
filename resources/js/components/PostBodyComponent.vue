<template>
    <div class="container mt-5">
        <div class="articles">
            <div class="main-container">
                 <div class="center" v-if="!loaded" style="height:500px">
                    <div style="top:250px" class="preloader-wrapper small active">
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
                <div v-else >
                    <div class="body row" id="body">
                        <div class="col s12 l11 m11">
                            <h1>{{posts.title}}</h1>
                            <p class="text-muted">Created on {{created}}.</p>
                            <div v-html="posts.body">
                            </div>
                        </div>
                    </div>
                    <div class="sharePrint">
                        <ShareNetwork
                            network="twitter"
                            :url="url"
                            :title="posts.title"
                            :description="synopsis(posts.body)"
                        >
                        <button class="btn dodgerblue btn-small"><font-awesome-icon :icon="['fab', 'twitter']" size="lg"  />Twitter</button>
                        </ShareNetwork>
                        <ShareNetwork
                            network="facebook"
                            :url="url"
                            :title="posts.title"
                            :description="synopsis(posts.body)"
                        >
                        <button class="btn fb btn-small"><font-awesome-icon :icon="['fab', 'facebook']" size="lg"  />Facebook</button>
                        </ShareNetwork>
                        <ShareNetwork
                            network="Email"
                            :url="url"
                            :title="posts.title"
                           :description="synopsis(posts.body)"
                        >
                        <button class="btn email btn-small"><font-awesome-icon :icon="['fas', 'envelope']" size="lg"  />Email</button>
                        </ShareNetwork>
                        <ShareNetwork class="whatsapp"
                            network="Whatsapp"
                            :url="url"
                            :title="posts.title"
                            :description="synopsis(posts.body)"
                        >
                        <button class="btn whatsapp btn-small"><font-awesome-icon :icon="['fab', 'whatsapp']" size="lg"  />Whatsapp</button>
                        </ShareNetwork>
                        <button class="btn-small email" @click="print('body')"><i class="small material-icons">print</i>Print</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
<style scoped>
    @media only screen and (min-width: 768px) {
        .whatsapp {
            display: none;
        }
    }
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
    .dodgerblue {
        background-color: #1c9ceb;
    }
    .fb {
        background-color: #158fe7;
    }
    .email {
        background-color: #292929;
    }
    .whatsapp {
        background-color: #6abc6e;
    }
    .btn-small {
        height: 20px;
        line-height: 20px;
        font-size: 13px;
    }
</style>
<script  >
export default {
    props: [

    ],
    data() {
        return {
            loaded: false,
            posts: [],
            created: '',
            url: window.location.href,
        }
    },
    created() {
        document.title = this.$route.params.title;
        let uri = `/api/post/${this.$route.params.title}`;
        this.axios.get(uri).then(response => {
            setTimeout(() => {
                this.loaded = true;
                this.posts = response.data.post;
                this.created = response.data.created
            }, 5000);
        })
        .catch(err => 
            console.log(error.response)
        )
        M.AutoInit()

    
    },
    mounted() {
        M.AutoInit()
    },
    methods: {
        print(body){
            let printContents = document.getElementById(body).innerHTML;
            let originalContents = document.body.innerHTML
            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        },
        synopsis (inputString){
            var div = document.createElement('div')
            div.innerHTML = inputString
            return div.textContent.slice(0, 200)
        },
    }
}
</script>