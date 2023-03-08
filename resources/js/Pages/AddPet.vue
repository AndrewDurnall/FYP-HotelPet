<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {useForm, Head} from '@inertiajs/inertia-vue3';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const form = useForm({
    customer_id:'',
    petName: '',
    petAge: '',
    species: '',
    breed: '',
    vetName: '',
    vetNumber: '',
    microChip: '',
    vaccinationDate: '',
    feedingRequirements:'',
    avoidedFood:'',
    medicationDetails:'',
});
</script>

<template>
    <Head title="AddPet"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add New Pet</h2>
        </template>

                <div class="py-5">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <p>*Required Fields</p>
                            <br>
                <form @submit.prevent="form.post(route('pets.store'), { onSuccess: () => form.reset() })">
                    <label for="selection_customer">Select A Customer*</label>
                    <select id="selection_customer" v-model="form.customer_id" class="w-full" required>
                        <option v-for="customer in customers" :value="customer.id" >{{ customer.firstName + " " + customer.lastName + " - " + customer.addressLine1}}</option>
                    </select>
                    <br>
                    <br>
                    <input placeholder="Pet's Name *" required class="w-full" type="text" v-model="form.petName" />
                    <br>
                    <br>
                    <input placeholder="Pet's Age" class="w-full" type="number" v-model="form.petAge" />
                    <br>
                    <br>
                    <input placeholder="Species (Dog,Cat etc.) *" required class="w-full" type="text" v-model="form.species" />
                    <br>
                    <br>
                    <input placeholder="Breed *" required class="w-full" type="text" v-model="form.breed" />
                    <br>
                    <br>
                    <input placeholder="Registered Vet's Name *" required class="w-full" type="text" v-model="form.vetName" />
                    <br>
                    <br>
                    <input placeholder="Registered Vet's Phone Number *" required class="w-full" type="text" v-model="form.vetNumber" />
                    <br>
                    <br>
                    <input placeholder="Microchip Number" class="w-full" type="text" v-model="form.microChip" />
                    <br>
                    <br>
                    <input placeholder="Vaccinations Renewal Date *" required class="w-full" type="date" v-model="form.vaccinationDate" />
                    <br>
                    <br>
                    <input placeholder="Special Feeding Requirements (If needed)" class="w-full" type="text" v-model="form.feedingRequirements" />
                    <br>
                    <br>
                    <input placeholder="Avoided Food (If needed)" class="w-full" type="text" v-model="form.avoidedFood" />
                    <br>
                    <br>
                    <input placeholder="Medication Details (If needed)" class="w-full" type="text" v-model="form.medicationDetails" />
                    <br>
                    <br>
                    <PrimaryButton type="submit">Add Pet</PrimaryButton>

                </form>
            </div>
                    </div>
                </div>


    </AuthenticatedLayout>
</template>
    <script>
        import { Inertia } from '@inertiajs/inertia'

        export default {
            props: {
                customers: Array,
            },

        }

    </script>



