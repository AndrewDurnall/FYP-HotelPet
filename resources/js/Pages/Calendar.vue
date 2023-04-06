<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/inertia-vue3';</script>
<template>
    <Head title="Calendar" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Calendar</h2>
        </template>

        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">

                        <!-- Buttons to show bookings for next and previous 7 days -->
                        <div class="flex justify-between mb-5">
                            <!-- Button to show bookings for previous 7 days -->
                            <button style="background: #1F2937" class="hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="previousWeekButton">
                                Previous 7 Days
                            </button>
                            <!-- Button to show bookings for next 7 days -->
                            <button style="background: #1F2937" class="hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="nextWeekButton">
                                Next 7 Days
                            </button>


                        </div>


                        <!-- Table for the calendar view with as many rows as there are registered pens, working from the current date for 7 days,
                         showing bookings as highlighted sections of the grid in line with the date and pen and labelled with the customer for the booking-->
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th
                                        v-for="day in days"
                                        :key="day"
                                        class="text-center border-2 p-2"
                                        style="vertical-align: middle; text-align: center;">
                                        {{ formatDate(day) }}
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="pens in pens" :key="pens.id">
                                    <td
                                        class="text-center font-weight-bold border-2"
                                        style="vertical-align: middle; text-align: center;">
                                        {{ pens.description }} {{ pens.penNumber }}
                                    </td>
                                    <td
                                        v-for="day in days"
                                        :key="day"
                                        class="text-center border-2"
                                        style="vertical-align: middle; text-align: center; min-width: 120px;">
                                        <ul
                                            class="list-unstyled"
                                            style="margin: 0; padding: 0; list-style: none; background-color: darkgreen">
                                            <li
                                                v-for="booking in getBookingsForPenAndDay(pens.id, day)"
                                                :key="booking.id"
                                                style="font-size: 14px; line-height: 1.5; background-color: lightblue">
                                                <span>{{ booking.customer.firstName }} {{ booking.customer.lastName }}</span>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
export default {
    props: {
        pens: Array, // an array of pen objects with an id and name property
        bookings: Array // an array of booking objects with a pen_id, startDate, endDate, and customer object
    },
    data() {
        return {
            currentDay: new Date()
        };
    },
    computed: {
        days() {
            // generate an array of 7 days starting from the current day
            const days = [];
            let date = new Date(this.currentDay);
            for (let i = 0; i < 7; i++) {
                days.push(new Date(date));
                date.setDate(date.getDate() + 1);
            }
            return days;
        },
        previousWeek() {
            // get the date for 7 days ago
            const date = new Date(this.currentDay);
            date.setDate(date.getDate() - 7);
            return date;
        },
        nextWeek() {
            // get the date for 7 days from now
            const date = new Date(this.currentDay);
            date.setDate(date.getDate() + 7);
            return date;
        }
    },
    methods: {
        formatDate(date) {
            // Define an array to store the abbreviated day names
            const daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

            // Get the day of the week as a number (0 = Sunday, 1 = Monday, etc.)
            const dayOfWeek = date.getDay();

            // Get the date as a string in the format "dd/mm/yy"
            const dateStr = date.toLocaleDateString('en-GB');

            // Combine the day abbreviation and date string with a comma separator
            return `${daysOfWeek[dayOfWeek]}, ${dateStr}`;
        },
        getBookingsForPenAndDay(penId, day) {
            // return an array of bookings for a given pen and day
            return this.bookings.filter(booking => {
                const bookingStartDate = new Date(booking.startDate);
                const bookingEndDate = new Date(booking.endDate);
                return booking.pens.id === penId &&
                    bookingStartDate <= day && bookingEndDate >= day;
            });
        },
        previousWeekButton() {
            // set the current day to 7 days ago
            this.currentDay = new Date(this.previousWeek);
        },
        nextWeekButton() {
            // set the current day to 7 days from now
            this.currentDay = new Date(this.nextWeek);
        }
    }
};
</script>
