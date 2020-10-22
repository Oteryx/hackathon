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
                <div class="loader" :style="[projectStatus === 2 ? {'visibility':'visible !important'}: {}]">
                    <div class="circles">
                        <span class="one"></span>
                        <span class="two"></span>
                        <span class="three"></span>
                    </div>
                    <div class="pacman">
                        <span class="top"></span>
                        <span class="bottom"></span>
                        <span class="left"></span>
                        <div class="eye"></div>
                    </div>
                </div>
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
               // this.$store.dispatch('changeProjectStatusOpen', this.projectId);
                this.projectStatus = 2;
                this.confirmchangestatus = false;
            },
            changeStatusClose: function () {
               // this.$store.dispatch('changeProjectStatusClose', this.projectId);
                this.projectStatus = 3;
                this.confirmchangestatusclose = false;
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
    body{margin:0;background:#1C163A}
    .loader{position:absolute;top:50%;left:50%;height:60px;width:160px;visibility:hidden;margin:0;-webkit-transform:translate(-50%,-50%);transform:translate(-50%,-50%)}
    .circles{position:absolute;left:-5px;top:0;height:60px;width:180px}
    .circles span{position:absolute;top:25px;height:12px;width:12px;border-radius:12px;background-color:#c90f54}
    .circles span.one{right:80px}
    .circles span.two{right:40px}
    .circles span.three{right:0px}
    .circles{-webkit-animation:animcircles 0.5s infinite linear;animation:animcircles 0.5s infinite linear}
    @-webkit-keyframes animcircles{0%{-webkit-transform:translate(0px,0px);transform:translate(0px,0px)}100%{-webkit-transform:translate(-40px,0px);transform:translate(-40px,0px)}}
    @keyframes animcircles{0%{-webkit-transform:translate(0px,0px);transform:translate(0px,0px)}100%{-webkit-transform:translate(-40px,0px);transform:translate(-40px,0px)}}
    .pacman{position:absolute;left:0;top:0;height:60px;width:60px}
    .pacman .eye{position:absolute;top:10px;left:30px;height:7px;width:7px;border-radius:7px;background-color:#EFEFEF}
    .pacman span{position:absolute;top:0;left:0;height:60px;width:60px}
    .pacman span::before{content:"";position:absolute;left:0;height:30px;width:60px;background-color:#c90f54}
    .pacman .top::before{top:0;border-radius:60px 60px 0px 0px}
    .pacman .bottom::before{bottom:0;border-radius:0px 0px 60px 60px}
    .pacman .left::before{bottom:0;height:60px;width:30px;border-radius:60px 0px 0px 60px}
    .pacman .top{-webkit-animation:animtop 0.5s infinite;animation:animtop 0.5s infinite}
    @-webkit-keyframes animtop{0%,100%{-webkit-transform:rotate(0deg);transform:rotate(0deg)}50%{-webkit-transform:rotate(-45deg);transform:rotate(-45deg)}}
    @keyframes animtop{0%,100%{-webkit-transform:rotate(0deg);transform:rotate(0deg)}50%{-webkit-transform:rotate(-45deg);transform:rotate(-45deg)}}
    .pacman .bottom{-webkit-animation:animbottom 0.5s infinite;animation:animbottom 0.5s infinite}
    @-webkit-keyframes animbottom{0%,100%{-webkit-transform:rotate(0deg);transform:rotate(0deg)}50%{-webkit-transform:rotate(45deg);transform:rotate(45deg)}}
    @keyframes animbottom{0%,100%{-webkit-transform:rotate(0deg);transform:rotate(0deg)}50%{-webkit-transform:rotate(45deg);transform:rotate(45deg)}}
</style>
