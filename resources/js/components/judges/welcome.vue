<template>
    <div>
        <v-app-bar
            color="#C90F54"
            dark
            app
        >
            <v-toolbar-title><strong>Bienvenue {{$store.state.userData.name}} <span class="font-weight-light">Plateau: {{$store.state.userData.spot_id}}</span></strong>
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn @click="consoleUser">Console log user data</v-btn>
            <v-btn color="white">
                <v-icon color="#C90F54">lock</v-icon>
                <span style="color:#C90F54"@click="logOut">&nbsp;Déconnexion</span>
            </v-btn>
        </v-app-bar>
        <ul>
        <v-list-item
            v-for="(pro) in Project"

        >
            <v-btn class="projet" >
            <v-list-item-icon>
                <v-icon large>build_circle</v-icon>
            </v-list-item-icon>
            <v-list-item-content>
                <v-list-item-title>
                    <strong> {{ pro.Name }} Status:{{pro.statuts}} </strong>
                </v-list-item-title>
            </v-list-item-content>
            <v-list-item-action>
                <div>
                    <v-chip
                        color="#c90f54"
                        text-color="white"
                    >
                        <strong> 0 / 10</strong>
                    </v-chip>&nbsp;&nbsp;&nbsp;
                </div>
            </v-list-item-action>
            </v-btn>
        </v-list-item>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "welcome.vue",
        props: ['projectId'],
        data: function () {
            return {
                projectName: "",
                projectStatus: "1",
                Project:[
                    {
                        Name:"projet 1",
                        plateau:"1",
                        statuts:"1"
                    },
                    {
                        Name:"projet 2",
                        plateau:"1",
                        statuts:"1"
                    },
                    {
                        Name:"projet 3",
                        plateau:"1",
                        statuts:"2"
                    },
                    {
                        Name:"projet 4",
                        plateau:"1",
                        statuts:"3"
                    },
                    {
                        Name:"projet 5",
                        plateau:"1",
                        statuts:"2"
                    },
                ],
            }
        },
        methods: {
            consoleUser: function() {
                this.$store.dispatch('consoleUser');
            },
            logOut: function() {
                this.$store.dispatch('logout');
            },
        }
    }
</script>

<style>
    .projet{
        margin: auto;
    }

</style>
