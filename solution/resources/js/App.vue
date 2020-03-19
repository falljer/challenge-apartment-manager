<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <ul class="navbar-nav">
                <li class="nav-item" v-if="!$auth.check()">
                    <router-link class="nav-link navbar-brand" :to="{ name: 'home' }" active-class="active">Home</router-link>
                </li>
                <li class="nav-item" v-if="$auth.check()">
                    <router-link class="nav-link navbar-brand" :to="{ name: 'dashboard' }" active-class="active">Dashboard</router-link>
                </li>
            </ul>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item" v-if="$auth.check()">
                        <router-link class="nav-link" :to="{ name: 'apartments' }" active-class="active">Apartment Search</router-link>
                    </li>
                    <li class="nav-item" v-if="$auth.check('admin')">
                        <router-link class="nav-link" :to="{ name: 'users' }" active-class="active">User Management</router-link>
                    </li>
                </ul>
            </div>

            <div class="navbar-text">
                <a v-if="$auth.check()" class="btn btn-link" href="#" @click.prevent="$auth.logout()" active-class="active">Logout</a>
                <router-link v-if="!$auth.check()" class="btn btn-link" :to="{ name: 'login' }" active-class="active">Login</router-link>
                <router-link v-if="!$auth.check()" class="btn btn-link" :to="{ name: 'register' }" active-class="active">Register</router-link>
            </div>
        </nav>
        <div class="container" style="margin-top: 20px; margin-bottom: 50px;">
            <router-view></router-view>
        </div>
        <nav class="navbar navbar-dark bg-dark fixed-bottom">
            <div class="navbar-text">Apartment Manager created by Jeremy J Fall on 3/16/2020 - 3/19/2020</div>
        </nav>
    </div>
</template>
