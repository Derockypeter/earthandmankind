import Vue from 'vue'
import App from './components/AppComponent.vue'
import router from './router'
import store from './store'




import 'materialize-css/dist/js/materialize.min'
import 'materialize-css/dist/css/materialize.min.css'
import 'materialize-css/dist/fonts/material-icons.css'


new Vue({
  el: '#app',
  router,
  store,
  render: h => h(App)
})

// const app = new Vue({
//     el: '#app',
//     components: { App },
//     router,
//     store
// })