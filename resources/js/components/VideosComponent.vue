<template>
    <div class="container">
        <div class="articles">
            <div class="main-container">
                <div class="center" v-if="!loaded" style="height: 500px">
                    <div
                        style="top: 250px"
                        class="preloader-wrapper small active"
                    >
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
                    <section class="library-banner">
                        <h1>Videos</h1>
                        <p class="lead">
                            <!-- Our Wealth of books and videos to feed your mind with daily motivation and guidance. -->
                        </p>
                    </section>
                    <div class="row">
                        <div id="vidoes" class="col s12">
                            <section class="videos">
                                <div class="course row">
                                    <div
                                        v-for="video in videos"
                                        :key="video.id"
                                        class="col s12 m6 l4"
                                    >
                                        <div class="card">
                                            <router-link
                                                :to="{
                                                    name: 'course',
                                                    params: {
                                                        coursename: video.name
                                                    }
                                                }"
                                            >
                                                <div class="card-image">
                                                    <img
                                                        :src="
                                                            `https://img.youtube.com/vi/${video.youtubeEmbedUrl}/hqdefault.jpg`
                                                        "
                                                        alt="preview image"
                                                    />
                                                    <span
                                                        class="card-title"
                                                    ></span>
                                                </div>
                                            </router-link>
                                            <div class="card-content">
                                                <p class="coursename">
                                                    {{
                                                        video.name.substr(
                                                            0,
                                                            20
                                                        )
                                                    }}..
                                                </p>
                                                <p class="bold">
                                                    Created by EarthandMankind
                                                    <span class="right">{{
                                                        video.language
                                                    }}</span>
                                                </p>
                                            </div>
                                            <div class="card-action">
                                                <span
                                                    >{{
                                                        video.length
                                                    }}
                                                    videos</span
                                                >
                                                <router-link
                                                    :to="{
                                                        name: 'course',
                                                        params: {
                                                            coursename:
                                                                video.name
                                                        }
                                                    }"
                                                >
                                                </router-link>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        v-if="videos.length == 0"
                                        style="color: grey; font-size: 30px; text-align: center"
                                    >
                                        <marquee
                                            >VIDEOS ARE COMING SOON</marquee
                                        >
                                    </div>
                                </div>
                            </section>
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
            loaded: false,
            videos: [],
            videoImage: ""
        };
    },
    mounted() {
        this.getAllVideos();
    },
    methods: {
        getAllVideos() {
            let video_uri = "/api/getAllVideos";
            this.axios
                .get(video_uri)
                .then(response => {
                    setTimeout(() => {
                        this.loaded = true;
                        let youtubeId = [];
                        let idHolder, newYoutubeEmbedurl;
                        response.data.forEach((element, index) => {
                            idHolder = this.extractId(element.youtubeEmbedUrl);
                            youtubeId.push(idHolder);
                            for (let x of youtubeId.keys()) {
                                if (x == index) {
                                    newYoutubeEmbedurl = element.youtubeEmbedUrl = idHolder;
                                }
                            }
                            this.videos = response.data;
                        });
                    }, 1000);
                })
                .catch(err => {
                    console.log(err);
                });
        },
        extractId(url) {
            var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/;
            var match = url.match(regExp);
            return match && match[7].length == 11 ? match[7] : false;
        }
    }
};
</script>
<style scoped>
.articles {
    margin-top: 2vh;
    box-shadow: 13px 13px 20px grey;
}
.library-banner h1 {
    margin: 1.5rem 0rem;
}
.tabs .tab a,
.tabs .tab a:hover,
.tabs .tab a.active {
    background-color: grey;
    color: #f1e8e8;
}
.tabsCol {
    padding: 0px;
}
.bold {
    font-weight: bold;
}
.coursename {
    font-size: 24px;
    text-transform: capitalize;
}
.card
    .card-action
    span:not(.btn):not(.btn-large):not(.btn-small):not(.btn-large):not(.btn-floating) {
    margin-right: 24px;
    transition: color 0.3s ease;
    text-transform: uppercase;
}
a:hover {
    color: darkgrey;
    text-decoration: underline;
}
.material-icons {
    font-size: 18px;
}
.column3 {
    float: left;
    width: 50%;
    padding: 5px;
    background-color: rgb(253, 253, 253);
}
@media screen and (max-width: 500px) {
    .column3 {
        width: 100%;
    }
}
</style>
