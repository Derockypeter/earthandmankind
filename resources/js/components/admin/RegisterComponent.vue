<template>
    <div class="container">
        <div class="articles">
            <div class="main-container">
                <div class="section"></div>
                <main>
                    <center>
                    
                        <h5 class="grey-text">Register</h5>
                        <div class="section"></div>

                        <div class="container">
                            <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 8px 0px 8px; border: 1px solid #EEE;">
                                <div class="alert" v-if="message">{{message}}</div>
                                <div class="row">
                                    <form class="col s12" @submit="registerUser">
                                        <div class="row">
                                            <div class="input-field col s12 l6">
                                                <input placeholder="Firstname" v-model="user.firstname" id="firstName" type="text" class="validate" required>
                                                
                                            </div>
                                            <div class="input-field col s12 l6">
                                                <input id="lastName" placeholder="Lastname" v-model="user.lastname"  type="text" class="validate" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s12 l6">
                                                <input placeholder="Email" v-model="user.email" id="email" type="email" class="validate" required>
                                            </div>
                                            <div class="col s12 l6">
                                                <p>Gender</p>
                                                <p class="col s12 l6">
                                                    <label>
                                                        <input name="female" value="F" v-model="user.gender" type="radio" class="with-gap" />
                                                        <span>Female</span>
                                                    </label>
                                                </p>
                                                <p class="col s12 l6">
                                                    <label>
                                                        <input name="male" value="M" v-model="user.gender" type="radio" class="with-gap" />
                                                        <span>Male</span>
                                                    </label>
                                                </p>
                                            </div>
                                            <!-- <div class="input-field col s12 l6">
                                                <input placeholder="Birthdate" ref="date" v-model="user.dob" id="DOB" type="text" class="datepicker validate">
                                            </div> -->
                                        </div>
                                        <!-- <div class="row">
                                           
                                        </div> -->
                                        <div class="row">
                                            <div class="input-field col s12 l6">
                                                <input placeholder="Country" v-model="user.country" id="country" type="text" class="validate" required>
                                            </div>
                                            <div class="input-field col s12 l6">
                                                <input placeholder="State" v-model="user.state" id="state" type="text" class="validate" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s12 l6">
                                                <input placeholder="City" v-model="user.city" id="city" type="text" class="validate" required>
                                            </div>
                                            <div class="input-field col s12 l6">
                                                <input placeholder="phone" v-model="user.phone" id="phone" type="tel" class="validate" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s12 l6">
                                                <input placeholder="Password" v-model="user.password" id="password" type="password" class="validate" required>
                                            </div>
                                            <div class="input-field col s12 l6">
                                                <input placeholder="Confirm Password" v-model="user.password_confirmation" id="password_confirmation" type="password" class="validate" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <br />
                                        </div>
                                        <center>
                                            <div class='row'>
                                                <button type='submit' :disabled="saving" name='btn_register' class='col s12 l6 btn btn-large waves-effect indigo center'>{{ saving ? 'Registering...' : 'Register' }}</button>
                                            </div>
                                        </center>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- <h6>Or</h6>
                        <router-link :to="{name: 'login'}">Login</router-link> -->
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
            message: false,
            saving: false,
            user: {
                firstname: '',
                lastname: '',
                dob: '',
                gender: '',
                phone: '',
                country: '',
                state: '',
                city: '',
                email: '',
                password: '',
                password_confirmation: ''
            },    
        }
    },
    methods: {
        registerUser(evt){
            evt.preventDefault()
            this.saving = true
            let uri = 'api/adminRegister'
            if (this.user.password !== this.user.password_confirmation || this.user.password <= 0){
                this.user.password = ""
                this.user.password_confirmation = ""
                this.saving = false
                return this.message = 'Passwords do not match'
            }
            this.axios.post(uri, this.user)
            .then((response) => {
                let data = response.data
                localStorage.setItem('manKind.user', JSON.stringify(data.user))
                localStorage.setItem('manKind.jwt', data.token)
                if (localStorage.getItem('manKind.jwt') != null) {
                    this.$emit('loggedIn')
                    let nextUrl = this.$route.params.nextUrl
                    this.$router.push((nextUrl != null ? nextUrl : '/admin'))
                }
            })
            .catch(err => {
                if(err.response){
                    this.saving = false
                    this.message = err.response.data.error || 'Invalid';
                    console.log(err.response.data)
                }
            })
        },
    },
    computed: {
        
    },
}
</script>