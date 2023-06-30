<!-- resources/js/Pages/Bookings/Create.vue -->
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/inertia-vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import {Inertia} from '@inertiajs/inertia'

</script>

<template>
    <Head title="NewBooking"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create New Booking</h2>
        </template>


        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">

                    <div>
                        <p>*Required Fields</p>
                        <br>

                        <form @submit.prevent="form.post(route('bookings.store'), { onSuccess: () => form.reset() })">

                            <div id="datepickers" class="max-w-7xl mx-auto ">
                                <div>
                                    <label for="start-date">Start Date:</label>
                                    <input required type="date" id="start-date" name="startDate" v-model="form.startDate" @change="checkAvailability" >
                                </div>
                                <br>
                                <div>
                                    <label for="end-date">End Date:</label>
                                    <input required type="date" id="end-date" name="endDate" v-model="form.endDate" @change="checkAvailability">
                                </div>
                            </div>
                            <br>

                            <!-- place holder for pens available query -->
                            <div v-if="availability === null">
                                Select dates to check availability*
                            </div>

                            <div v-else>
                                <p v-if="availability">Pens are available for the selected dates!</p>


                                <!-- available pens array -->
                                <ul v-if="pens.length > 0">

                                    <label for="selection_pen">Select A Pen*</label>

                                    <!-- selection from the available pens array-->
                                    <select id="selection_pen" v-model="form.pens_id" class="w-full" required>
                                        <option v-for="pens in pens" :value="pens.id">
                                            {{
                                                pens.description + " " + pens.penNumber
                                            }}
                                        </option>
                                    </select>

                                    <label for="selection_customer">Select A Customer*</label>
                                    <select required id="selection_customer" v-model="form.customer_id" class="w-full">
                                        <option v-for="customer in customers" :value="customer.id">
                                            {{
                                                customer.firstName + " " + customer.lastName + " - " + customer.addressLine1
                                            }}
                                        </option>
                                    </select>
                                </ul>
                                <!-- shows when no pens are available -->
                                <div v-else>
                                    No pens available for the selected dates
                                </div>
                            </div>
                            <br>
                            <PrimaryButton type="submit">Add Booking</PrimaryButton>

                        </form>

                    </div>
                </div>
            </div>
        </div>


    </AuthenticatedLayout>
</template>
<script>
import axios from 'axios';
import {useForm} from "@inertiajs/inertia-vue3";

const form = useForm({
    customer_id: '',
    pens_id: '',
    startDate: '',
    endDate: '',
});

export default {
    data() {
        return {
            startDate: null,
            endDate: null,
            availability: null,
            pens: []
        };
    },
    props: {
        customers: Array,
    },
    methods: {
// method that checks availabiliy by sending the start and end dates to the bookings controller checkAvailability function which returns with an array of pens available for the selected dates
// or a statement that there are no pens available for the selected dates and then displays either a dynamic drop down on screen of available pens or the message
// "no pens are available" and doesnt load any more of the form.
        checkAvailability() {
            const startDate = form.startDate;
            const endDate = form.endDate;

            axios.get('/bookings/check', {
                params: {
                    startDate: startDate,
                    endDate: endDate
                }
            })
                .then(response => {
                    this.availability = response.data.available;
                    this.pens = response.data.pens;
                })
                .catch(error => {
                    console.error()

                });
        }
    }
};
</script>
