<template>
    <div>
        <v-card width="100%">
            <v-card-title>
                <v-icon x-large
                        color="black">
                    add_circle_outline
                </v-icon>
                &nbsp;Modifier un plateau
            </v-card-title>
            <v-form @submit.prevent="editSpot()" v-model="valid" ref="spotForm">
                <v-card-text>

                    <v-text-field
                        id="name"
                        prepend-icon="account_balance"
                        name="name"
                        label="Nom du plateau"
                        color="#e91f62"
                        v-model="name"
                        :rules="nameRules"
                        required></v-text-field>


                    <v-text-field id="slug"
                                  prepend-icon="link"
                                  name="slug"
                                  label="slug"
                                  color="#e91f62"
                                  v-model="slug"
                                  :rules="slugRules"
                                  required></v-text-field>


                </v-card-text>
                <v-card-actions style="padding:20px;">
                    <v-spacer></v-spacer>
                    <v-btn color="#e91f62" type="submit" x-large :disabled="!valid" class="white--text"> Modifier
                        le plateau
                    </v-btn>

                </v-card-actions>
            </v-form>
        </v-card>
    </div>
</template>

<script>
    export default {
        name: "editspots",
        data: function () {
            return {
                valid: false,
                name: "",
                slug: "",


                nameRules: [
                    v => !!v || 'Le nom est obligatoire',
                ],
                slugRules: [
                    v => !!v || 'Le slug est obligatoire',
                ],

            }
        },
        methods: {
            editSpot: function () {
                this.$store.dispatch('editSpot', {name: this.name, slug: this.slug});
                this.$refs.spotForm.reset();
            },
        }
    }
</script>

<style scoped>

</style>
