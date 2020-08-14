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
                        <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 18px 0px 18px; border: 1px solid #EEE;">
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
                                        <a class='pink-text waves-effect waves-light modal-trigger' href='#modal1!' ><b>Forgot Password?</b></a>
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
                        <h6>Or</h6>
                        <div class="center">
                            <!-- <a class="waves-effect waves-light btn dodgerblue col s12 btn-large" href="/login/facebook">Login With Facebook</a> -->
                            <a class="waves-effect waves-light btn btn-large loginBtn loginBtn--facebook"  href="api/login/facebook">
                                Login with Facebook
                            </a>
                            <!-- <router-link :to="{name: 'register'}" class="ml3">Create account</router-link> -->
                        </div>
                    </div>
                    
                    </center>

                    <div class="section"></div>
                    <div class="section"></div>
                </main>

            </div>
        </div>

        <!-- Modal Structure -->
        <div id="modal1!" class="modal">
            <div v-if="error" class="center">
                <span  style="background-color: #eb7077; color: #ffff">{{error}}</span>
            </div>
            <div v-if="success" class="center">
                <span  style="background-color: #42b983; color: #ffff">{{success}}</span>
            </div>
            <div class="modal-content">
            <h4>Enter Your Email</h4>
            <i class="material-icons right modal-close">close</i>
            <p>We'll send you an email with a link to reset your password</p>
            <form >
                <div class="input-field col s12">
                    <input type="email" required name="email" v-model="send.email" placeholder="janedoe@email.com">
                </div>
            </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="waves-effect waves-green btn-flat" @click="sendToken">Send Password Reset Link</button>
            </div>
        </div>
    </div>
</template>
<style scoped>
    .modal h4 {
        display: inline-block;
    }
    .modal .material-icons:hover {
        cursor: pointer;
    }
    .dodgerblue {
        background-color: #2d88ff;
    }
    .ml3 {
        margin-left: 50px;
    }
    .loginBtn {
        background-color: #2d88ff;
        margin: 0.2em;
        padding: 0 15px 0 46px;
        border: none;
        text-align: left;
        border-radius: 0.2em;
        font-size: 16px;
    }
    .loginBtn:before {
        content: "";
        box-sizing: border-box;
        position: absolute;
        top: 0;
        left: 0;
        width: 45px;
        height: 100%;
    }
    .loginBtn:focus {
        outline: none;
    }
    .loginBtn:active {
        box-shadow: inset 0 0 0 32px rgba(0,0,0,0.1);
    }
    /* Facebook */
    .loginBtn--facebook {
        background-color: #2d88ff;
        text-shadow: 0 -1px 0 #2d88ff;
    }
    .loginBtn--facebook:before {
        border-right: #2d88ff 1px solid;
        background-color: #2d88ff;
        background: url('/images/icons/icons8-facebook.svg') no-repeat;
    }
    .loginBtn--facebook:hover,
    .loginBtn--facebook:focus {
        background-color: #2d88ff;
        background-image: linear-gradient(#2d88ff, #0e448b);
    }

</style>
<script>
    import axios from 'axios'
    export default {
        data() {
            return {
                error: false,
                success: false,
                send: {
                    email: ""
                },
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
                if (this.user.password.length >= 8 ) {
                    let email = this.user.email
                    let password = this.user.password
                    this.saving = true
                    axios.post('api/login', {email, password})
                    .then(response => {
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
                        this.message = error.response.data.message || 'Invalid Email or Password'
                        this.saving = false
                    })
                }
                else {
                    this.message = "Enter a valid password:Minimum of 8"
                }
            },

            sendToken(evt){
                evt.preventDefault()

                let uri = "/api/password/create"
                this.axios.post(uri, this.send)
                .then((response) => {
                    setTimeout(() => {
                        this.success = response.data.message || 'Invalid Email'
                        if (this.success) {
                        this.send.email = ""
                        }
                    }, 1000)
                })
                .catch(error => {
                    this.error = error.response.data.message
                    setTimeout(() => {
                        this.error = ""
                    }, 5000)
                })
            },
            // For facebook login
            loginToFacebook()
            {
                axios.get('api/login/facebook',
                   {
                    mode: 'no-cors',
                    headers: {
                        'Accept': "application/json",
                        'Access-Control-Allow-Origin': '*',
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'Access-Control-Allow-Credentials': "true",
                        'X-Requested-With': "XMLHttpRequest"
                    },
                    withCredentials: true,
                    })
                .then( response => {
                    // console.log(response);
                })
                .catch(error => {
                    // console.log(error)
                })
            }
        }
    }
</script>