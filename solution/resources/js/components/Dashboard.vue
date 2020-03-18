<template>
    <h1>Laravel 7 – Our Cool Dashboard</h1>
</template>

<script>
    import axios from 'axios';

    export default {
        data(){
            return {
                users: []
            }
        },
        created() {
            const { users } = axios.get('/users');
            const { user } = axios.get('/users/1');
            const { apartments } = axios.get('/apartments');
            const { apartment } = axios.get('/apartments/1');
            console.log(users);
            console.log(user);
            console.log(apartments);
            console.log(apartment);
        },
        methods: {

        }
    }
</script>
