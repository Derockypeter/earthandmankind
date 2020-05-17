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
                        <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">
                        <div class="alert" v-if="message">{{message}}</div>
                        <div class="row">
                            <form class="col s12" @submit="registerUser">
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input placeholder="Firstname" v-model="user.firstname" id="firstName" type="text" class="validate">
                                        
                                    </div>
                                    <div class="input-field col s6">
                                        <input id="lastName" placeholder="Lastname" v-model="user.lastname"  type="text" class="validate">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s4">
                                        <input placeholder="Email" v-model="user.email" id="email" type="email" class="validate">
                                    </div>
                                    <div class="input-field col s4">
                                        <input placeholder="Birthdate" v-model="user.dob" id="DOB" type="text" class="datepicker validate">
                                    </div>
                                    <div class="col s4">
                                        <p>
                                            <label>
                                                <input name="female" value="F" v-model="user.gender" type="radio" class="with-gap" />
                                                <span>Female</span>
                                            </label>
                                        </p>
                                        <p>
                                            <label>
                                                <input name="male" value="M" v-model="user.gender" type="radio" class="with-gap" />
                                                <span>Male</span>
                                            </label>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input placeholder="Country" v-model="user.country" id="country" type="text" class="validate">
                                    </div>
                                    <div class="input-field col s6">
                                        <input placeholder="State" v-model="user.state" id="state" type="text" class="validate">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input placeholder="City" v-model="user.city" id="city" type="text" class="validate">
                                    </div>
                                    <div class="input-field col s6">
                                        <input placeholder="phone" v-model="user.phone" id="phone" type="tel" class="validate">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input placeholder="Password" v-model="user.password" id="password" type="password" class="validate">
                                    </div>
                                    <div class="input-field col s6">
                                        <input placeholder="Confirm Password" v-model="user.password_confirmation" id="password_confirmation" type="password" class="validate">
                                    </div>
                                </div>
                                <div class="col">
                                    <br />
                                </div>
                                <center>
                                    <div class='row'>
                                        <button type='submit' name='btn_register' class='col s12 btn btn-large waves-effect indigo'>Register</button>
                                    </div>
                                </center>
                            </form>
                        </div>
                        
                            
                       
                        </div>
                    </div>
                    <h6>Or</h6>
                    <router-link :to="{name: 'login'}">Login</router-link>
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
            }
        }
    },
    created() {
        M.AutoInit()
    },
    mounted() {
        M.AutoInit()
    },
    methods: {
        registerUser(evt){
            evt.preventDefault()
                // console.log(this.user)
            let uri = 'http://127.0.0.1:8000/api/register';
            this.axios.post(uri, this.user)
                .then((response) => {
                    console.log(response.data.data)
                    this.$router.push({name: 'home'});
                })
                .catch(err => {
                    if(err.response){
                        this.message = err.response.data.errors || 'Invalid';
                        console.log(err.response.data.errors)
                    }
                    // else if(err.request){
                    //     this.message = err.request || 'Invalid';

                    // }
                });
            
           
        }
    }
}
</script>