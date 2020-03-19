<template>
    <div>
        <router-link :to="{name: 'dashboard'}">Back to Dashboard</router-link>
        <h1>Apartment Search</h1>
        <form autocomplete="off" @submit.prevent="search" method="get">
            <div class="card">
                <h3 class="card-header">Search Options</h3>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <label for="floor_area_min">Min Floor Area</label><br />
                            <input type="number" id="floor_area_min" name="floor_area_min" v-model="floor_area_min" /><br /><br />
                            <label for="floor_area_max">Max Floor Area</label><br />
                            <input type="number" id="floor_area_max" name="floor_area_max" v-model="floor_area_max" /><br /><br />
                            <label for="bedrooms">Bedrooms</label><br />
                            <input type="number" id="bedrooms" name="bedrooms" v-model="bedrooms" />
                        </div>
                        <div class="col">
                            <label for="price_min">Min Monthly Price</label><br />
                            <input type="number" id="price_min" name="price_min" v-model="price_min" /><br /><br />
                            <label for="price_max">Max Monthly Price</label><br />
                            <input type="number" id="price_max" name="price_max" v-model="price_max" /><br /><br />
                            <label for="realtor">Realtor</label><br />
                            <input type="text" id="realtor" name="realtor" v-model="realtor" />
                        </div>
                    </div>
                    <br />
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
        <br />
        <h3 v-if="apartments.first()">Search Results:</h3>
        <table v-if="apartments.first()" class="table table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Additional Info</th>
                    <th v-if="$auth.check('realtor')">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="apartment in apartments.each()">
                    <td>
                        <router-link :to="{ path: 'apartment', query: { id: apartment.id }}">{{ apartment.name }}</router-link>
                    </td>
                    <td>{{ apartment.description }}</td>
                    <td>
                        Floor Area: {{ apartment.floor_area_size }}<br />
                        Monthly Price: {{ apartment.price_per_month }}<br />
                        Rooms: {{ apartment.number_of_rooms }}
                    </td>
                    <td v-if="$auth.check('realtor')">
                        <router-link class="btn btn-secondary" :to="{ path: 'manage', query: { id: apartment.id }}">Edit</router-link>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import {Apartment, ApartmentCollection} from '@models/Apartment';

    export default {
        data() {
            return {
                apartments: new ApartmentCollection(),
                floor_area_min: '',
                floor_area_max: '',
                bedrooms: '',
                price_min: '',
                price_max: '',
                realtor: ''
            };
        },
        methods: {
            search() {
                this.apartments.search({
                    floor_area_min: this.floor_area_min,
                    floor_area_max: this.floor_area_max,
                    bedrooms: this.bedrooms,
                    price_min: this.price_min,
                    price_max: this.price_max,
                    realtor: this.realtor
                });
            }
        }
    }
</script>
