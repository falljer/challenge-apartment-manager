import {Model, Collection} from 'vue-mc';

class Apartment extends Model {
    defaults() {
        return {
            id: null,
            name: '',
            description: '',
            floor_area_size: null,
            price_per_month: null,
            number_of_rooms: null,
            latitude: null,
            longitude: null,
            realtor: null,
            created_at: '',
            updated_at: ''
        }
    }

    routes() {
        return {
            fetch: '/apartments/{id}',
            save: '/apartments'
        }
    }
}

class ApartmentCollection extends Collection {
    model() {
        return Apartment;
    }

    defaults() {
        return {
            orderBy: 'name',
            queryString: ''
        }
    }

    routes() {
        return {
            fetch: '/apartments?{queryString}'
        }
    }

    search(params) {
        // Form query string
        let queryString = Object.keys(params).map(function(key) {
            return key + '=' + params[key]
        }).join('&');
        this.set('queryString', queryString);

        // Fetch results
        return this.fetch();
    }
}

export { Apartment, ApartmentCollection }
