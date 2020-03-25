<template>
    <div>
        <router-link :to="{name: 'apartments'}">Back to Search</router-link>
        <h1>Apartment Detail</h1>
        <div class="card">
            <h3 class="card-header">{{ apartment.name }}</h3>
            <div class="card-body">
                <div class="row" v-if="apartment.id">
                    <div class="col">
                        <div id="gmap" style="width: 100%; height: 300px;"></div>
                    </div>
                    <div class="col">
                        <h6>Description</h6>
                        <p>{{ apartment.description }}</p>
                        <h6>More Information</h6>
                        <p>
                            Floor Area: {{ apartment.floor_area_size }}<br />
                            Monthly Price: {{ apartment.price_per_month }}<br />
                            Number of Rooms: {{ apartment.number_of_rooms }}
                        </p>
                        <p class="lead">For more information, please contact {{ apartment.realtor.name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {Apartment} from '@models/Apartment';
    import GMapInit from '@util/GMapsInit';

    export default {
        data() {
            return {
                apartment: new Apartment(),
                async fetchMap() {
                    try {
                        // Load Map
                        const google = await GMapInit();
                        const geocoder = new google.maps.Geocoder();
                        const map = new google.maps.Map(document.getElementById('gmap'));
                        const locations = [
                            {
                                position: {
                                    lat: this.apartment.latitude,
                                    lng: this.apartment.longitude
                                }
                            }
                        ];

                        geocoder.geocode({ address: this.apartment.latitude + ',' + this.apartment.longitude }, (results, status) => {
                            if(status !== 'OK' || !results[0])
                                throw new Error(status);

                            map.setCenter(results[0].geometry.location);
                            map.fitBounds(results[0].geometry.viewport);
                        });

                        locations.map(x => new google.maps.Marker({ ...x, map }));

                    } catch(error) {
                        console.error(error);
                    }
                }
            };
        },
        created() {
            // Load Apartment
            this.apartment.id = this.$route.query.id;
            this.apartment.fetch();
        },
        mounted() {
            // Bind map after model has loaded
            this.apartment.on('fetch', () => {
                this.fetchMap();
            });
        }
    }
</script>
