<template>
    <main class="container">
        <div class="articles">
            <nav>
                <div class="nav-wrapper">
                    <ul id="nav-mobile" class="center">
                        <li><a class="active" @click="setComponent('main')">Dashboard</a></li>
                        <li><a @click="setComponent('languages')">Languages</a></li>
                        <li><a @click="setComponent('posts')">Posts</a></li>
                        <li><a @click="setComponent('videos')">Videos</a></li>
                        <li><a @click="setComponent('books')">Books</a></li>
                        <li><a @click="setComponent('users')">Users</a></li>
                        <li><a @click="setComponent('dictionary')">Dictionary</a></li>
                        <li title="Register an admin"><a @click="setComponent('register')">Register</a></li>
                    </ul>
                </div>
            </nav>
            <div class="container hero-section">
                <h2 class="title">Admin Dashboard</h2>
            </div>
            <div>
                <component :is="activeComponent"></component>
            </div>
                <!-- </div> -->
            
        </div>
        
    </main>
</template>
<style scoped>
   nav {
       height: 50px;
       background-color: #212121;
   }
   nav ul a {
       display: initial;
   }
   nav a:hover {
       background-color: #666565;
   }
</style>
<script>
import Main from '../admin/Main'
import Users from '../admin/Users'
import Posts from './post/PostComponent'
import languages from './language/LanguageComponent'
import Videos from './videos/VideoComponent'
import Books from './book/BookComponent'
import Dictionary from './dictionary/DictionaryComponent'
import Register from './RegisterComponent'
import Axios from 'axios'

export default {
    data() {
        return {
            user: null,
            activeComponent: null
        }
    },
    components: {
        Main,
        Users,
        Posts,
        languages,
        Videos,
        Books,
        Dictionary,
        Register,
    },
    beforeMount() {
        this.setComponent(this.$route.params.page)
        this.user = JSON.parse(localStorage.getItem('manKind.user'))
        Axios.defaults.headers.common['Content-Type'] = 'application/json'
        Axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('manKind.jwt')
    },
    methods: {
        setComponent(value) {
            switch(value) {
                case "users":
                    this.activeComponent = Users
                    this.$router.push({name: 'admin-pages', params: {page: 'users'}})
                    break;
                case "posts":
                    this.activeComponent = Posts
                    this.$router.push({name: 'admin-pages', params: {page: 'posts'}})
                    break;
                case "languages":
                    this.activeComponent = languages
                    this.$router.push({name: 'admin-pages', params: {page: 'languages'}})
                    break;
                case "videos":
                    this.activeComponent = Videos
                    this.$router.push({name: 'admin-pages', params: {page: 'videos'}})
                    break;
                case "books":
                    this.activeComponent = Books
                    this.$router.push({name: 'admin-pages', params: {page: 'books'}})
                    break;
                case "dictionary":
                    this.activeComponent = Dictionary
                    this.$router.push({name: 'admin-pages', params: {page: 'dictionary'}})
                    break;
                case "register":
                    this.activeComponent = Register
                    this.$router.push({name: 'admin-pages', params: {page: 'register'}})
                    break;
                default:
                    this.activeComponent = Main
                    this.$router.push({name: 'admin'})
                    break
            }
        }
    },
}
</script>