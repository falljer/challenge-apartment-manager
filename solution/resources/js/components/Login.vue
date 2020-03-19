<template>
    <div class="card">
        <h3 class="card-header">Login</h3>
        <div class="card-body">
            <div class="alert alert-danger" v-if="error">
                <span>There was an error, unable to sign in with those credentials.</span>
            </div>
            <form autocomplete="off" @submit.prevent="login" method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" class="form-control" v-model="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Sign in</button>
            </form>
        </div>
        <div class="card-footer">Or, if you need to register, <router-link :to="{name: 'register'}">you may do so here</router-link></div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                email: null,
                password: null,
                error: false
            }
        },
        methods: {
            login(){
                let app = this;
                this.$auth.login({
                    params: {
                        email: app.email,
                        password: app.password
                    },
                    success: function () {},
                    error: function () {
                        app.error = true;
                    },
                    rememberMe: true,
                    redirect: '/dashboard',
                    fetchUser: true
                });
            },
        }
    }
</script>
