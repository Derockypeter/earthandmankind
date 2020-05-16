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

                        <form class="col s12" @submit="loginUser">
                            <div class='row'>
                                <div class='col s12'>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='input-field col s12'>
                                    <input class='validate' v-model="user.email" type='email' name='email' id='email' />
                                    <label for='email'>Enter your email</label>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='input-field col s12'>
                                    <input class='validate' v-model="user.password" type='password' name='password' id='password' />
                                    <label for='password'>Enter your password</label>
                                </div>
                                <label style='float: right;'>
                                    <a class='pink-text' href='#!'><b>Forgot Password?</b></a>
                                </label>
                            </div>

                            <br />
                            <center>
                            <div class='row'>
                                <button type='submit' name='btn_login' class='col s12 btn btn-large waves-effect indigo'>Login</button>
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
export default {
    data() {
        return {
            user: {
                email: '',
                password: ''
            }
        }
    },
    methods: {
        loginUser(evt){
            evt.preventDefault()
            let uri = 'http://127.0.0.1:8000/api/login';
            this.axios.post(uri, this.user).then((response) => {
            	this.$router.push({name: 'home'});
            })
            .catch(error => {
                console.log(error)
            })
        }
    }
}
</script>