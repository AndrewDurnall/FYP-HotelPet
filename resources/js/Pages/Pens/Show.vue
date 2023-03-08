<script>
import { usePage } from '@inertiajs/inertia-vue3';

export default {
    props: {
        pens: Object,
        bookings: Array,
    },
};
</script>

<template>
    <div>
        <h1>{{ pens.penName }}</h1>

        <div class="row">
            <div class="col-md-6">
                <h2>Available Dates</h2>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Start Date</th>
                        <th>End Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-if="bookings.length === 0">
                        <td colspan="2">No bookings found.</td>
                    </tr>
                    <tr v-for="booking in bookings" :key="booking.id">
                        <td>{{ booking.startDate }}</td>
                        <td>{{ booking.endDate }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>


