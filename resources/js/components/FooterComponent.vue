<template>
    <footer class="page-footer darken-4">
        <div class="container">
            <div class="row container">
                <div class="col l6 s12">
                    <h5 class="grey-text text-darken-3">For Reactions: </h5>
                    <p class="grey-text text-darken-4"><b>Send us a mail:</b> <br> theearthandmankind@gmail.com, <br>infor@earthandmankind.org</p>
                    <p class="grey-text text-darken-4"><b>Social media:</b> <a class="mdi mdi-facebook"></a> <a class="mdi mdi-twitter"></a> <a class="mdi mdi-whatsapp"></a> </p>
                </div>
                <div class="col l4 offset-l2 s12">
                    <h5 class="grey-text">Explore Again</h5>
                    <ul style="text-decoration: underline">
                        <li><router-link :to="{name: 'dictionary'}" class="blue-text text-darken-3">Dictionary</router-link></li>
                        
                        <li><router-link :to="{name: 'article'}" class="blue-text text-darken-3">Articles</router-link></li>
                        <li><router-link :to="{name: 'library'}" class="blue-text text-darken-3">Videos</router-link></li>
                        
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright grey darken-4">
            <div class="container">
                <center>
                    <small>Copyright © {{ new Date().getFullYear() }} EARTHANDMANKIND</small>
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
    .page-footer {
        position: relative;
        top: 50px;
    }
</style>