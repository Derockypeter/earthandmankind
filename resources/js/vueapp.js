import Vue from 'vue'
import VueRouter from 'vue-router'
import VueAxios from 'vue-axios'
import axios from 'axios'

import 'materialize-css/dist/js/materialize.min'
import 'materialize-css/dist/css/materialize.min.css'
import 'materialize-css/dist/fonts/material-icons.css'

Vue.use(VueRouter)
    // For Vue-axios // For axios
Vue.use(VueAxios, axios)

import App from './components/AppComponent.vue'
import Home from './components/HomeComponent.vue'
import BibleTeachings from './components/BibleTeachingsComponent.vue'
import Library from './components/LibraryComponent.vue'
import Blog from './components/BlogComponent.vue'
import Carousel from './components/CarouselComponent.vue'
import CategorySelect from './components/CategorySectionComponent.vue'
import Contact from './components/ContactUsComponent.vue'
import Footer from './components/FooterComponent.vue'
import About from './components/AboutUsComponent.vue'
import Login from './components/LoginComponent.vue'
import Register from './components/RegisterComponent.vue'
import Pagination from './components/reusable/Pagination.vue'

// ADMIN SECTION
import CreatePost from './components/admin/post/CreateComponent.vue'
import EditPost from './components/admin/post/EditComponent.vue'
import Admin from './components/admin/AdminComponent.vue'
import IndexPost from './components/admin/post/IndexComponent.vue'
import Postbody from './components/PostBodyComponent.vue'

import EditCategory from './components/admin/category/EditComponent.vue'
import CreateCategory from './components/admin/category/CreateComponent.vue'
import IndexCategory from './components/admin/category/IndexComponent.vue'

import EditVideo from './components/admin/videos/EditComponent.vue'
import CreateVideo from './components/admin/videos/CreateComponent.vue'
import IndexVideo from './components/admin/videos/IndexComponent.vue'


const router = new VueRouter ({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
            props: {

            }
        },
        {
            path: '/bible-teachings',
            name: 'bible-teachings',
            component: BibleTeachings,
            props: {
                
            }
        },
        {
            path: '/library',
            name: 'library',
            component: Library,
            props: {
                
            }
        },
        {
            path: '/blog',
            name: 'blog',
            component: Blog,
            props: {
                
            }
        },
        {
            path: '/admin',
            name: 'admin',
            component: Admin,
            props: {
                
            }
        },
        {
            path: '/admin/posts/create-post',
            name: 'create-post',
            component: CreatePost,
            props: {

            }
        },
        {
            path: '/admin/posts/edit-post/:id',
            name: 'edit-post',
            component: EditPost,
            props: {
                
            }
        },
        {
            path: '/admin/post/index',
            name: 'index-post',
            component: IndexPost,
            props: {
                
            }
        },
        {
            path: '/admin/category/index',
            name: 'index-category',
            component: IndexCategory,
            props: {
                
            }
        },
        {
            path: '/admin/category/edit/:id',
            name: 'edit-cat',
            component: EditCategory,
            props: {
                
            }
        },
        {
            path: '/admin/category/create-cat',
            name: 'create-cat',
            component: CreateCategory,
            props: {},
        },
        {
            path: '/admin/video/index',
            name: 'index-video',
            component: IndexVideo,
            props: {
                
            }
        },
        {
            path: '/admin/video/edit/:id',
            name: 'edit-video',
            component: EditVideo,
            props: {
                
            }
        },
        {
            path: '/admin/video/create-vid',
            name: 'create-vid',
            component: CreateVideo,
            props: {},
        },
        {
            path: '/posts/:title',
            name: 'post',
            component: Postbody,
            props: {}
        },
        {
            path: '/contact',
            name: 'contact',
            component: Contact,
            props: {}
        },
        {
            path: '/about',
            name: 'about',
            component: About,
            props: {}
        },
        {
            path: '/auth/login',
            name: 'login',
            component: Login,
            props: {}
        },
        {
            path: '/auth/register',
            name: 'register',
            component: Register,
            props: {}
        },
        {
            path: '*',
            redirect: '/'
        },
    ]
})

const app = new Vue({
    el: '#app',
    components: { App },
    router
})