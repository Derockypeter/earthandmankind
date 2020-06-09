import Vue from 'vue'
import VueRouter from 'vue-router'
import VueAxios from 'vue-axios'
import axios from 'axios'
Vue.use(VueAxios, axios)
Vue.use(VueRouter)

import App from './components/AppComponent.vue'

import 'materialize-css/dist/js/materialize.min'
import M from 'materialize-css/dist/css/materialize.min.css'
import 'materialize-css/dist/fonts/material-icons.css'
Vue.use(M)
import Dashboard from './components/user/Dashboard.vue'

import Home from './components/HomeComponent.vue'
import Library from './components/LibraryComponent.vue'
import Article from './components/BlogComponent.vue'
import CategorySelect from './components/CategorySectionComponent.vue'
import Contact from './components/ContactUsComponent.vue'
import Footer from './components/FooterComponent.vue'
import About from './components/AboutUsComponent.vue'
import Login from './components/LoginComponent.vue'
import Register from './components/RegisterComponent.vue'
import Video from './components/Video.vue'

// REUSABLE
import NotFound from '../js/components/reusable/NotFound.vue'
import Pagination from './components/reusable/Pagination.vue'


// ADMIN SECTION
import CreatePost from './components/admin/post/CreateComponent.vue'
import EditPost from './components/admin/post/EditComponent.vue'
import Admin from './components/admin/AdminComponent.vue'
import IndexPost from './components/admin/post/PostComponent.vue'
import Postbody from './components/PostBodyComponent.vue'

import EditLanguage from './components/admin/language/EditComponent.vue'
import CreateLanguage from './components/admin/language/CreateComponent.vue'
import IndexLanguage from './components/admin/language/LanguageComponent.vue'

import EditVideo from './components/admin/videos/EditComponent.vue'
import CreateVideo from './components/admin/videos/CreateComponent.vue'
import IndexVideo from './components/admin/videos/VideoComponent.vue'
import Addvideo from './components/admin/videos/Addvideo.vue'
import CourseVid from './components/admin/videos/CourseVideos.vue'

import EditBook from './components/admin/book/EditComponent.vue'
import CreateBook from './components/admin/book/CreateComponent.vue'
import IndexBook from './components/admin//book/BookComponent.vue'


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
            path: '/library',
            name: 'library',
            component: Library,
            props: {
                
            },
        },
        {
            path: '/article',
            name: 'article',
            component: Article,
            props: {
                
            }
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: Dashboard,
            meta: {
                requiresAuth: true,
                is_user: true
            }
        },
        {
            path: '/admin/:page',
            name: 'admin-pages',
            component: Admin,
            meta: {
                requiresAuth: true,
                is_admin: true
            }
        },
        {
            path: '/admin',
            name: 'admin',
            component: Admin,
            meta: {
                requiresAuth: true,
                is_admin: true
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
            path: '/admin/addvid/:id',
            name: 'add-video',
            component: Addvideo,
            props: {

            }
        },
        {
            path: '/admin/course/:id',
            name: 'coursevid',
            component: CourseVid,
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
        
        
        {
            path: '/admin/edit/:id',
            name: 'edit-lang',
            component: EditLanguage,
            props: {
                
            }
        },
        {
            path: '/admin/create-lang',
            name: 'create-lang',
            component: CreateLanguage,
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
            path: '/admin/edit-course/:id',
            name: 'edit-course',
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
        {
            path: '/admin/index',
            name: 'index-book',
            component: IndexBook,
            props: {
                
            }
        },
        {
            path: '/post/:title',
            name: 'post-title',
            component: Postbody,
            props: {}
        },
        {
            path: '/library/:coursename',
            name: 'course',
            component: Video,
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
	components: { App },
	router
})