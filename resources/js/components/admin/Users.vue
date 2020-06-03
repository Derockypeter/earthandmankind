<template>
    <div>
        <table class="striped highlight responsive-table">
            <thead>
                <tr>
                    <td></td>
                    <td>Name</td>
                    <td>Email</td>
                    <td>Joined</td>
                    <td>Subscribed</td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(user,index) in users" :key="index">
                    <td>{{index+1}}</td>
                    <td>{{user.firstname +' ' + user.lastname}}</td>
                    <td>{{user.email}}</td>
                    <td>{{(user.created_at).substr(0, 10)}}</td>
                    
                    <td>{{user.premium}}</td>
                    <!-- <td v-else-if="user.premium.status != null">{{user.premium.status}}</td> -->

                </tr>
            </tbody>
        </table>
    </div>
</template>

    <script>
    export default {
        data() {
            return {
                users : []
            }
        },
        beforeMount() {
            this.axios.get('/api/users/').then(response => {this.users = response.data
            console.log(response.data)}) 
        },
        computed: {
          removeTime(){

          }  
        },
    }
    </script>