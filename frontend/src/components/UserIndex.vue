<script>
    export default {
        data: () => ({
            response: false,
            users: null,
        }),

        created() {
            this.fetchData()
        },

        methods: {
            async fetchData() {
                const url = 'http://localhost/'
                const { users } = await (await fetch(url)).json();
                this.response = true;
                this.users = users;
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
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users" :key="user.id">
                        <th>{{ user.name }}</th>
                        <th>{{ user.latitude }}</th>
                        <th>{{ user.longitude }}</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</template>