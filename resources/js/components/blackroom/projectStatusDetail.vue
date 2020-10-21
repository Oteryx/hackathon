<template>
    <div>
        <v-dialog
            v-model="confirmchangestatus"
            width="500"
        >
            <v-card>
                <v-card-title class="headline" primary-title style="background-color:#e91e63;">
                    <span style="color:white;">Ouvrir aux votes</span>
                    <v-spacer></v-spacer>
                    <v-btn text icon color="white" right @click="confirmchangestatus = false">
                        <v-icon large>close</v-icon>
                    </v-btn>
                </v-card-title>
                <v-card-text>
                    Voulez-vous ouvrir aux votes le projet : <b>{{ projectName }}</b> ?
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="secondary"
                        @click="confirmchangestatus = false"
                        class="white--text"
                    >
                        Annuler
                    </v-btn>
                    <v-btn
                        color="#e91e63"
                        @click="changeStatusOpen()"
                        class="white--text"

                    >
                        Confirmer
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <v-dialog
            v-model="confirmchangestatusclose"
            width="500"
        >
            <v-card>
                <v-card-title class="headline" primary-title style="background-color:#e91e63;">
                    <span style="color:white;">Fermer les votes</span>
                    <v-spacer></v-spacer>
                    <v-btn text icon color="white" right @click="confirmchangestatusclose = false">
                        <v-icon large>close</v-icon>
                    </v-btn>
                </v-card-title>
                <v-card-text>
                    Voulez-vous fermer les votes pour le projet : <b>{{ projectName }}</b> ?
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="secondary"
                        @click="confirmchangestatusclose = false"
                        class="white--text"
                    >
                        Annuler
                    </v-btn>
                    <v-btn
                        color="#e91e63"
                        @click="changeStatusClose()"
                        class="white--text"
                    >
                        Confirmer
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <v-list-item
            :key="projectId + '-project'"
        >
            <v-list-item-icon>
                <v-icon large>build_circle</v-icon>
            </v-list-item-icon>
            <v-list-item-content>
                <v-list-item-title>
                    <strong> {{ projectName }} </strong>
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
                    <v-tooltip top>
                    <template v-slot:activator="{ on, attrs }">
                    <v-btn fab large class="mx-2" v-bind="attrs"
                           v-on="on" color="gray" :disabled="pendingAction"
                           :style="[projectStatus === 1 ? {'background-color':'#c90f54 !important'}: {}]">
                        <v-icon color="grey lighten-1">schedule</v-icon>
                    </v-btn></template>
                        <span>En attente</span>
                    </v-tooltip>
                    <v-tooltip top>
                    <template v-slot:activator="{ on, attrs }">
                    <v-btn @click="confirmchangestatus = true" v-bind="attrs"
                           v-on="on" fab large class="mx-2" color="gray" :disabled="openAction"
                           :style="[projectStatus === 2 ? {'background-color':'#c90f54 !important'}: {}]">
                        <v-icon color="grey lighten-1">how_to_vote</v-icon>
                    </v-btn></template>
                        <span>Activer le vote</span>
                    </v-tooltip>
                    <v-tooltip top>
                    <template v-slot:activator="{ on, attrs }">
                    <v-btn @click="confirmchangestatusclose = true" v-bind="attrs"
                           v-on="on" fab large class="mx-2" color="gray" :disabled="closedAction"
                           :style="[projectStatus === 3 ? {'background-color':'#c90f54 !important'}: {}]">
                        <v-icon color="grey lighten-1">cancel</v-icon>
                    </v-btn>
                    </template>
                        <span>Fermer les votes</span>
                    </v-tooltip>
                </div>
            </v-list-item-action>
        </v-list-item>
    </div>
</template>

<script>
    export default {
        name: "projectStatusDetail.vue",
        props: ['projectId'],
        data: function () {
            return {
                projectName: "",
                projectStatus: "",
                confirmchangestatus: false,
                confirmchangestatusclose: false,
                pendingAction: true,
                openAction: false,
                closedAction: true,
            }
        },
        created: function () {
            let projectData = this.$store.state.projects.find(project => project.id === this.projectId);
            this.projectName = projectData.name;
            this.projectStatus = projectData.status_id;
        },
        methods: {
            changeStatusOpen: function () {
                this.$store.dispatch('changeProjectStatusOpen', this.projectId);

            },
            changeStatusClose: function () {
                this.$store.dispatch('changeProjectStatusClose', this.projectId);
            }
        },
        watch: {
            projectStatus: function () {
                switch (this.projectStatus) {
                    case 2:
                        this.pendingAction = true;
                        this.openAction = true;
                        this.closedAction = false;
                        break;
                    case 3:
                        this.pendingAction = true;
                        this.openAction = true;
                        this.closedAction = true;
                        break;
                }
            }
        }
    }
</script>

<style>

</style>
