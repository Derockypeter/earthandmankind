<template>
    <div>
        <div>{{firstname}}</div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            user: [],
            isLoggedIn: localStorage.getItem('manKind.user'),
        }
    },
    created() {
        this.axios.get(`api/user/${this.$route.params.id}`)
        .then( response => {
            console.log(response)
        })
        this.firstname = localStorage.getItem('manKind.user.firstname')
    },
}
</script>