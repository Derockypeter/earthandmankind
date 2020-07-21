<template>
    <div>
        <header>
            <nav style="background-color: #424242;">
                <div class="container">
                    <div class="nav-wrapper">
                        <a href="#!" class="brand-logo logo-pr-6">EARTHANDMANKIND.ORG</a>
                        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                        <ul class="right hide-on-med-and-down pr-6">
                            <li><router-link :to="{ name:'home'}">HOME</router-link></li>
                            <li><router-link :to="{name: 'about'}">ABOUT</router-link></li>
                            <li><router-link :to="{ name:'library'}">LIBRARY</router-link></li>
                            <li><router-link :to="{ name:'article'}">ARTICLES</router-link></li>
                            <li><router-link :to="{name: 'contact'}">CONTACT</router-link></li>
                            <li v-if='!isLoggedIn' class="green-text"><router-link :to="{ name:'login'}"><em>LOGIN</em></router-link></li>
                            <li><a href="#" v-if="isLoggedIn" @click="logOut">LOGOUT</a></li>
                            <li v-if="isLoggedIn">
                                <router-link :to="{ name: 'dashboard' }" v-if="user_type == 0"> Hi, {{firstname}}</router-link>
                                <router-link :to="{ name: 'admin' }" v-if="user_type == 1"> Hi, {{firstname}}</router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
                
            <ul class="sidenav" id="mobile-demo">
                <li><router-link :to="{ name:'home'}">HOME</router-link></li>
                <li><router-link :to="{name: 'about'}">ABOUT</router-link></li>
                <li><router-link :to="{ name:'library'}">LIBRARY</router-link></li>
                <li><router-link :to="{ name:'article'}">ARTICLES</router-link></li>
                <li><router-link :to="{name: 'contact'}">CONTACT</router-link></li>
                <li v-if='!isLoggedIn' class="blue-text text-lighten-4"><router-link :to="{ name:'login'}"><em>LOGIN</em></router-link></li>
                <li><a href="#" v-if="isLoggedIn" @click="logOut">LOGOUT</a></li>
                <li v-if="isLoggedIn">
                    <router-link :to="{ name: 'dashboard' }" v-if="user_type == 0"> Hi, {{firstname}}</router-link>
                    <router-link :to="{ name: 'admin' }" v-if="user_type == 1"> Hi, {{firstname}}</router-link>

                </li>
                <li><a href="#" v-if="isLoggedIn" @click="logOut">LOGOUT</a></li>
            </ul>
        </header>
        <main>
            <router-view @loggedIn="change"></router-view>
            
            <Footer></Footer>
        </main>
    </div>
</template>
<style scoped>
    nav .brand-logo {
        padding-left: 100px;
    }
    nav ul a:hover {
        background-color: black;
    }
    .pr-6 {
        padding-right: 50px;
    }
</style>
<script>
import Footer from './FooterComponent'
    export default {
        components: {
            Footer
        },
        data () {
            return {
                firstname: null,
                user_type: 0,
                isLoggedIn: localStorage.getItem('manKind.jwt')
            }
        },
        mounted() {
            M.AutoInit()
            this.setDefaults()
        },
        methods: {
            setDefaults() {
                if (this.isLoggedIn) {
                    let user = JSON.parse(localStorage.getItem('manKind.user'))
                    this.firstname = user.firstname
                    this.user_type = user.is_admin
                }
            },
            change() {
                this.isLoggedIn = localStorage.getItem('manKind.jwt') != null
                this.setDefaults()
            },
            logOut(){
                localStorage.removeItem('manKind.jwt')
                localStorage.removeItem('manKind.user')
                this.change()
                this.$router.push('/')
            }
        },
        created () {
            M.AutoInit()
        },
        computed: {
            
        },
        
    };
</script>
