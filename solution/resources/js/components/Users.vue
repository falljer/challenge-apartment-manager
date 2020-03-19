<template>
    <div>
        <router-link :to="{name: 'dashboard'}">Back to Dashboard</router-link>
        <h1>Users</h1>
        <table v-if="users.first()" class="table table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Created</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users.each()">
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td><span v-for="role in user.roles">{{ role }} </span></td>
                    <td>{{ user.created_at }}</td>
                    <td>
                        <router-link class="btn btn-primary" :to="{ path: 'user', query: { id: user.id }}">Edit</router-link>
                        <router-link class="btn btn-danger" :to="{ path: 'user', query: { id: user.id }}">Delete</router-link>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import {User, UserCollection} from '@models/User';

    export default {
        data() {
            return {
                users: new UserCollection()
            };
        },
        created() {
            this.users.fetch();
        }
    }
</script>
