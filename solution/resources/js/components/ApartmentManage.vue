<template>
    <div>
        <router-link :to="{name: 'apartments'}">Back to Search</router-link>
        <h1>Apartment Detail</h1>
        <form autocomplete="off" @submit.prevent="save" v-if="!success" method="post">
            <div class="card">
                <h3 class="card-header">Add/Edit Apartment</h3>
                <div class="card-body">
                    <div class="alert alert-success" v-if="success">
                        <span>Apartment Saved!</span>
                    </div>
                    <div class="row" v-if="apartment.id">
                        <div class="col">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" class="form-control" v-model="apartment.name" required />
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" class="form-control" v-model="apartment.description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea id="address" class="form-control" v-model="apartment.address"></textarea>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="area">Floor Area Size</label>
                                <input type="text" id="area" class="form-control" v-model="apartment.floor_area_size" required />
                            </div>
                            <div class="form-group">
                                <label for="price">Price per Month</label>
                                <input type="text" id="price" class="form-control" v-model="apartment.price_per_month" required />
                            </div>
                            <div class="form-group">
                                <label for="rooms">Number of Rooms</label>
                                <input type="text" id="rooms" class="form-control" v-model="apartment.number_of_rooms" required />
                            </div>
                            <div class="form-group">
                                <label for="realtor">Realtor</label>
                                <select id="realtor" class="form-control" v-bind="apartment.realtor_id">
                                    <option v-for="realtor in apartment.realtors" :value="realtor.id">{{ realtor.name }}</option>
                                </select>
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
    import {Apartment} from '@models/Apartment';

    export default {
        data() {
            return {
                apartment: new Apartment(),
                success: false
            }
        },
        created() {
            // Load Apartment
            if(this.$route.query.id) {
                this.apartment.id = this.$route.query.id;
                this.apartment.fetch();
            }
        },
        methods: {
            save() {
                this.apartment.save()
                    .success(() => {
                        this.success = true;
                    });
            }
        }
    }
</script>
