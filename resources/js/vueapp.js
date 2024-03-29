import Vue from 'vue'
import VueRouter from 'vue-router'
import VueAxios from 'vue-axios'
import axios from 'axios'
import VueHead from 'vue-head'

// import VueSocialSharing from 'vue-social-sharing'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faEnvelope } from '@fortawesome/free-solid-svg-icons'
import { faFacebook, faTwitter, faWhatsapp } from '@fortawesome/free-brands-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import 'materialize-css/dist/js/materialize.min'
import M from 'materialize-css/dist/css/materialize.min.css'
// import 'materialize-css/dist/fonts/material-icons.css'

import DatePicker from "vue2-datepicker";
import "vue2-datepicker/index.css";
import "viewerjs/dist/viewer.css";
import Viewer from "v-viewer";

library.add(faFacebook, faTwitter, faEnvelope, faWhatsapp)
Vue.use(VueAxios, axios)
Vue.use(VueHead)
Vue.use(VueRouter)
// Vue.use(VueSocialSharing);
Vue.component('font-awesome-icon', FontAwesomeIcon)
Vue.use(M)
Vue.use(Viewer)
Vue.component('date-picker', DatePicker)

Vue.config.productionTip = true

import App from './components/AppComponent.vue'

import Dashboard from './components/user/Dashboard.vue'

import AdminRegister from './components/admin/RegisterComponent.vue'

import Home from './components/HomeComponent'
import Article from './components/BlogComponent.vue'
import Library from './components/LibraryComponent.vue'
import Contact from './components/ContactUsComponent.vue'
import Footer from './components/FooterComponent.vue'
import Login from './components/LoginComponent.vue'
// import Register from './components/RegisterComponent.vue'
import Video from './components/Video.vue'
import Password from './components/PasswordResetForm.vue'
import FBCallback from './components/FBCallback.vue'
import Gallery from './components/GalleryComponent.vue'
import SingleBook from './components/SingleBookComponent.vue'
import Videos from './components/VideosComponent.vue'
import Audios from './components/AudioComponent.vue'
import Tour from './components/Tour.vue'



// REUSABLE
import NotFound from '../js/components/reusable/NotFound.vue'
import Pagination from './components/reusable/Pagination.vue'


// ADMIN SECTION
import CreatePost from './components/admin/post/CreateComponent.vue'
import EditPost from './components/admin/post/EditComponent.vue'
import Admin from './components/admin/AdminComponent.vue'
import IndexPost from './components/admin/post/PostComponent.vue'

import EditLanguage from './components/admin/language/EditComponent.vue'
import CreateLanguage from './components/admin/language/CreateComponent.vue'
import IndexLanguage from './components/admin/language/LanguageComponent.vue'

import EditTour from './components/admin/tour/EditComponent.vue'
import CreateTour from './components/admin/tour/CreateComponent.vue'
import IndexTour from './components/admin/tour/TourComponent.vue'

import EditVideo from './components/admin/videos/EditComponent.vue'
import CreateVideo from './components/admin/videos/CreateComponent.vue'
import IndexVideo from './components/admin/videos/VideoComponent.vue'

import EditBook from './components/admin/book/EditComponent.vue'
import CreateBook from './components/admin/book/CreateComponent.vue'
import IndexBook from './components/admin/book/BookComponent.vue'

import EditImgGallery from './components/admin/dictionary/EditComponent.vue'
import CreateImgGallery from './components/admin/dictionary/CreateComponent.vue'
import IndexImgGallery from './components/admin/dictionary/ImageComponent.vue'


import EditAudio from './components/admin/audio/EditComponent.vue'
import CreateAudio from './components/admin/audio/CreateComponent.vue'
import IndexAudio from './components/admin/audio/AudioComponent.vue'

