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
                const url = 'http://localhost/users'
                const { data: users } = await (await fetch(url)).json();
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
                        <th>#</th>
                        <th>Name</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(user, index) in users" :key="user.id">
                        <th>{{ index + 1 }}</th>
                        <th>{{ user.name }}</th>
                        <th>{{ user.lat }}</th>
                        <th>{{ user.lng }}</th>
                        <th>
                            <RouterLink :to="{ name: 'user', params: { id: user.id } }" class="navbar-item">Show</RouterLink>
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</template>