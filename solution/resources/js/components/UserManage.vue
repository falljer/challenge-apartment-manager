<template>
    <div>
        <router-link :to="{name: 'users'}">Back to Users</router-link>
        <h1>Manage User</h1>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row" v-if="apartment.id">
                    <div class="col-xs-6">
                        <h2 style="margin-top:0">{{ apartment.name }}</h2>
                        <p>{{ apartment.description }}</p>
                    </div>
                    <div class="col-xs-6">
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
