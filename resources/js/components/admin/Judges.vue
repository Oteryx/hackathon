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
                Ajouter un jury
            </v-card-title>
            <v-form @submit.prevent="addJudge()" v-model="valid">
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
                    <v-select
                        v-model="fields.spot_id"
                        :items="Spots"
                        item-text="name"
                        item-value="id"
                        id="spot_id"
                        prepend-icon="place"
                        name="spot_id"
                        type="text"
                        color="#e91f62"
                        label="Plateau"
                        :rules="spotRules"
                        required
                    >
                    </v-select>
                    <v-text-field id="email"
                                  prepend-icon="local_post_office"
                                  name="email"
                                  label="Email"
                                  type="email"
                                  color="#e91f62"
                                  v-model="fields.email"
                                  :rules="emailRules"
                                  required></v-text-field>
                    <v-text-field id="password"
                                  prepend-icon="enhanced_encryption"
                                  name="password"
                                  label="Mot de passe"
                                  type="text"
                                  color="#e91f62"
                                  v-model="fields.password"
                                  :rules="passwordRules"
                                  required></v-text-field>



                </v-card-text>
                <v-card-actions style="padding:20px;">
                    <v-spacer></v-spacer>
                    <v-btn color="#e91f62" type="submit" white x-large :disabled="!valid">créer</v-btn>

                </v-card-actions>
            </v-form>
        </v-card>
    </div>
</template>

<script>
export default {
    name: "Judges",
    data() {
        return {
            valid: true,

            fields: {},
            errors: {},
            Spots: [],


            // Rules
            nameRules: [
                v => !!v || 'Le nom est obligatoire',
            ],
            emailRules: [
                v => !!v || 'L\'adresse mail est obligatoire',
            ],
            spotRules: [
                v => !!v || 'Ce champ est obligatoire',
            ],
            passwordRules: [
                v => !!v || 'Ce champ est obligatoire',
            ],

            // toast
            show: false,
            top: true,
            message: "Le jury à été ajouté",
            timeout: 3000,
        }
    },

    created() {
        axios.get('/api/spot/get')
            .then(response => this.Spots =  response.data);

    },

    methods: {
        // creer un nouveau jury
        addJudge() {
            //alert("add");
            axios.post('/api/judge', this.fields);
            //alert(' ok');
            this.show = true;
            //reload page after add new spot
            setTimeout( () => window.location.reload(), 3100);

        },
    },
}
</script>

<style scoped>

</style>
