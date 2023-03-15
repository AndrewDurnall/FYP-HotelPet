<!-- resources/js/Pages/Users/Edit.vue -->
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/inertia-vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
</script>

<template>
    <Head title="Create Pen"/>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create New Pen</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <p>*Required Fields</p>
                    <!-- when the form is submitted the data is passed to the database via the pens controller and store function and the form resets -->
                    <form @submit.prevent="form.post(route('pens.store'), { onSuccess: () => form.reset() })">

                        <label>Pen Number *:</label>
                        <br>
                        <input class="w-full" type="text" v-model="form.penNumber" required/>
                        <br>
                        <label>Pen Description *:</label>
                        <br>
                        <input class="w-full" type="text" v-model="form.description" required/>
                        <br>
                        <PrimaryButton type="submit">Create Pen</PrimaryButton>

                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import {Inertia} from '@inertiajs/inertia';
import {useForm} from "@inertiajs/inertia-vue3";


// creating a form object for the use of passing the data forward.
const form = useForm({
    penNumber: '',
    description: '',
});

</script>
