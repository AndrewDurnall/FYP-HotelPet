<!-- resources/js/Pages/Users/Edit.vue -->
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
</script>

<template>
    <Head title="Edit Pet" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Pet</h2>
        </template>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <p>*Required Fields</p>
                <form @submit.prevent="submitForm">


<!--Form to show pet details that are already populated by the pet data from the pet id sent from the edit function of the pets controller-->
            <label>Pet's Name *:</label>
                <br>
            <input class="w-full" type="text" v-model="form.petName" />
            <br>
                <label>Pet's Age:</label>
            <br>
                <input class="w-full" type="number" v-model="form.petAge" />
            <br>
                <label>Species *:</label>
            <br>
                <input class="w-full" type="text" v-model="form.species" />
            <br>
                <label>Breed *:</label>
            <br>
                <input class="w-full" type="text" v-model="form.breed" />
            <br>
                <label>Registered Vet's Name *:</label>
            <br>
                <input  class="w-full" type="text" v-model="form.vetName" />
            <br>
                <label>Registered Vet's Number *:</label>
            <br>
                <input class="w-full"  type="text" v-model="form.vetNumber" />
            <br>
                <label>Microchip Number:</label>
            <br>
                <input  class="w-full" type="text" v-model="form.microChip" />
            <br>
                <label>Vaccination Renewal Date *:</label>
            <br>
                <input class="w-full"  type="date" v-model="form.vaccinationDate" />
            <br>
                <label>Feeding Requirements (If Needed):</label>
            <br>
                <input class="w-full"  type="text" v-model="form.feedingRequirements" />
            <br>
                <label>Avoided Food (If Needed):</label>
            <br>
                <input class="w-full"  type="text" v-model="form.avoidedFood" />
            <br>
                <label>Medication Details (If Needed):</label>
            <br>
                <input  class="w-full" type="text" v-model="form.medicationDetails" />
            <br>
                    <br>
                <PrimaryButton  type="submit">Update Pet</PrimaryButton>

        </form>
                <br>
                <!-- button to delete the pet with the function deletePet in script section-->
                <PrimaryButton @click="deletePet(pets.id)" style="background: #A82726" >Delete Pet</PrimaryButton>
            </div>
        </div>
    </div>
        </AuthenticatedLayout>
</template>

<script>

import { Inertia } from '@inertiajs/inertia';

export default {
    props: {
        // utilising the pets data passed from the pets controller edit function
        pets: Object,
    },
    data() {

        // populating the form with the data passed from the pet id so that the form can be edited easily
        return {
            form: {
                petName: this.pets.petName,
                petAge: this.pets.petAge,
                species: this.pets.species,
                breed: this.pets.breed,
                vetName: this.pets.vetName,
                vetNumber: this.pets.vetNumber,
                microChip: this.pets.microChip,
                vaccinationDate: this.pets.vaccinationDate,
                feedingRequirements: this.pets.feedingRequirements,
                avoidedFood: this.pets.avoidedFood,
                medicationDetails: this.pets.medicationDetails,
            },
        };
    },
    methods: {
        // submitting the form to the pets controller via the update function with the id of the pet passed via the url
        submitForm() {
            Inertia.put(`/pets/${this.pets.id}`, this.form);
        },

        // using the destroy function of the pets controller that is passed the id from this function in the url to delete the pet
        deletePet(id) {
            if (confirm('Are you sure you want to delete this pet?')) {
                this.$inertia.delete(`/pets/${id}`);
            }
        },
    },
};
</script>