const router = new VueRouter ({
  mode: 'history',
  routes: [
    	{
            path: '/',
            name: 'home',
            component: Home,
            props: {

            },
            meta: {
                auth: false,
                title: 'Earth and mankind'
            }

        },
        {
            path: '/library',
            name: 'library',
            component: Library,
            props: {
                
            },
            meta: {
                auth: false,
                title: 'Earth and Mankind - Library'
            }
        },
        {
            path: '/article',
            name: 'article',
            component: Article,
            props: {
                
            },
            meta: {
                auth: false,
                title: 'Earth and Mankind - Article',
            }
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: Dashboard,
            meta: {
                requiresAuth: true,
                is_user: true,
                title: 'Earth and Mankind - Dashboard'
            },
        },
        {
            path: '/gallery',
            name: 'gallery',
            component: Gallery,
            meta: {
                auth: false,
                title: 'Earth and Mankind - Gallery'
            }
        },
        {
            path: '/tour',
            name: 'tour',
            component: Tour,
            meta: {
                auth: false,
                title: 'Earth and Mankind - Tours'
            }
        },
        {
            path: '/registerasAdminPortal',
            name: 'adminRegex',
            component: AdminRegister,
            meta: {
                auth: true,
                title: 'Earth and Mankind - Admin Register'
            }
        },
        {
            path: '/admin/:page',
            name: 'admin-pages',
            component: Admin,
            meta: {
                requiresAuth: true,
                is_admin: true,
                title: 'Earth and Mankind - Admin'

            }
        },
        {
            path: '/admin',
            name: 'admin',
            component: Admin,
            meta: {
                requiresAuth: true,
                is_admin: true,
                title: 'Earth and Mankind - Admin'
            }
        },
        {
            path: '/admin/create-post',
            name: 'create-post',
            component: CreatePost,
            props: {

            },
            meta: {
                title: 'Earth and Mankind - Create Post'
            }
        },
        {
            path: '/admin/edit-post/:id',
            name: 'edit-post',
            component: EditPost,
            props: {
                
            },
            meta: {
                title: 'Earth and Mankind - Add Video'
            }
        },
        
        
        {
            path: '/admin/edit/:id',
            name: 'edit-lang',
            component: EditLanguage,
            props: {
                
            },
            meta: {
                title: 'Earth and Mankind - Edit Language'
            }
        },
        {
            path: '/admin/create-lang',
            name: 'create-lang',
            component: CreateLanguage,
            props: {},
            meta: {
                title: "Earth and Mankind - Create Language"
            }
        },

        
        {
            path: '/admin/edit/:id',
            name: 'edit-tour',
            component: EditTour,
            props: {
                
            },
            meta: {
                title: 'Earth and Mankind - Edit Tour'
            }
        },
        {
            path: '/admin/create-tour',
            name: 'create-tour',
            component: CreateTour,
            props: {},
            meta: {
                title: "Earth and Mankind - Create Tour"
            }
        },

        {
            path: '/admin/video/index',
            name: 'index-video',
            component: IndexVideo,
            props: {
                
            },
            meta: {
                title: "Earth and Mankind - Video"
            }
        },
        {
            path: '/admin/edit-course/:id',
            name: 'edit-course',
            component: EditVideo,
            props: {
                
            },
            meta: {
                title: "Earth and Mankind - Edit Video"
            }
        },
        {
            path: '/admin/create-vid',
            name: 'create-vid',
            component: CreateVideo,
            props: {},
            meta: {
                title: "Earth and Mankind - Create Video"
            }
        },
        {
            path: '/admin/create-book',
            name: 'create-book',
            component: CreateBook,
            props: {

            },
            meta: {
                title: "Earth and Mankind - Create Books"
            }
        },
        {
            path: '/admin/edit-book/:id',
            name: 'edit-book',
            component: EditBook,
            props: {
                
            },
            meta: {
                title: "Earth and Mankind - Edit Books"
            }
        },
        {
            path: '/admin/index',
            name: 'index-book',
            component: IndexBook,
            props: {
                
            },
            meta: {
                title: "Earth and Mankind - Books"
            }
        },
        {
            path: '/admin/create-gallery',
            name: 'create-gallery',
            component: CreateImgGallery,
            props: {

            },
            meta: {
                title: "Earth and Mankind - Create Gallery"
            }
        },
        {
            path: '/admin/edit-gallery/:id',
            name: 'edit-gallery',
            component: EditImgGallery,
            props: {
                
            },
            meta: {
                title: "Earth and Mankind - Edit gallery"
            }
        },
        {
            path: '/admin/index',
            name: 'index-gallery',
            component: IndexImgGallery,
            props: {
                
            },
            meta: {
                title: "Earth and Mankind - image gallery"
            }
        },
        {
            path: '/admin/create-audio',
            name: 'create-audio',
            component: CreateAudio,
            props: {

            },
            meta: {
                title: "Earth and Mankind - Create Audio"
            }
        },
        {
            path: '/admin/edit-audio/:id',
            name: 'edit-audio',
            component: EditAudio,
            props: {
                
            },
            meta: {
                title: "Earth and Mankind - Edit Audio"
            }
        },
        {
            path: '/admin/index',
            name: 'index-audio',
            component: IndexAudio,
            props: {
                
            },
            meta: {
                title: "Earth and Mankind - Audio"
            }
        },
        {
            path: '/books/:bookname',
            name: 'mybook',
            component: SingleBook,
            props: {},
            meta: {
                title: "Earth and Mankind - Book"
            }
        },
        {
            path: '/library/:coursename',
            name: 'course',
            component: Video,
            props: {},
            meta: {
                title: "Earth and Mankind - Videos"
            }
        },
        {
            path: '/mankindvideos',
            name: 'videos',
            component: Videos,
            props: {},
            meta: {
                title: "Earth and Mankind - Videos"
            }
        },
        {
            path: '/mankind-audio',
            name: 'audio',
            component: Audios,
            props: {},
            meta: {
                title: "Earth and Mankind - Audio"
            }
        },
        {
            path: '/contact',
            name: 'contact',
            component: Contact,
            props: {},
            meta: {
                title: 'Earth and Mankind - Contact'
            }
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
            props: {},
            meta: {
                title: 'Earth and Mankind - Login'
            }
        },
        // {
        //     path: '/register',
        //     name: 'register',
        //     component: Register,
        //     props: {},
        //     meta: {
        //         title: "Earth and Mankind - Register"
        //     }
        // },
        {
            path: '/password_reset/:token',
            name: 'reset_password',
            component: Password,
            props: {},
            meta: {
                title: "Earth and Mankind - Password Reset"
            }
        },
        {
            path: '/api/auth/login/facebook/callback?code',
            name: 'fbLogin',
            component: FBCallback,
            props: {},
        },
        {   path: '/404',
            name: '404', 
            component: NotFound,
            meta: {
                title: 'Earth and Mankind - 404'
            }
        },
        {   path: '*', 
            redirect: '/404' 
        },
	],
})

    router.beforeEach((to, from, next) => {
        // to and from are both route objects. must call `next`.
        if (to.matched.some(record => record.meta.requiresAuth)) {
            if (localStorage.getItem('manKind.jwt') == null) {
                next({
                    path: '/login',
                    params: { nextUrl: to.fullPath}
                })
            }
            else {
                let user = JSON.parse(localStorage.getItem('manKind.user'))
                if (to.matched.some(record => record.meta.is_admin)) {
                    if (user.is_admin == 1) {
                        next()
                    }
                    else {
                        next({ name: 'dashboard'})
                    }
                }
                else if (to.matched.some(record => record.meta.is_user)) {
                    if (user.is_admin == 0) {
                        next()
                    }
                    else {
                        next({ name: 'admin' })
                    }
                }
                next()
            }
        }
        else {
            next()
        }
    })
   
const app = new Vue({
	el: '#app',
    // el: '#app',
    components: { App },
    watch: {
        '$route':{
            handler: (to, from) => {
                document.title = to.meta.title || 'Your Website'
            },
            immediate: true
        }
    },
    mounted() {
        
    },
	router
})