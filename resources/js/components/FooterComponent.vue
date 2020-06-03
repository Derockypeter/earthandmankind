<template>
    <footer class="page-footer darken-4 container">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="grey-text text-darken-3">We are glad you are here: </h5>
                    <p class="grey-text text-darken-4">We hope you find Our contents to be exciting, contact us for support</p>
                </div>
                <div class="col l4 offset-l2 s12">
                    <h5 class="grey-text">Explore Again</h5>
                    <ul style="text-decoration: underline">
                        <li><router-link :to="{name: 'bible-teachings'}" class="blue-text text-darken-3">Bible Teachings</router-link></li>
                        <li><router-link :to="{name: 'library'}" class="blue-text text-darken-3">Videos</router-link></li>
                        <li><router-link :to="{name: 'blog'}" class="blue-text text-darken-3">Blog</router-link></li>
                        <li><router-link :to="{name: 'about'}" class="blue-text text-darken-3">About Us</router-link></li>
                        <li><router-link :to="{name: 'contact'}" class="blue-text text-darken-3">Contact Us</router-link></li>
                        <li><router-link :to="{ name:'login'}" class="blue-text text-darken-3">Login</router-link></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright grey darken-4">
            <div class="container">
                <center>
                    <small>Copyright © {{ new Date().getFullYear() }} MK.ORG</small>
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