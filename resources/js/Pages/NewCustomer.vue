<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {useForm, Head} from '@inertiajs/inertia-vue3';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';


const form = useForm({
    firstName: '',
    lastName: '',
    houseNumberOrName: '',
    addressLine1: '',
    addressLine2: '',
    townCity: '',
    postCode: '',
    telephone: '',
    email: '',
    emergencyName: '',
    emergencyNumber: '',
});

</script>

<template>
    <Head title="NewCustomer"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add New Customer</h2>
        </template>

        <div class="py-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">

                <form @submit.prevent="form.post(route('addcustomer.store'), { onSuccess: () => form.reset() })">
                    <p>*Required Fields</p>
                    <br>
                    <textarea
                        v-model="form.firstName"
                        placeholder="First Name *"
                        class="w-full"
                        required
                    ></textarea>
                    <InputError :firstName="form.errors.firstName" class="mt-2"/>
                    <textarea
                        v-model="form.lastName"
                        placeholder="Last Name *"
                        class="w-full"
                        required
                    ></textarea>
                    <InputError :lastName="form.errors.lastName" class="mt-2"/>
                    <textarea
                        v-model="form.houseNumberOrName"
                        placeholder="House Name Or Number *"
                        class="w-full"
                        required
                    ></textarea>
                    <InputError :houseNumberOrName="form.errors.houseNumberOrName" class="mt-2"/>
                    <textarea
                        v-model="form.addressLine1"
                        placeholder="Address Line 1 *"
                        class="w-full"
                        required
                    ></textarea>
                    <InputError :addressLine1="form.errors.addressLine1" class="mt-2"/>
                    <textarea
                        v-model="form.addressLine2"
                        placeholder="Address Line 2"
                        class="w-full"
                    ></textarea>
                    <InputError :addressLine2="form.errors.addressLine2" class="mt-2"/>
                    <textarea
                        v-model="form.townCity"
                        placeholder="Town/City *"
                        class="w-full"
                        required
                    ></textarea>
                    <InputError :townCity="form.errors.townCity" class="mt-2"/>
                    <textarea
                        v-model="form.postCode"
                        placeholder="Postcode *"
                        class="w-full"
                        required
                    ></textarea>
                    <InputError :postCode="form.errors.postCode" class="mt-2"/>
                    <textarea
                        v-model="form.telephone"
                        placeholder="Telephone Number *"
                        class="w-full"
                        required
                    ></textarea>
                    <InputError :telephone="form.errors.telephone" class="mt-2"/>
                    <textarea
                        v-model="form.email"
                        placeholder="Email Address"
                        class="w-full"
                    ></textarea>
                    <InputError :email="form.errors.email" class="mt-2"/>
                    <textarea
                        v-model="form.emergencyName"
                        placeholder="Emergency Contact Name *"
                        class="w-full"
                        required
                    ></textarea>
                    <InputError :emergencyName="form.errors.emergencyName" class="mt-2"/>
                    <textarea
                        v-model="form.emergencyNumber"
                        placeholder="Emergency Contact Telephone Number *"
                        class="w-full"
                        required
                    ></textarea>
                    <InputError :emergencyNumber="form.errors.emergencyNumber" class="mt-2"/>
                    <PrimaryButton>Add Customer</PrimaryButton>
                </form>
            </div>
        </div>
        </div>

    </AuthenticatedLayout>
</template>

