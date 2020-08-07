<template>
    <div class="container articles">
       
        <div class="row main-container">
            <h1>Contact</h1>
            <div class="col l5 s12">
                <h5>Contact:</h5>
                <p class="grey-text text-darken-4">
                    <b>Email:</b> theearthandmankind@gmail.com,<br>
                    <b>Facebook:</b> earthandmankind,<br>
                    <b>Twitter:</b> @earthandmankind<br>
                </p>
            </div>
            <div v-if="success" class="col l12  s12 success">
                <p class="center">{{success}}</p>
            </div>
            <div v-else class="col l5  s12">
                <h5 class="grey-text">Send Us A Mail</h5>
                <div class="row">
                    <form class="col s12" :disabled="saving" @submit="sendMail">
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="email" v-model="mail.email" required name="email" placeholder="Your Email *" > 
                            </div>
                            <div class="input-field col s12">
                                <input type="text" v-model="mail.name" required name="name" placeholder="Your Name *" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="text" v-model="mail.subject" required  placeholder="Enter Subject" id="subject" class="validate" >
                            </div>
                            <div class="input-field col s12">
                                <textarea type="text" v-model="mail.message"  placeholder="Enter Message here *" id="message" class="validate materialize-textarea" style="width: 100%; height: 150px;" required></textarea>
                            </div>
                            <button type="submit" class="waves-effect waves-light btn-small" >Submit</button>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            success: false,
            saving: false,
            mail: {
                email: '',
                name: '',
                message: '',
                subject: ''
            }
            
        }
    },
    methods: {
        sendMail(evt){
            evt.preventDefault();
            this.saving = true
            this.axios.post('api/contact-us', this.mail)
            .then(response => {
                this.success = response.data[0]
                setTimeout(() => {
                    this.$router.go()
                }, 3000)
            })
            .catch(error => {
                console.log(error);
                this.saving = false
            })
        }
    },
}
</script>
<style scoped>
.articles{
        margin-top: 2vh;
        box-shadow: 13px 13px 20px grey;
    }
    h1 {
        margin: 1.5rem 0rem;
    }
 .success {
  background-color: #6abc6e;
  color: white;
}
</style>