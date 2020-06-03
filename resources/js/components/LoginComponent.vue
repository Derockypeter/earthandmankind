<template>
    <div class="container">
        <div class="articles">
            <div class="main-container">
                <div class="section"></div>
                <main>
                    <center>
                    
                    <h5 class="grey-text">Please, Login into your account</h5>
                    <div class="section"></div>

                    <div class="container">
                        <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">
                        <div class="alert" v-if="message">{{message}}</div>
                        <form class="col s12" @submit="loginUser">
                            <div class='row'>
                                <div class='col s12'>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='input-field col s12'>
                                    <input class='validate' v-model="user.email" type='email' name='email' id='email' required />
                                    <label for='email'>Enter your email</label>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='input-field col s12'>
                                    <input class='validate' v-model="user.password" type='password' name='password' id='password' required />
                                    <label for='password'>Enter your password</label>
                                </div>
                                <label style='float: right;'>
                                    <a class='pink-text' href='#!'><b>Forgot Password?</b></a>
                                </label>
                            </div>

                            <br />
                            <center>
                            <div class='row'>
                                <button type='submit' :disabled="saving" name='btn_login' class='col s12 btn btn-large waves-effect indigo'>{{saving ? 'Login you in' : 'Login'}}</button>
                            </div>
                            </center>
                        </form>
                        </div>
                    </div>
                    <h6>Or</h6>
                    <router-link :to="{name: 'register'}">Create account</router-link>
                    </center>

                    <div class="section"></div>
                    <div class="section"></div>
                </main>

            </div>
        </div>
    </div>
</template>
<style scoped>
  
</style>
<script>
import axios from 'axios'
export default {
    data() {
        return {
            saving: false,
            message: false,
            user: {
                email: '',
                password: ''
            }
        }
    },
    methods: {
        loginUser(evt){
            evt.preventDefault()
            if (this.user.password.length >= 6 ) {
                let email = this.user.email
                let password = this.user.password
                this.saving = true
                axios.post('api/login', {email, password})
                .then(response => {
                    console.log(response)
                    if(response.data === ""){
                        this.message = 'Invalid Credentials'
                        this.saving = false
                    }
                    else{
                         let user = response.data.user
                        let is_admin = user.is_admin

                        localStorage.setItem('manKind.user', JSON.stringify(user))
                        localStorage.setItem('manKind.jwt', response.data.token)

                        if (localStorage.getItem('manKind.jwt') != null) {
                            this.$emit('loggedIn')
                            if (this.$route.params.nextUrl != null) {
                                this.$router.replace(this.$route.params.nextUrl)
                            }
                            else {
                                this.$router.push((is_admin == 1 ? 'admin' : 'dashboard'))
                            }
                        } 
                    }
                   
                }).catch(error => {
                    this.message = error.response.data.message || 'Invalid details'
                    this.saving = false
                    console.log(error.response)
                })
            }
            else {
                this.message = "Enter a valid password"
            }
           
        }
    }
}
</script>