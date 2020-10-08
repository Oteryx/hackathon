<template>
    <div>
        <v-snackbar v-model="show" :top="top" color="green" :timeout="timeout">
            {{message}}
        </v-snackbar>
        <v-card width="100%" white>
            <v-card-title>
                <v-icon
                >
                    mdi-plus
                </v-icon>
                Ajouter un plateau
            </v-card-title>
            <v-form @submit.prevent="addSpot()" v-model="valid">
                <v-card-text>
                    <v-text-field
                        prepend-icon="create"
                        name="name"
                        label="Nom"
                        type="text"
                        color="#e91f62"
                        v-model="fields.name"
                        :rules="nameRules"
                        required></v-text-field>
                </v-card-text>
                <v-card-actions style="padding:20px;">
                    <v-spacer></v-spacer>
                    <v-btn
                        color="#e91f62"
                        type="submit"
                        white
                        x-large
                        :disabled="!valid"
                    >créer
                    </v-btn>

                </v-card-actions>
            </v-form>
        </v-card>
        <div>
            <v-card
                v-for="Spot in Spots"
                class="mx-auto mb-4"
                dark
            >
                <v-list-item three-line>

                    <v-list-item-content>
                        <v-list-item-title class="headline mb-1">
                            <v-chip color="gray">{{Spot.id}}</v-chip>
                            {{Spot.name}}
                        </v-list-item-title>
                        <v-list-item-subtitle>{{Spot.address}}</v-list-item-subtitle>
                    </v-list-item-content>

                    <v-list-item-action-text
                        color="green"
                    >
                        <div class="overline mb-4">

                            <v-card-actions>
                                <v-btn
                                    class="mx-2"
                                    fab
                                    dark
                                    small
                                    color="green"
                                >
                                    <v-icon dark>
                                        mdi-pencil
                                    </v-icon>
                                </v-btn>

                                <v-btn
                                    class="mx-2"
                                    fab
                                    dark
                                    small
                                    color="red"
                                >
                                    <v-icon dark>
                                        mdi-delete
                                    </v-icon>
                                </v-btn>

                            </v-card-actions>
                        </div>
                    </v-list-item-action-text>
                </v-list-item>


            </v-card>
        </div>
    </div>

</template>

<script>
    export default {
        name: "Spots",
        data() {
            return {
                valid: true,

                fields: {},
                errors: {},

                // Rules
                nameRules: [
                    v => !!v || 'Le nom est obligatoire',
                ],

                // toast
                show: false,
                top: true,
                message: "Le plateau à été ajouté",
                timeout: 3000,

                Spots: []
            }
        },
        created() {
            axios.get('/api/spotsControllert/get')
                .then(response => this.Spots = response.data);
        },
        methods: {
            // creer un nouveau spotsControllert
            addSpot() {
                axios.post('/api/spotsControllert', this.fields);
                //alert(' ok');
                this.show = true;
                //reload page after add new spotsControllert
                setTimeout(() => window.location.reload(), 3100);
            },
        },
    };
</script>
<style scoped>
</style>
