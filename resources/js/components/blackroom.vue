<template>
    <v-app>
        <v-main>
            <router-view></router-view>
            <router-link :to="{ name: 'Login' }">admin</router-link> |
            <router-link :to="{ name: 'dashboard' }">loginadmin</router-link>
        </v-main>
    </v-app>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
