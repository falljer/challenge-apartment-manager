import {Model, Collection} from 'vue-mc';

class User extends Model {
    defaults() {
        return {
            id: null,
            name: '',
            email: '',
            roles: null,
            created_at: '',
            updated_at: ''
        }
    }

    routes() {
        return {
            fetch: '/users/{id}',
            save: '/users'
        }
    }
}

class UserCollection extends Collection {
    model() {
        return User;
    }

    defaults() {
        return {
            orderBy: 'name',
            queryString: ''
        }
    }

    routes() {
        return {
            fetch: '/users?{queryString}'
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

export { User, UserCollection }
