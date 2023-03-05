<script>
    export default {
        props: ['id'],

        data: ({ id }) => ({
            userId: id,
            response: false,
            user: null
        }),

        created() {
            this.fetchData()
        },

        methods: {
            async fetchData() {
                const url = `http://localhost/users/${this.userId}`;
                const { data: user } = await (await fetch(url)).json();
                this.response = true;
                this.user = user;
            }
        }
    }
</script>

<template>
    <div v-if="!response">
        Pinging the api...
    </div>

    <section class="section" v-if="response">
        <div class="container">
            <div class="card">
                <div class="card-content">
                    <div class="media">
                        <div class="media-content">
                            <p class="title is-4">{{ user.name }}</p>
                            <p class="subtitle is-6">{{ user.email }}</p>
                        </div>
                    </div>
                    <div class="content" v-if="!user.weather">
                        <div class="block">
                            <strong>No matching location found.</strong>
                        </div>
                    </div>
                    <div class="content" v-if="user.weather">
                        <div class="block" v-if="user.weather.description">
                            <strong>Description:</strong> {{ user.weather.description }}
                        </div>
                        <div class="block" v-if="user.weather.temperature">
                            <strong>Temperature:</strong> {{ user.weather.temperature }} °C
                        </div>
                        <div class="block" v-if="user.weather.feelsLike">
                            <strong>Feels Like:</strong> {{ user.weather.feelsLike }} °C
                        </div>
                        <div class="block" v-if="user.weather.minTemperature">
                            <strong>Minimum Temperature:</strong> {{ user.weather.minTemperature }} °C
                        </div>
                        <div class="block" v-if="user.weather.maxTemperature">
                            <strong>Maximum Temperature:</strong> {{ user.weather.maxTemperature }} °C
                        </div>
                        <div class="block" v-if="user.weather.pressure">
                            <strong>Pressure:</strong> {{ user.weather.pressure }} mb
                        </div>
                        <div class="block" v-if="user.weather.humidity">
                            <strong>Humidity:</strong> {{ user.weather.humidity }} %
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>