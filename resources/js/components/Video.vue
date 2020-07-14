<template>
	<div>
		<div class v-for="video in videos" :key="video.id">
			<div class="all row articles">
				<div class="coursevids">
					<div class="main-container">
						<div class=" darken-3">
							<div class="col s12 m7 l8 course">
								<h1>{{video.coursename}}</h1>
								<div class="about">{{video.about}}</div>
								<span class="mr3">Created by Admin</span>
								<!-- <span class="mr3">20000 students enrolled</span> -->
								<span class="mr3">Last Updated on {{video.updated_at.substr(0,10)}}</span>
								<span class="mr3">
									<i class="material-icons language">language</i>{{video.language.language}}
								</span>
								
							</div>
							<div class="col s12 m4 l4 preview">
								<div class="card small">
									<div class="card-image">
										<img :src="'/courseImages/'+video.image" alt="preview image" class="image" />
										<span class="card-title"></span>
										<div class="overlay">
											<div href="#" class="icon icons" title="Preview Course">
												<i class="material-icons play_arrow large ">play_arrow</i>
											</div>
										</div>
										<div class="bottomleft">Preview this Course</div>
									</div>
									<div class="card-content">
										<p class="center">
											<button class="btn-large red text-white">Watch this Video</button>
										</p>
									</div>
									<!-- <div class="card-action">
									<a href="#">This is a link</a>
									</div> -->
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="main-container">
					<div class="col s12 m7 to_learn">
						<h6>By the end of this course, You will learn</h6>
						<div class="col s12 m6 l6">
							<p v-for="to_learn in to_learns" :key="to_learn.index">
								<i class="material-icons">check</i>{{to_learn}}
							</p>
						</div>
					</div>
					<div class="col s12 m7 course-content">
						<p class="paragraph-course-content">Course content</p><span class="mr3">{{video.length}} courses</span>
						<accordion>
							<accordion-item>
								<!-- This slot will handle the title/header of the accordion and is the part you click on -->
								<template slot="accordion-trigger">
									<h6>Section {{video.videos.section}}</h6>
								</template>
								<!-- This slot will handle all the content that is passed to the accordion -->
								<template slot="accordion-content">
									<span v-for="video in  video.videos" :key="video.id">
										{{video.video}}
									</span>
								</template>
							</accordion-item>
						</accordion>
					</div>
					<div class="col s12 m7 l7 requirement">
						<h6>Requirements</h6>
						<ul style="list-style-type: circle"  v-for="requirement in requirements" :key="requirement.id">
							<li>{{requirement}}</li>
						</ul>
					</div>
					<div class="col s12 m7 l7" id="more-info">
						<h6>Description</h6>
						{{video.description}}
					</div>
				</div>
		
			</div>
		</div>
	</div>
</template>
<script>
import Accordion from '../components/reusable/Accordion'
import AccordionItem from '../components/reusable/Accordion-item'
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
		let a = response.data.course[0].to_learn;
		this.to_learns = a.replace(/([.?!])\s*(?=[A-Z])/g, "$1|").split("|");
		let b = response.data.course[0].requirements;
		this.requirements = b.replace(/([.?!])\s*(?=[A-Z])/g, "$1|").split("|");
		console.log(response)
        this.videos = response.data.course;
        this.previews = response.data.preview[0].videoName;
		this.allVideo = response.data.othervids;
		
        
      })
      .catch(err => console.log(err.response));
  },
  mounted() {
    console.log("mounted");
  },
  methods: {
   
  },
  computed: {
	  
  }
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
	font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
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
.language, .price {
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
.card{
	border-radius: 10px;
}
div.card-image {
	border-radius: 5px;
	position: relative;
}
.card.small .card-image, .card.medium .card-image, .card.large .card-image {
    max-height: 70%;
    border: 4px solid;
}
.to_learn{
	border: 1px solid #0000;
	background-color: #dad6d662;
	margin-bottom: 10px;
}

.pl {
	padding-left: 12px;
}
.accordion, .accordion-item {
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
.play_arrow:hover, .card-image:hover {
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
</style>