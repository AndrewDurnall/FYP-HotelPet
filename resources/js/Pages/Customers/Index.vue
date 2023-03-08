<!-- resources/js/Pages/Customers/Index.vue -->
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/inertia-vue3';


</script>

<template>
    <Head title="Customers"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Existing Customers</h2>
        </template>

        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                    <div>
                        <table class="col-auto w-full">
                            <thead>
                            <tr>
                                <th class="text-left">Name</th>
                                <th class="text-left">Address</th>
                                <th class="text-left">Pets</th>
                                <th class="text-left">Customer Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr class="bg-white overflow-hidden shadow-sm sm:rounded-lg d-flex justify-content-around border-b-2"
                                v-for="customer in customers" :key="customer.id">

                                <td class="pr-1 text-left">{{ customer.firstName }} {{ customer.lastName }}</td>

                                <td class="pr-1 text-left">
                                    <ul>
                                        <li class="pr-1 text-left">{{ customer.addressLine1 }}</li>
                                        <li class="pr-1 text-left">{{ customer.addressLine2 }}</li>
                                        <li class="pr-1 text-left">{{ customer.postCode }}</li>
                                    </ul>
                                </td>

                                <td>
                                    <ul>
                                        <li v-for="pet in customer.pets" :key="pet.id">
                                            <a :href="`/pets/${pet.id}/edit`"
                                               class="mr-1 text-green-600 underline ">{{ pet.species }} : {{
                                                    pet.petName
                                                }}</a>

                                        </li>
                                    </ul>
                                </td>

                                <td>
                                    <a :href="`/customers/${customer.id}/edit`" class="mr-1 text-yellow-600 underline ">Edit</a>
                                    <button class="text-red-700 underline" @click="deleteCustomer(customer.id)">Delete
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
    props: {
        customers: Array,
    },
    methods: {
        deleteCustomer(id) {
            if (confirm('Are you sure you want to delete this customer?')) {
                this.$inertia.delete(`/customers/${id}`);
            }
        },
    },
};
</script>
