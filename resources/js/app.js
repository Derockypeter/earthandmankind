/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
// import 'materialize-css/dist/js/materialize.min'
// import M from 'materialize-css/dist/css/materialize.min.css'
// import 'materialize-css/dist/fonts/material-icons.css'
// import axios from 'axios'

// Vue.use(axios)
// Vue.component('home-component', require('./components/HomeComponent.vue').default);
// Vue.component('article-component', require('./components/BlogComponent.vue').default);
// Vue.component('library-component', require('./components/LibraryComponent.vue').default);
// Vue.component('postbody-component', require('./components/PostBodyComponent.vue').default);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
