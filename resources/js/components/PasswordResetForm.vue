<template>
    <div>
        <div class="container">
            <div class="articles">
                <div class="main-container">
                    <div class="section"></div>
                    <main>
                        <center>
                        
                            <h5 class="grey-text">Please, Enter your New Password</h5>
                            <div class="section"></div>

                            <div class="container">
                                <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">
                                <div class="success" v-if="success">{{success}}</div>
                                <div class="alert" v-if="message">{{message}}</div>
                                <div class="alert" v-if="error">
                                    <div v-for="error in error" :key="error.index">
                                        {{error}}
                                    </div>
                                </div>
                                <form class="col s12" @submit="resetPassword">
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
                                    </div>
                                    <div class='row'>
                                        <div class='input-field col s12'>
                                            <input class='validate' v-model="user.c_password" type='password' name='c_password' id='c_password' required />
                                            <label for='password'>Confirm password</label>
                                        </div>
                                        <label style='float: right;'>
                                            <router-link :to="{name: 'login'}" class="teal-text text-darken-4"><b>Login Instead</b></router-link>
                                        </label>
                                    </div>

                                    <br />
                                    <center>
                                    <div class='row'>
                                        <button type='submit' :disabled="saving" name='btn_resetPassword' class='col s12 btn btn-large waves-effect indigo'>{{saving ? 'Password changing' : 'Change Password'}}</button>
                                    </div>
                                    </center>
                                </form>
                                </div>
                            </div>
                        </center>

                        <div class="section"></div>
                        <div class="section"></div>
                    </main>

                </div>
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
                message: false,
                success: false,
                error: false,
                saving: false,
                token: null,
                user: {
                    email: "",
                    password: "",
                    c_password: ""
                }
            }
        },
        created() {
            let uri = `api/password/find/${this.$route.params.token}`
            this.axios.get(uri)
            .then(response => {
            })
            .catch(error => {
                console.log(error)
            })
        },
        methods: {
            resetPassword(evt)
            {
                evt.preventDefault();
                this.saving = true
                this.axios.post('/api/password/reset/', {
                    email: this.user.email,
                    token: this.$route.params.token,
                    password: this.user.password,
                    password_confirmation: this.user.c_password
                })
                .then(response => {
                    if(response.data.errors || response.data.message) {
                        this.error = response.data.errors
                        this.message = response.data.message
                        this.saving = false
                    }
                    else {
                        this.success = "Password changed succesfuly"
                        this.error = ""
                        this.$router.push('/login')
                    }
                }).catch (error => {
                    console.log(error)
                    this.error = error.message
                    this.saving = false
                })
            }
        },
    }
</script>