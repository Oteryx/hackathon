<template>
    <v-app id="keep">
        <v-app-bar
            app
            clipped-left
            color="pink"
        >
            <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
            <span class="title ml-3 mr-5">Quai Alpha&nbsp;<span class="font-weight-light">Classement</span></span>


            <v-spacer></v-spacer>

            <v-menu
                left
                bottom
            >
                <template v-slot:activator="{ on, attrs }">
                    <v-btn
                        icon
                        v-bind="attrs"
                        v-on="on"
                    >
                        <v-icon>mdi-dots-vertical</v-icon>
                    </v-btn>
                </template>

                <v-list>
                    <v-list-item
                        @click="() => {}"
                    >
                        <v-list-item-title>Deconnexion</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>
        </v-app-bar>

        <v-navigation-drawer
            v-model="drawer"
            app
            clipped
            color="grey lighten-4"
        >
            <v-list
                dense
                class="grey lighten-4"
            >
                <template v-for="(item, i) in items">
                    <v-row
                        v-if="item.heading"
                        :key="i"
                        align="center"
                    >
                        <v-col cols="6">
                            <v-subheader v-if="item.heading">
                                {{ item.heading }}
                            </v-subheader>
                        </v-col>
                        <v-col
                            cols="6"
                            class="text-right"
                        >
                            <v-btn
                                small
                                text
                            >edit</v-btn>
                        </v-col>
                    </v-row>
                    <v-divider
                        v-else-if="item.divider"
                        :key="i"
                        dark
                        class="my-4"
                    ></v-divider>


                    <v-list-item
                        v-else
                        :key="i"
                        link
                        @click="goTolink(item.linkName)"
                    >


                        <v-list-item-action>
                            <v-icon>{{ item.icon }}</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title class="grey--text" >
                                {{ item.text }}
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </template>
            </v-list>

        </v-navigation-drawer>

        <router-view></router-view>

    </v-app>
</template>

<script>
    export default {
        data: () => ({
            drawer: null,
            items: [
                { icon: 'mdi-account-group', text: 'Equipes', linkName:'teams' },
                { divider: true },
                { icon: 'mdi-star-circle', text: 'Jurys', linkName:'judges' },
                { divider: true },
                { icon: 'mdi-map-marker', text: 'Plateaux', linkName:'spots' },
                { divider: true },
                { icon: 'mdi-cog', text: 'Settings', linkName:'/' },
                { icon: 'mdi-help', text: 'Help' },
            ],
        }),

        methods: {
            goTolink(linkName) {
                this.$root.$router.push({name: linkName}).catch(()=>{});
            },

        }
    }

</script>

<style scoped>
    #keep .v-navigation-drawer__border {
        display: none
    }
    #keep{
        width: 100%;
    }
</style>
