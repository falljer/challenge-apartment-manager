<template>
    <div>
        <router-link :to="{name: 'users'}">Back to Users</router-link>
        <h1>User Detail</h1>
        <form autocomplete="off" @submit.prevent="save" v-if="!success" method="post">
            <div class="card">
                <h3 class="card-header">Add/Edit User</h3>
                <div class="card-body">
                    <div class="alert alert-success" v-if="success">
                        <span>User Saved!</span>
                    </div>
                    <div class="row" v-if="user.id">
                        <div class="col">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" class="form-control" v-model="user.name" required />
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" class="form-control" v-model="user.email" required />
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" class="form-control" v-model="user.password" required />
                            </div>
                            <div class="form-group">
                                <label for="password2">Password (again)</label>
                                <input id="password2" class="form-control" v-model="user.password2" required />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import {User} from '@models/User';

    export default {
        data() {
            return {
                user: new User(),
                success: false
            }
        },
        created() {
            // Load User
            if(this.$route.query.id) {
                this.user.id = this.$route.query.id;
                this.user.fetch();
            }
        },
        methods: {
            save() {
                this.user.save()
                    .success(() => {
                        this.success = true;
                    });
            }
        }
    }
</script>
