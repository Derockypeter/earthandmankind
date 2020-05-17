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
import NotFound from './components/reusable/NotFound.vue'

// ADMIN SECTION
import CreatePost from './components/admin/post/CreateComponent.vue'
import EditPost from './components/admin/post/EditComponent.vue'
import Admin from './components/admin/AdminComponent.vue'
import IndexPost from './components/admin/post/IndexComponent.vue'
import Postbody from './components/PostBodyComponent.vue'
import PostCategory from './components/PostCategory.vue'

import EditCategory from './components/admin/category/EditComponent.vue'
import CreateCategory from './components/admin/category/CreateComponent.vue'
import IndexCategory from './components/admin/category/IndexComponent.vue'

import EditVideo from './components/admin/videos/EditComponent.vue'
import CreateVideo from './components/admin/videos/CreateComponent.vue'
import IndexVideo from './components/admin/videos/IndexComponent.vue'

import EditBook from './components/admin/book/EditComponent.vue'
import CreateBook from './components/admin/book/CreateComponent.vue'
import IndexBook from './components/admin/book/IndexComponent.vue'


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
            path: '/admin/create-post',
            name: 'create-post',
            component: CreatePost,
            props: {

            }
        },
        {
            path: '/admin/edit-post/:id',
            name: 'edit-post',
            component: EditPost,
            props: {
                
            }
        },
        // {
        //     path: '/admin/post/index',
        //     name: 'index-post',
        //     component: IndexPost,
        //     props: {
                
        //     }
        // },
        // {
        //     path: '/admin/category/index',
        //     name: 'index-category',
        //     component: IndexCategory,
        //     props: {
                
        //     }
        // },
        {
            path: '/admin/edit/:id',
            name: 'edit-cat',
            component: EditCategory,
            props: {
                
            }
        },
        {
            path: '/admin/create-cat',
            name: 'create-cat',
            component: CreateCategory,
            props: {},
        },
        // {
        //     path: '/admin/video/index',
        //     name: 'index-video',
        //     component: IndexVideo,
        //     props: {
                
        //     }
        // },
        {
            path: '/admin/edit-vid/:id',
            name: 'edit-video',
            component: EditVideo,
            props: {
                
            }
        },
        {
            path: '/admin/create-vid',
            name: 'create-vid',
            component: CreateVideo,
            props: {},
        },
        {
            path: '/admin/create-book',
            name: 'create-book',
            component: CreateBook,
            props: {

            }
        },
        {
            path: '/admin/edit-book/:id',
            name: 'edit-book',
            component: EditBook,
            props: {
                
            }
        },
        // {
        //     path: '/admin/index',
        //     name: 'index-book',
        //     component: IndexBook,
        //     props: {
                
        //     }
        // },
        {
            path: '/posts/:title',
            name: 'post-title',
            component: Postbody,
            props: {}
        },
        {
            path: '/posts/',
            name: 'post',
            component: PostCategory,
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
            path: '/login',
            name: 'login',
            component: Login,
            props: {}
        },
        {
            path: '/register',
            name: 'register',
            component: Register,
            props: {}
        },
        {   path: '/404',
            name: '404', 
            component: NotFound 
        },
        {   path: '*', 
            redirect: '/404' 
        },
    ]
})

const app = new Vue({
    el: '#app',
    components: { App },
    router
})