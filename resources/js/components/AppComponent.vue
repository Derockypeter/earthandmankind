<template>
    <div>
         <header>
            <nav style="background-color: #424242;">
                <div class="container">
                    <div class="nav-wrapper">
                        <a href="#!" class="brand-logo logo-pr-6">Logo</a>
                        <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                        <ul class="right hide-on-med-and-down pr-6">
                            <li><router-link :to="{ name:'home'}">HOME</router-link></li>
                            <li><router-link :to="{ name:'bible-teachings'}">BIBLE TEACHINGS</router-link></li>
                            <li><router-link :to="{ name:'library'}">LIBRARY</router-link></li>
                            <li><router-link :to="{ name:'blog'}">BLOG</router-link></li>
                            <li><router-link :to="{ name:'login'}"><em>Login</em></router-link></li>
                        </ul>
                    </div>
                </div>
            </nav>
                
            <ul class="sidenav" id="mobile-demo">
                <li><router-link :to="{ name:'home'}">HOME</router-link></li>
                <li><router-link :to="{ name:'bible-teachings'}">BIBLE TEACHINGS</router-link></li>
                <li><router-link :to="{ name:'library'}">LIBRARY</router-link></li>
                <li><router-link :to="{ name:'blog'}">BLOG</router-link></li>
                <li><router-link :to="{ name:'login'}"><em>Login</em></router-link></li>
            </ul>
        </header>
        <main>
            <router-view></router-view>
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
        padding-right: 250px;
    }
</style>
<script>
import Footer from './FooterComponent'
    export default {
        components: {
            Footer
        },
        created() {
            M.AutoInit()
        },
        mounted() {
            M.AutoInit()
        }
    };
</script>