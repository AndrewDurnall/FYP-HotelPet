<!-- resources/js/Pages/Bookings/Index.vue -->
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';

</script>

<template>
    <Head title="NewBooking" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Existing Bookings</h2>
        </template>
        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
            <table class="col-auto w-full">
                <thead>
                <tr>
                    <th class="text-left">ID</th>
                    <th class="text-left">Customer</th>
                    <th class="text-left">Pen</th>
                    <th class="text-left">From</th>
                    <th class="text-left">To</th>
                    <th class="text-left">Delete Booking</th>
                </tr>
                </thead>
                <tbody>

                <!-- displaying the bookings with the booking id, related customer details, related pen details and a button for
                                                                                                editing and deleting the booking for each booking in the bookings table -->
                <tr class="bg-white overflow-hidden shadow-sm sm:rounded-lg d-flex justify-content-around border-b-2" v-for="booking in reversedBookings" :key="booking.id">
                    <td class="text-left">{{ booking.id}}</td>
                    <td class="text-left">{{ booking.customer.firstName}} {{ booking.customer.lastName}}</td>
                    <td class="text-left">{{ booking.pens.description }} {{ booking.pens.penNumber }}</td>
                    <td class="text-left">{{ formatDate(booking.startDate) }}</td>
                    <td class="text-left">{{ formatDate(booking.endDate) }}</td>

                    <td>
                        <!-- edit button redirects the user to the edit form for the booking with the id passed in the url -->
                        <a :href="`/bookings/${booking.id}/edit`" style="color: #006400; font-weight: bold" class="mr-1 underline ">Edit</a>

                        <!-- delete button to delete the booking based on its booking id -->
                        <button style="color: #A82726; font-weight: bold" class="underline" @click="deleteBooking(booking.id)" >Delete</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script>
import {format} from "date-fns";

export default {
    props: {
        // providing bookings as an array passed from the bookings controller
        bookings: {
            type: Array,
            required: true
        }
    },
    methods: {
        // using the destroy function of the bookings controller that is passed the id from this function in the url to delete the booking
        deleteBooking(id) {
            if (confirm('Are you sure you want to delete this booking?')) {
                this.$inertia.delete(`/bookings/${id}`);
            }
        },
        //formatting the date to appear readable on the bookings list
        formatDate(date){
            return format(new Date(date), 'dd-MM-yyyy')
        },
    },
    // formatting the bookings list to be newest at the top.
    computed: {
        reversedBookings() {
            return this.bookings.slice().reverse();
        },
    },
}
</script>

