<template>
    <div
        style="padding-left:50px;padding-right:50px;">
        <h1 style="margin-bottom:20px;">Notations</h1>
        <v-card width="100%">
            <v-card-title>
                <v-icon  x-large
                         color="black">
                    emoji_events
                </v-icon>
                Ouvertures Des Notations
            </v-card-title>
            <v-card-text >
                <v-container class="lighten-5">
                    <v-row no-gutters
                           v-for="(project, index) in $store.state.projects"
                           :key="project.id + '-project'">
                        <v-col>
                            <h2 v-if="index<1">
                                Nom des Equipes
                            </h2>
                            <p>
                                {{ project.name }}
                            </p>
                        </v-col>
                        <v-col>
                            <h2 v-if="index<1">
                                Nombre de Votants
                            </h2>
                            <p>
                                1/10
                            </p>
                        </v-col>
                        <v-col>
                            <div class="button">
                                <v-btn-toggle
                                    borderless>
                                    <v-btn value="left"
                                           color="orange">
                                        <span class="hidden-sm-and-down">En Attente</span>
                                        <v-icon>
                                            hourglass_top
                                        </v-icon>
                                    </v-btn>
                                    <v-btn value="center"
                                           color="blue">
                                        <span class="hidden-sm-and-down">Ouvert</span>
                                        <v-icon>
                                            lock_open
                                        </v-icon>
                                    </v-btn>
                                    <v-btn value="right"
                                           color="red">
                                        <span class="hidden-sm-and-down">Fermé</span>
                                        <v-icon>
                                            lock
                                        </v-icon>
                                    </v-btn>
                                </v-btn-toggle>
                            </div>
                        </v-col>
                    </v-row>
                </v-container>
            </v-card-text>
        </v-card>
    </div>
</template>



<script>
    export default {

        name: "scoring",

    }





</script>

<style>
</style>
