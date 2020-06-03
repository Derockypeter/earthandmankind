// import Vue from 'vue'
// import VueRouter from 'vue-router'

// import store from './store'

// Vue.use(VueRouter)

// // USER
// import Dashboard from './components/user/Dashboard.vue'
// import BibleTeaching from './components/bible/BibleTeaching.vue'

// import Home from './components/HomeComponent.vue'
// import BibleTeachings from './components/BibleTeachingsComponent.vue'
// import Library from './components/LibraryComponent.vue'
// import Blog from './components/BlogComponent.vue'
// import CategorySelect from './components/CategorySectionComponent.vue'
// import Contact from './components/ContactUsComponent.vue'
// import Footer from './components/FooterComponent.vue'
// import About from './components/AboutUsComponent.vue'
// import Login from './components/LoginComponent.vue'
// import Register from './components/RegisterComponent.vue'

// // REUSABLE
// import NotFound from '../js/components/reusable/NotFound.vue'
// import Pagination from './components/reusable/Pagination.vue'


// // ADMIN SECTION
// import CreatePost from './components/admin/post/CreateComponent.vue'
// import EditPost from './components/admin/post/EditComponent.vue'
// import Admin from './components/admin/AdminComponent.vue'
// import IndexPost from './components/admin/post/PostComponent.vue'
// import Postbody from './components/PostBodyComponent.vue'
// import PostCategory from './components/PostCategory.vue'

// import EditCategory from './components/admin/category/EditComponent.vue'
// import CreateCategory from './components/admin/category/CreateComponent.vue'
// import IndexCategory from './components/admin/category/CategoryComponent.vue'

// import EditVideo from './components/admin/videos/EditComponent.vue'
// import CreateVideo from './components/admin/videos/CreateComponent.vue'
// import IndexVideo from './components/admin/videos/VideoComponent.vue'

// import EditBook from './components/admin/book/EditComponent.vue'
// import CreateBook from './components/admin/book/CreateComponent.vue'
// import IndexBook from './components/admin//book/BookComponent.vue'


// const router = [
//         {
//             path: '/',
//             name: 'home',
//             component: Home,
//             props: {

//             }
//         },
//         {
//             path: '/bible-teachings',
//             name: 'bible-teachings',
//             component: BibleTeachings,
//             props: {
                
//             }
//         },
//         {
//             path: '/bible-teach/all',
//             name: 'bible-teach_all',
//             component: BibleTeaching
//         },
//         {
//             path: '/library',
//             name: 'library',
//             component: Library,
//             props: {
                
//             },
//         },
//         {
//             path: '/blog',
//             name: 'blog',
//             component: Blog,
//             props: {
                
//             }
//         },
//         {
//             path: '/dashboard',
//             name: 'dashboard',
//             component: Dashboard,
//             meta: {
//                 requiresAuth: true,
//                 is_user: true
//             }
//         },
//         {
//             path: '/admin/:page',
//             name: 'admin-pages',
//             component: Admin,
//             meta: {
//                 requiresAuth: true,
//                 is_admin: true
//             }
//         },
//         {
//             path: '/admin',
//             name: 'admin',
//             component: Admin,
//             meta: {
//                 requiresAuth: true,
//                 is_admin: true
//             }
//         },
//         // {
//         //     path: '/admin/create-post',
//         //     name: 'create-post',
//         //     component: CreatePost,
//         //     props: {

//         //     }
//         // },
//         // {
//         //     path: '/admin/edit-post/:id',
//         //     name: 'edit-post',
//         //     component: EditPost,
//         //     props: {
                
//         //     }
//         // },
//         // {
//         //     path: '/admin/post/index',
//         //     name: 'index-post',
//         //     component: IndexPost,
//         //     props: {
                
//         //     }
//         // },
//         // {
//         //     path: '/admin/category/index',
//         //     name: 'index-category',
//         //     component: IndexCategory,
//         //     props: {
                
//         //     }
//         // },
//         // {
//         //     path: '/admin/edit/:id',
//         //     name: 'edit-cat',
//         //     component: EditCategory,
//         //     props: {
                
//         //     }
//         // },
//         // {
//         //     path: '/admin/create-cat',
//         //     name: 'create-cat',
//         //     component: CreateCategory,
//         //     props: {},
//         // },
//         // {
//         //     path: '/admin/video/index',
//         //     name: 'index-video',
//         //     component: IndexVideo,
//         //     props: {
                
//         //     }
//         // },
//         // {
//         //     path: '/admin/edit-vid/:id',
//         //     name: 'edit-video',
//         //     component: EditVideo,
//         //     props: {
                
//         //     }
//         // },
//         // {
//         //     path: '/admin/create-vid',
//         //     name: 'create-vid',
//         //     component: CreateVideo,
//         //     props: {},
//         // },
//         // {
//         //     path: '/admin/create-book',
//         //     name: 'create-book',
//         //     component: CreateBook,
//         //     props: {

//         //     }
//         // },
//         // {
//         //     path: '/admin/edit-book/:id',
//         //     name: 'edit-book',
//         //     component: EditBook,
//         //     props: {
                
//         //     }
//         // },
//         // {
//         //     path: '/admin/index',
//         //     name: 'index-book',
//         //     component: IndexBook,
//         //     props: {
                
//         //     }
//         // },
//         {
//             path: '/post/:title',
//             name: 'post-title',
//             component: Postbody,
//             props: {}
//         },
//         {
//             path: '/posts/',
//             name: 'post',
//             component: PostCategory,
//             props: {}
//         },
//         {
//             path: '/contact',
//             name: 'contact',
//             component: Contact,
//             props: {}
//         },
//         {
//             path: '/about',
//             name: 'about',
//             component: About,
//             props: {}
//         },
//         {
//             path: '/login',
//             name: 'login',
//             component: Login,
//             props: {}
//         },
//         {
//             path: '/register',
//             name: 'register',
//             component: Register,
//             props: {}
//         },
//         {   path: '/404',
//             name: '404', 
//             component: NotFound 
//         },
//         {   path: '*', 
//             redirect: '/404' 
//         },
//     ]
//     router.beforeEach((to, from, next) => {
//         // to and from are both route objects. must call `next`.
//         if (to.matched.some(record => record.meta.requiresAuth)) {
//             if (localStorage.getItem('manKind.jwt') == null) {
//                 next({
//                     path: '/login',
//                     params: { nextUrl: to.fullPath}
//                 })
//             }
//             else {
//                 let user = JSON.parse(localStorage.getItem('manKind.user'))
//                 if (to.matched.some(record => record.meta.is_admin)) {
//                     if (user.is_admin == 1) {
//                         next()
//                     }
//                     else {
//                         next({ name: 'dashboard'})
//                     }
//                 }
//                 else if (to.matched.some(record => record.meta.is_user)) {
//                     if (user.is_admin == 0) {
//                         next()
//                     }
//                     else {
//                         next({ name: 'admin' })
//                     }
//                 }
//                 next()
//             }
//         }
//         else {
//             next()
//         }
//     })
// export default new VueRouter({mode: 'history', router})
