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

                            <!-- displaying the customers with the customer first name, last name address and associated pets with
                            an edit and a delete button for each customer in the customers table-->
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
                                            <a :href="`/pets/${pet.id}/edit`" style="color: #006400; font-weight: bold"
                                               class="mr-1 underline ">{{ pet.species }} : {{pet.petName }}</a>

                                        </li>
                                    </ul>
                                </td>

                                <td>
                                    <!-- edit button redirects the user to the edit form for the customer with the id passed in the url -->
                                    <a :href="`/customers/${customer.id}/edit`" style="color: #006400; font-weight: bold" class="mr-1 underline ">Edit</a>

                                    <!-- delete button to delete the customer based on its customer id -->
                                    <button style="color: #A82726; font-weight: bold" class="underline" @click="deleteCustomer(customer.id)">Delete
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
        // providing customers as an array passed from the customer controller
        customers: Array,
    },
    methods: {
        // using the destroy function of the customer controller that is passed the id from this function in the url to delete the customer
        deleteCustomer(id) {
            if (confirm('Are you sure you want to delete this customer?')) {
                this.$inertia.delete(`/customers/${id}`);
            }
        },
    },
};
</script>
