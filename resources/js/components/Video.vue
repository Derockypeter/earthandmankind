<template>
    <div>
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
        <div class="container">
            <div class="articles">
                <div class="main-container">
                    <div v-for="video in videos" :key="video.id">
                        <h4>{{ video.videos[0].name }}</h4>

                        <video class="responsive-video" controls>
                            <source
                                :src="'/videos/' + video.videos[0].video"
                                type="video/mp4"
                            />
                        </video>

                        <p>{{ video.description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Accordion from "../components/reusable/Accordion";
import AccordionItem from "../components/reusable/Accordion-item";
export default {
    data() {
        return {
            video: "",
            videos: [],
            previews: [],
            allVideo: [],
            isLoggedIn: localStorage.getItem("manKind.jwt"),
            to_learns: [],
            requirements: [],
            loaded: false
        };
    },
    components: {
        Accordion,
        AccordionItem
    },
    created() {
        let video_uri = `/api/course/${this.$route.params.coursename}`;
        this.axios
            .get(video_uri)
            .then(response => {
                this.loaded = true;
                let a = response.data.course[0].to_learn;
                this.to_learns = a
                    .replace(/([.?!])\s*(?=[A-Z])/g, "$1|")
                    .split("|");
                let b = response.data.course[0].requirements;
                this.requirements = b
                    .replace(/([.?!])\s*(?=[A-Z])/g, "$1|")
                    .split("|");
                // console.log(response);
                this.videos = response.data.course;
                // this.previews = response.data.preview[0].videoName;
                // this.allVideo = response.data.othervids;
            })
            .catch(err => console.log(err));
    },
    mounted() {
        M.AutoInit();
    },
    methods: {},
    computed: {}
};
</script>
<style scoped>
.coursevids {
    height: 40vh;
    background-color: #485158;
    color: #f9fbfe;
}
.about {
    margin-bottom: 5px;
    font-size: 20px;
    font-family: "Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS",
        sans-serif;
}
.mr3 {
    margin-right: 15px;
    font-size: 1em;
}
div.col.s12.m4.l4.preview {
    margin-top: 30px;
    float: right;
    clear: right;
}
.language,
.price {
    font-size: 18px;
    color: rgb(155, 147, 147);
}
.main-container {
    width: 95%;
}
.card .card-image img {
    height: 185px;
}
.card.small {
    height: 500px;
}
.card {
    border-radius: 10px;
}
div.card-image {
    border-radius: 5px;
    position: relative;
}
.card.small .card-image,
.card.medium .card-image,
.card.large .card-image {
    max-height: 70%;
    border: 4px solid;
}
.to_learn {
    border: 1px solid #0000;
    background-color: #dad6d662;
    margin-bottom: 10px;
}

.pl {
    padding-left: 12px;
}
.accordion,
.accordion-item {
    background: whitesmoke;
    margin-bottom: 10px;
}
.image {
    width: 100%;
}
.icon {
    color: white;
    font-size: 100px;
    position: absolute;
    border-radius: 50px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    text-align: center;
}
i.large {
    font-size: 5rem;
}
.play_arrow:hover,
.card-image:hover {
    font-size: 5.5rem;
    cursor: pointer;
}
.icons {
    height: 100px;
    width: 100px;
    line-height: 100px;
    background-color: rgba(145, 145, 141, 0.438);
}
.bottomleft {
    position: absolute;
    bottom: 8px;
    top: 85%;
    left: 50%;
    font-size: 15px;
    font-weight: 600;
    transform: translate(-50%, -50%);
}
h6 {
    font-weight: 700;
}
.paragraph-course-content {
    display: inline-block;
    font-weight: 600;
    font-size: 1.5rem;
    margin-right: 200px;
}
.smaller {
    font-size: 13px;
    padding-right: 20px;
}
.underline {
    border-bottom: 0.01px solid;
}
.smallPreview {
    color: #1e5ebe;
    font-size: 10px;
}
</style>
