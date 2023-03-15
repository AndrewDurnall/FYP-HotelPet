<!-- resources/js/Pages/Customers/Index.vue -->
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/inertia-vue3';


</script>

<template>
    <Head title="Pens"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Existing Pens</h2>
            <a :href="`/pens/create`" class="mr-1 text-green-600 underline ">Create New Pen</a>
        </template>

        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    <div>
                        <table class="col-auto w-full">
                            <thead>
                            <tr>
                                <th class="text-left">Pen Number</th>
                                <th class="text-left">Pen Description</th>
                            </tr>
                            </thead>

                            <tbody>
                            <!-- displaying the pens with the pen number, pen description and a button for
                                                  editing and deleting the pen for each pen in the pens table -->
                            <tr class="bg-white overflow-hidden shadow-sm sm:rounded-lg d-flex justify-content-around border-b-2"
                                v-for="pen in pens" :key="pens.id">

                                <td class="pr-1 text-left">{{ pen.penNumber }}</td>
                                <td class="pr-1 text-left">{{ pen.description }}</td>

                                <td>
                                    <!-- edit button redirects the user to the edit form for the pen with the pen id passed in the url -->
                                    <a :href="`/pens/${pen.id}/edit`" class="mr-1 text-yellow-600 underline ">Edit</a>

                                    <!-- delete button to delete the booking based on its pen id -->
                                    <button class="text-red-700 underline" @click="deletePens(pen.id)">Delete
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>


    </AuthenticatedLayout>


</template>

<script>

export default {
    // providing pens as an array passed from the pens controller
    props: {
        pens: Array,
    },
    methods: {
        // using the destroy function of the pens controller that is passed the id from this function in the url to delete the pen
        deletePens(id) {
            if (confirm('Are you sure you want to delete this pen?')) {
                this.$inertia.delete(`/pens/${id}`);
            }
        },
    },
};
</script>

