<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Welcome" />

    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0"
    >

        <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="text-sm text-gray-700 dark:text-gray-500 underline"
                >Dashboard</Link
            >

            <template v-else>


            </template>
        </div>

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <ApplicationLogo
                class="block h-150 w-auto fill-current text-gray-800"
            />

            <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                <h1 class="text-5xl center">Welcome to HotelPet</h1>
            </div>

            <div class="mt-8 flex justify-center ">
                <h1 class="text-3xl">Please <Link :href="route('login')" class=" text-gray-700 dark:text-gray-500 underline">Log in</Link></h1>
            </div>


        </div>
    </div>
</template>
