// import Vue from 'vue'
// import Vuex from 'vuex'
// import axios from 'axios'
// import router from './router.js'

// Vue.use(Vuex)


// export default new Vuex.Store({
//   state: {
//     token: null,
//     id: null,
//     user: null
//   },
//   mutations: {
//     authUser (state, userData) {
//       state.token = userData.accessToken
//       state.id = userData.id
//     },
//     clearAuth (state) {
//       state.token = null
//       state.id = null
//     }
//   },
//   actions: {
//     signup ({commit}, authData) {
//       axios.post('http://127.0.0.1:8000/api/register', {
//             firstname: authData.firstname,
//             lastname: authData.lastname,
//             city: authData.city,
//             country: authData.country,
//             state: authData.state,
//             DOB: authData.dob,
//             phone: authData.phone,
//             gender: authData.gender,
//             email: authData.email,
//             password: authData.password,
//             password_confirmation: authData.password_confirmation,
//             returnSecureToken: true
//       })
//         .then(res => {
//           console.log(res)
//            localStorage.setItem('token', res.data.accessToken)
//             localStorage.setItem('id', res.data.user.id)
//           commit('authUser', {
//             token: res.data.accessToken,
//             id: res.data.user.id
//           })
        
//           router.replace("/")
//         })
//         .catch(error => {
//           console.error.res
//         }) 
//     },
//     login ({commit}, authData) {
//       axios.post('http://127.0.0.1:8000/api/login', {
//         email: authData.email,
//         password: authData.password,
//         returnSecureToken: true
//       })
//         .then(res => {
//             console.log(res)
//             if(res.data.message === 'Invalid credentials'){
//                 alert(res.data.message)
//             }
//             else {
//                 localStorage.setItem('token', res.data.accessToken)
//                 localStorage.setItem('id', res.data.user.id)
//                 commit('authUser', {
//                     token: res.data.accessToken,
//                     id: res.data.user.id
//                 })
//                 router.replace('/')
//             }
          
//         })
//         .catch(error => alert(error))
//     },
//     logout ({commit}) {
//       commit('clearAuth')
//       localStorage.removeItem('token')
//       localStorage.removeItem('id')
//         router.replace('/')
//     },
//     AutoLogin ({commit}) {
//       const token = localStorage.getItem('token')
//       if (!token) {
//         return
//       }
//       const id = localStorage.getItem('id')
//       commit('authUser', {
//         token: token,
//         id: id
//       })
//     }
//   },
//   getters: {
//     user (state) {
//       return state.user
//     },
//     ifAuthenticated (state) {
//       return state.token !== null
//     }
//   }
// })