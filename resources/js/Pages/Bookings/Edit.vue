<!-- resources/js/Pages/Bookings/Edit.vue -->

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/inertia-vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';

</script>

<template>
    <Head title="Edit Booking"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Booking</h2>
        </template>


        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">

                    <div>
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Existing Booking Details</h2>
                        <ul>
                            <li>{{booking.customer.firstName}} {{booking.customer.lastName}} - {{booking.customer.houseNumberOrName}} {{booking.customer.addressLine1}}</li>
                            <li>{{booking.pens.description}} {{booking.pens.penNumber}}</li>
                            <li>From: {{formatDate(booking.startDate)}} To: {{formatDate(booking.endDate)}}</li>
                        </ul>

                        <br>
                        <form @submit.prevent="form.put(route('bookings.update', this.booking.id), { onSuccess: () => form.reset() })">




                            <div id="datepickers" class="max-w-7xl mx-auto ">
                                <div class="w-1/3 flex justify-between">
                                    <label for="start-date">New Start Date:</label>
                                    <input required type="date" id="start-date" name="startDate" v-model="form.startDate" @change="checkAvailabilityEdit" >
                                </div>
                                <br>
                                <div class="w-1/3 flex justify-between">
                                    <label for="end-date">New End Date:</label>
                                    <input required type="date" id="end-date" name="endDate" v-model="form.endDate" @change="checkAvailabilityEdit">
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

                                    <label for="selection_pen">Select an available pen*</label>

                                    <!-- selection from the available pens array-->
                                    <select id="selection_pen" v-model="form.pens_id" class="w-full" required>
                                        <option v-for="pens in pens" :value="pens.id">
                                            {{
                                                pens.description + " " + pens.penNumber
                                            }}
                                        </option>
                                    </select>

                                    <label for="selection_customer">Select A Customer*</label>
                                    <select id="selection_customer" v-model="form.customer_id" class="w-full" required>
                                        <option v-for="customer in customers" :value="customer.id" >{{ customer.firstName + " " + customer.lastName + " - " + customer.addressLine1}}</option>
                                    </select>



                                </ul>
                                <!-- shows when no pens are available -->
                                <div v-else>
                                    No pens available for the selected dates
                                </div>
                            </div>
                            <br>
                            <PrimaryButton type="submit">Update Booking</PrimaryButton>

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
import { format } from 'date-fns'


const form = useForm({
    pens_id: '',
    startDate: '',
    endDate: '',
    customer_id: '',
});

export default {
    props: {
        customer: Object,
        booking: Object,
        customers: Array,
    },

    data() {
        return {
            availability: null,
            pens: [],
        };
    },

    methods: {

        //formatting the date to appear readable
        formatDate(date){
            return format(new Date(date), 'dd-MM-yyyy')
        },
        //checking the availability of the pens within the selected dates
        checkAvailabilityEdit() {

            const startDate = form.startDate;

            const endDate = form.endDate;

            axios.get('/bookings/checkEdit/' + this.booking.id, {
                params: {
                    startDate: startDate,
                    endDate: endDate,
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


