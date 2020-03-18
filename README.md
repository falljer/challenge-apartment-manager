# Toptal Screening Process: Test Project
### The requirements for the test project are:
Write an application that manages apartment rentals

* Users must be able to create an account and log in. (If a mobile application, this means that multiple users can use the app from the same phone).
* Implement a client role:
   * Clients are able to browse rentable apartments in a list and on a map.
* Implement a realtor role:
   * Realtors would be able to browse all rentable- and already rented apartments in a list and on a map.
   * Realtors would be able to CRUD all apartments and set the apartment state to available/rented.
* Implement an admin role:
   * Admins would be able CRUD all apartments, realtors, and clients.
* When an apartment is added, each new entry must have a name, description, floor area size, price per month, number of rooms, valid geolocation coordinates, date added and an associated realtor.
* Geolocation coordinates should be added either by providing latitude/longitude directly or through address geocoding (https://developers.google.com/maps/documentation/javascript/geocoding).
* All users should be able to filter the displayed apartments by size, price, and the number of rooms.
* REST API. Make it possible to perform all user actions via the API, including authentication (If a mobile application and you don’t know how to create your own backend you can use Firebase.com or similar services to create the API).
* In both cases, you should be able to explain how a REST API works and demonstrate that by creating functional tests that use the REST Layer directly. Please be prepared to use REST clients like Postman, cURL, etc. for this purpose.
* If it’s a web application, it must be a single-page application. All actions need to be done client side using AJAX, refreshing the page is not acceptable. (If a mobile application, disregard this).
* Functional UI/UX design is needed. You are not required to create a unique design, however, do follow best practices to make the project as functional as possible.
* Bonus: unit and e2e tests.

## Instructions for testing

The solution folder contains the complete full-stack web application.  The Laravel Migrations and Data Seeds will setup the initial database.

This solution was developed using a MySQL database, but because Laravel's ORM is abstracted, it should in theory work with any database driver included/available for Laravel.

### Install libraries and dependencies

After clone of this repository, download the additional front-end and back-end requirements by using these commands:

```bash
composer install
npm install
php artisan jwt:generate
```

### Setup the database
(Note: this assumes you already have MySQL installed and running on localhost)

1\. Open your MySQL console, then create a new database:
 
 `CREATE DATABASE rental_management;`

2\. Create a user for this application:

 `CREATE USER 'rental_management'@'localhost' IDENTIFIED BY 'my-strong-password-here';`
 
3\. Grant this user `rental_management` the permission to access the `rental_management` database:

 `GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, INDEX, DROP, ALTER, CREATE TEMPORARY TABLES, LOCK TABLES ON rental_management.* TO 'rental_management'@'localhost';`
 
4\. Flush privilege

 `FLUSH PRIVILEGES;`
 
5\. Copy `.env.example` to `.env` and update with the database name, username, and password created in the previous steps:

 ```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rental_management
DB_USERNAME=rental_management
DB_PASSWORD=my-strong-password-here
```

6\. Populate the database:

(Run the remaining commands from the solution folder in this repository)

```bash
php artisan migrate
php artisan db:seed
```

### Run Automated Tests

To ensure your environment is setup properly, you can run all available tests with:

`run_tests.sh`

### Start application via the `serve` command

Obviously, if this were in production best practice is to use Apache or Nginx (or another enterprise-grade web server).  Locally, the easiest way to start the app for testing is with:

`php artisan serve`

By default the HTTP-server will listen on port 8000.  If you wish to use another port, you can specify it on the command-line like so:

`php artisan serve --port=8080`

Replace 8080 with the desired port.  On unix-like systems, you normally cannot serve on a port below 1024 unless you are running the command with root privileges.

Now, you can open a browser and navigate to `http://localhost:8000` (or whatever port you are serving on).

### Test Users Added by Database Seeding

| Username                | Password     | Role    |
| ----------------------- | ------------ | ------- |
| admin@test.com          | iamadmin     | Admin   |
| johnnyc@test.com        | someclient   | Client  |
| janetherealtor@test.com | superrealtor | Realtor |

Of course, new clients can be created using the registration page (linked from the login page).  And, additional users can be created via the Admin panel, and the CLI interface.

## CLI Documentation

#### Create a new user

Creates a new user in the database.

`php artisan user:create`

#### Update a user

Updates a user's information.

`php artisan user:update`

#### Suspend a user

Disable the user's login temporarily.

`php artisan user:suspend {user_id}`

#### Unsuspend a user

Re-enable a suspended user.

`php artisan user:unsuspend {user_id}`

#### Remove a user

Permanently remove a user from the system.

`php artisan user:remove`

#### Create a new apartment

Creates a new apartment in the database.

`php artisan apartment:create`

#### Update an apartment

Updates an apartment.

`php artisan apartment:update`

#### Remove an apartment

Permanently removes an apartment from the system.

`php artisan apartment:remove`

## API Documentation

* A * next to a paramater type means required example: `[string*]` (no * means it is optional `[integer]`).
* <> around a parameter type means the API is expecting an array of values.  Example `[< integer >]`.

### Users API

Manages users and roles in the system.

#### Create User

* URL: POST /api/users
* URL Params: (none)
* Data Params:
    * name=[string*]
    * email=[string*]
    * password=[string*]
    * roles=[< integer, integer, ... >]
    
* Success Response:

```json
{
    status: "success",
    data: {
        "id": 1,
        "name": "Admin",
        "email": "admin@test.com",
        "roles": ["admin"],
        "created_at": "2020-03-18T12:32:29.000000Z",
        "updated_at": "2020-03-18T12:32:29.000000Z"
    }
}
```

* Error Response:

```json
{
    "status": "error",
    "message": "Error Message"
}
```

#### Update User

* URL: PUT/PATCH /api/users/{user_id}
* URL Params: (none)
* Data Params:
    * name=[string*]
    * email=[string*]
    * password=[string*]
    * roles=[< integer, integer, ... >]
    
* Success Response:

```json
{
    status: "success",
    data: {
        "id": 1,
        "name": "Admin",
        "email": "admin@test.com",
        "roles": ["admin"],
        "created_at": "2020-03-18T12:32:29.000000Z",
        "updated_at": "2020-03-18T12:32:29.000000Z"
    }
}
```

* Error Response:

```json
{
    "status": "error",
    "message": "Error Message"
}
```

#### Remove User

* URL: DELETE /api/users/{user_id}
* URL Params: (none)
* Data Params: (none)
    
* Success Response:

```json
(No content, returns "204 No Content" HTTP status)
```

* Error Response:

```json
{
    "status": "error",
    "message": "Error Message"
}
```

#### Search Users

* URL: GET /api/users
* URL Params:
    * name=[string]
    * email=[string]
    * roles=[< integer, integer, ...>]
    * q=[string]
* Data Params: (none)

* Success Response:

```json
{
    "status": "success",
    "data": [
        {
            "id": 1,
            "name": "Admin",
            "email": "admin@test.com",
            "roles": ["admin"],
            "created_at": "2020-03-18T12:32:29.000000Z",
            "updated_at": "2020-03-18T12:32:29.000000Z"
        },
        {
            "id": 2,
            "name": "Johnny Client",
            "email": "johnnyc@test.com",
            "roles": ["client"],
            "created_at": "2020-03-18T12:32:29.000000Z",
            "updated_at": "2020-03-18T12:32:29.000000Z"
        }
    ]
}
```


### Apartments API

Manages apartments in the system.

#### Create Apartment

* URL: POST /api/apartments
* URL Params: (none)
* Data Params:
    * name=[string*]
    * description=[string]
    * floor_area_size=[integer]
    * price_per_month=[integer]
    * number_of_rooms=[integer]
    * latitude=[double]
    * longitude=[double]
    * realtor_id=[integer]
    
* Success Response:

```json
{
    status: "success",
    data: {
        "id": 1,
        "name": "Beautiful Ranch-Style 2 Bedroom",
        "description": "Ranch style single family home",
        "floor_area_size": "1500",
        "price_per_month": "2100",
        "number_of_rooms": 2,
        "latitude": 0,
        "longitude": 0,
        "realtor": {
            "id": 3, 
            "name": "Jane Realtor", 
            "email": "janetherealtor@test.com", 
            "roles": ["realtor"]
        },
        "created_at": "2020-03-18T09:39:15.000000Z",
        "updated_at": "2020-03-18T09:39:15.000000Z"
    }
}
```

* Error Response:

```json
{
    "status": "error",
    "message": "Error Message"
}
```

#### Update Apartment

* URL: PUT/PATCH /api/apartments/{apartment_id}
* URL Params: (none)
* Data Params:
    * name=[string*]
    * description=[string]
    * floor_area_size=[integer]
    * price_per_month=[integer]
    * number_of_rooms=[integer]
    * latitude=[double]
    * longitude=[double]
    * realtor_id=[integer]
    
* Success Response:

```json
{
    status: "success",
    data: {
        "id": 1,
        "name": "Beautiful Ranch-Style 2 Bedroom",
        "description": "Ranch style single family home",
        "floor_area_size": "1500",
        "price_per_month": "2100",
        "number_of_rooms": 2,
        "latitude": 0,
        "longitude": 0,
        "realtor": {
            "id": 3, 
            "name": "Jane Realtor", 
            "email": "janetherealtor@test.com", 
            "roles": ["realtor"]
        },
        "created_at": "2020-03-18T09:39:15.000000Z",
        "updated_at": "2020-03-18T09:39:15.000000Z"
    }
}
```

* Error Response:

```json
{
    "status": "error",
    "message": "Error Message"
}
```

#### Remove Apartment

* URL: DELETE /api/apartments/{apartment_id}
* URL Params: (none)
* Data Params: (none)
    
* Success Response:

```json
(No content, returns "204 No Content" HTTP status)
```

* Error Response:

```json
{
    "status": "error",
    "message": "Error Message"
}
```

#### Search Apartments

* URL: GET /api/apartments
* URL Params:
    * name=[string*]
    * description=[string]
    * floor_area_size=[integer]
    * price_per_month=[integer]
    * number_of_rooms=[integer]
    * latitude=[double]
    * longitude=[double]
    * realtor_id=[integer]
    * q=[string]
* Data Params: (none)

* Success Response:

```json
{
    "status": "success",
    "data": [
        {
            "id": 1,
            "name": "Beautiful Ranch-Style 2 Bedroom",
            "description": "Ranch style single family home",
            "floor_area_size": "1500",
            "price_per_month": "2100",
            "number_of_rooms": 2,
            "latitude": 0,
            "longitude": 0,
            "realtor": {
                "id": 3, 
                "name": "Jane Realtor", 
                "email": "janetherealtor@test.com", 
                "roles": ["realtor"]
            },
            "created_at": "2020-03-18T09:39:15.000000Z",
            "updated_at": "2020-03-18T09:39:15.000000Z"
        },
        {
            "id": 2,
            "name": "3 Bedroom",
            "description": "Ranch style single family home",
            "floor_area_size": "1900",
            "price_per_month": "2700",
            "number_of_rooms": 3,
            "latitude": 0,
            "longitude": 0,
            "realtor": {
                "id": 3, 
                "name": "Jane Realtor", 
                "email": "janetherealtor@test.com", 
                "roles": ["realtor"]
            },
            "created_at": "2020-03-18T09:39:15.000000Z",
            "updated_at": "2020-03-18T09:39:15.000000Z"
        }
    ]
}
```