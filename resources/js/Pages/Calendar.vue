<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/inertia-vue3';</script>
<template>
    <Head title="Calendar"/>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Calendar</h2>
        </template>

        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th v-for="day in days" :key="day" class="text-center border-2 p-2"
                                        style="vertical-align: middle; text-align: center;">{{ formatDate(day) }}
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="pens in pens" :key="pens.id">
                                    <td class="text-center font-weight-bold border-2"
                                        style="vertical-align: middle; text-align: center;">{{ pens.description }} {{ pens.penNumber }}
                                    </td>
                                    <td v-for="day in days" :key="day" class="text-center border-2"
                                        style="vertical-align: middle; text-align: center; min-width: 120px;">
                                        <ul class="list-unstyled" style="margin: 0; padding: 0; list-style: none; background-color: darkgreen">
                                            <li v-for="bookings in getBookingsForPenAndDay(pens.id, day)"
                                                :key="bookings.id" style="font-size: 14px; line-height: 1.5; background-color: lightblue">
                                                <span>{{ bookings.customer.firstName }}</span>
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
    computed: {
        days() {
            // generate an array of 7 days starting from today
            const days = [];
            let date = new Date();
            for (let i = 0; i < 7; i++) {
                days.push(new Date(date));
                date.setDate(date.getDate() + 1);
            }
            return days;
        }
    },
    methods: {
        formatDate(date) {
            // format a date object as "Day, Month Date"
            return date.toLocaleString('en-US', {weekday: 'long', month: 'short', day: 'numeric'});
        },
        getBookingsForPenAndDay(penId, day) {
            // return an array of bookings for a given pen and day
            return this.bookings.filter(booking => {
                const bookingStartDate = new Date(booking.startDate);
                const bookingEndDate = new Date(booking.endDate);
                return booking.pens.id === penId &&
                    bookingStartDate <= day && bookingEndDate >= day;
            });
        }
    }
};
</script>

