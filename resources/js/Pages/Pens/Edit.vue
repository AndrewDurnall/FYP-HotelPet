<!-- resources/js/Pages/Users/Edit.vue -->
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
</script>

<template>
    <Head title="Edit Pen" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Pen</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <p>*Required Fields</p>
                    <!--Form to show pen details that are already populated by the pen data from the pen id sent from the edit function of the pens controller-->
                    <form @submit.prevent="submitForm">

                        <label>Pen Number *:</label>
                        <br>
                        <input class="w-full" type="text" v-model="form.penNumber" required/>
                        <br>
                        <label>Pen Description *:</label>
                        <br>
                        <input class="w-full" type="text" v-model="form.description" required/>
                        <br>
                        <PrimaryButton type="submit">Update Pen</PrimaryButton>

                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';

export default {
    props: {
        pens: Object,
    },
    data() {
        return {
            form: {
                // populating the form with the data passed from the pen id so that the form can be edited easily
                penNumber: this.pens.penNumber,
                description: this.pens.description,
            },
        };
    },
    methods: {
        // submitting the form to the pens controller via the update function with the id of the pen passed via the url
        submitForm() {
            Inertia.put(`/pens/${this.pens.id}`, this.form);
        },
    },
};
</script>
