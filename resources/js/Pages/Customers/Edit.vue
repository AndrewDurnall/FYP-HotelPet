<!-- resources/js/Pages/Users/Edit.vue -->
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
</script>

<template>
    <Head title="Edit Customer" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Customer</h2>
        </template>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <p>*Required Fields</p>

<!--Form to show customer details that are already populated by the customer data from the customer id sent from the edit function of the customer controller-->
        <form @submit.prevent="submitForm">

            <label>First Name *:</label>
                <br>
            <input class="w-full" type="text" v-model="form.firstName" />
            <br>
                <label>Last Name *:</label>
            <br>
                <input class="w-full" type="text" v-model="form.lastName" />
            <br>
                <label>House Name Or Number *:</label>
            <br>
                <input class="w-full" type="text" v-model="form.houseNumberOrName" />
            <br>
                <label>Address Line 1 *:</label>
            <br>
                <input class="w-full" type="text" v-model="form.addressLine1" />
            <br>
                <label>Address Line 2:</label>
            <br>
                <input  class="w-full" type="text" v-model="form.addressLine2" />
            <br>
                <label>Town/City *:</label>
            <br>
                <input class="w-full"  type="text" v-model="form.townCity" />
            <br>
                <label>Postcode *:</label>
            <br>
                <input  class="w-full" type="text" v-model="form.postCode" />
            <br>
                <label>Telephone *:</label>
            <br>
                <input class="w-full"  type="text" v-model="form.telephone" />
            <br>
                <label>Email:</label>
            <br>
                <input class="w-full"  type="text" v-model="form.email" />
            <br>
                <label>Emergency Contact Name *:</label>
            <br>
                <input class="w-full"  type="text" v-model="form.emergencyName" />
            <br>
                <label>Emergency Constact's Number *:</label>
            <br>
                <input  class="w-full" type="text" v-model="form.emergencyNumber" />
            <br>
                <PrimaryButton type="submit">Update Customer</PrimaryButton>

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
        // utilising the customer data passed from the customer controller edit function
        customer: Object,
    },
    data() {

        // populating the form with the data passed from the customer id so that the form can be edited easily
        return {
            form: {
                firstName: this.customer.firstName,
                lastName: this.customer.lastName,
                houseNumberOrName: this.customer.houseNumberOrName,
                addressLine1: this.customer.addressLine1,
                addressLine2: this.customer.addressLine2,
                townCity: this.customer.townCity,
                postCode: this.customer.postCode,
                telephone: this.customer.telephone,
                email: this.customer.email,
                emergencyName: this.customer.emergencyName,
                emergencyNumber: this.customer.emergencyNumber,
            },
        };
    },
    methods: {

        // submitting the form to the customer controller via the update function with the id of the customer passed via the url
        submitForm() {
            Inertia.put(`/customers/${this.customer.id}`, this.form);
        },
    },
};
</script>
