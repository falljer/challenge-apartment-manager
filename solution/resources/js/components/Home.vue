<template>
    <div>
        <h1>Apartment Search</h1>
        <p>You can search apartments, but you must login or register first.</p>
        <router-link class="btn btn-primary" :to="{'name': 'register'}">Register</router-link>
        <router-link class="btn btn-secondary" :to="{'name': 'login'}">Login</router-link>
    </div>
</template>
