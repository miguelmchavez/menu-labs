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
                    <div class="content">
                        <div class="block">
                            <strong>Description:</strong> {{ user.weather.description }}
                        </div>
                        <div class="block">
                            <strong>Temperature:</strong> {{ user.weather.temperature }}
                        </div>
                        <div class="block">
                            <strong>Feels Like:</strong> {{ user.weather.feelsLike }}
                        </div>
                        <div class="block">
                            <strong>Minimum Temperature:</strong> {{ user.weather.minTemperature }}
                        </div>
                        <div class="block">
                            <strong>Maximum Temperature:</strong> {{ user.weather.maxTemperature }}
                        </div>
                        <div class="block">
                            <strong>Pressure:</strong> {{ user.weather.pressure }}
                        </div>
                        <div class="block">
                            <strong>Humidity:</strong> {{ user.weather.humidity }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>