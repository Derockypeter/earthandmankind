<template>
    <footer class="page-footer darken-4">
        <div class="container">
            <div class="row container">
                <div class="col l6 s12">
                    <h5 class="grey-text text-darken-3">CONTACT US </h5>
                    <p class="grey-text text-darken-4">Send us a mail</p>
                </div>
                <div class="col l4 offset-l2 s12">
                    <h5 class="grey-text">Explore Again</h5>
                    <ul style="text-decoration: underline">
                        <li><router-link :to="{name: 'library'}" class="blue-text text-darken-3">Videos</router-link></li>
                        <li><router-link :to="{name: 'article'}" class="blue-text text-darken-3">Articles</router-link></li>
                        <li><router-link :to="{name: 'about'}" class="blue-text text-darken-3">About Us</router-link></li>
                        <li><router-link :to="{name: 'contact'}" class="blue-text text-darken-3">Contact Us</router-link></li>
                        <li><router-link :to="{ name:'login'}" class="blue-text text-darken-3">Login</router-link></li>
                        <li><router-link :to="{name: 'dictionary'}" class="blue-text text-darken-3">Dictionary</router-link></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright grey darken-4">
            <div class="container">
                <center>
                    <small>Copyright © {{ new Date().getFullYear() }} EandMK.ORG</small>
                </center>
            </div>
        </div>
    </footer>
</template>
<style scoped>
    footer {
        background-color: #f0f0f0;
    }
    .page-footer .footer-copyright {
        min-height: 0px;
        padding: 2px 2px;
    }
</style>