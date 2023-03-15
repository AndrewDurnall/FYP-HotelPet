<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/inertia-vue3';
</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Welcome To {{
                    $page.props.auth.user.name
                }}</h2>
        </template>

        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">

                        <div>
                            <!--Showing todays date-->
                            <div class="p-4 bg-white rounded-lg shadow border-2 mb-4">
                                <h2 class="text-xl font-semibold mb-2">Today's Date:</h2>
                                <div class="text-gray-600 text-3xl">{{ date }}</div>
                            </div>
                            <!--Showing the number of registered pens to the company-->
                            <div class="p-4 bg-white rounded-lg shadow border-2 mb-4">
                                <h2 class="text-xl font-semibold mb-2">Registered Pens:</h2>
                                <div class="text-gray-600 text-3xl">{{ pensCount }}</div>
                            </div>
                            <!--Showing the number of registered pens to the company that are currently in use-->
                            <div class="p-4 bg-white rounded-lg shadow border-2 mb-4">
                                <h2 class="text-xl font-semibold mb-2">Pens In Use Today:</h2>
                                <div class="text-gray-600 text-3xl">{{ pensInUse }}</div>
                            </div>
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
        // using the pens count as a number passed from the dashboard controller
        pensCount: {
            type: Number,
            required: true,
        },
        // using the pens in use count as a number passed from the dashboard controller
        pensInUse: {
            type: Number,
            required: true,
        },

        // using the current date as a string passed from the dashboard controller
        date: {
            type: String,
            required: true,
        }
    },

};
</script>
