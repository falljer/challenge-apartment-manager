<template>
    <div>
        <router-link :to="{name: 'apartments'}">Back to Search</router-link>
        <h1>Apartment Detail</h1>
        <div class="card">
            <h3 class="card-header">{{ apartment.name }}</h3>
            <div class="card-body">
                <div class="row" v-if="apartment.id">
                    <div class="col">
                        <p>{{ apartment.description }}</p>
                    </div>
                    <div class="col">
                        <p>
                            Floor Area: {{ apartment.floor_area_size }}<br />
                            Monthly Price: {{ apartment.price_per_month }}<br />
                            Number of Rooms: {{ apartment.number_of_rooms }}
                        </p>
                        <p class="lead">For more information, contact {{ apartment.realtor.name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {Apartment} from '@models/Apartment';

    export default {
        data() {
            return {
                apartment: new Apartment()
            };
        },
        created() {
            let id = this.$route.query.id;
            this.apartment.id = id;
            this.apartment.fetch();
        }
    }
</script>
