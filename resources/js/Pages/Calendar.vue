<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Calendar</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">Calendar!</div>
                </div>
            </div>
        </div>

        <div>
            <div id="calendar"></div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import { defineComponent, onMounted, ref } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';


export default defineComponent({
    components: { AuthenticatedLayout },
    setup() {
        const page = usePage();
        const bookings = ref(page.props.resources);

        onMounted(() => {
            const calendarEl = document.getElementById('calendar');
            const calendar = new Calendar(calendarEl, {
                plugins: [dayGridPlugin, timeGridPlugin, resourceDayGridPlugin, interactionPlugin],
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                initialView: 'timeGridWeek',
                editable: false,
                allDaySlot: false,
                slotDuration: '00:30:00',
                slotLabelInterval: '01:00',
                slotLabelFormat: {
                    hour: 'numeric',
                    minute: '2-digit',
                    omitZeroMinute: false,
                    meridiem: 'short'
                },
                resources: bookings.value.map(resource => ({
                    id: resource.id,
                    title: resource.customer.firstName
                })),
                events: (() => {
                    const events = [];
                    for (let i = 0; i < bookings.value.length; i++) {
                        const resource = bookings.value[i];
                        for (let j = 0; j < resource.events.length; j++) {
                            const event = resource.events[j];
                            events.push({
                                ...event,
                                title: resource.customer.firstName,
                                resourceId: resource.id,
                            });
                        }
                    }
                    return events;
                })(),
                views: {
                    resourceTimeGridDay: {
                        type: 'resourceTimeGrid',
                        duration: { days: 1 },
                    },
                    resourceTimeGridWeek: {
                        type: 'resourceTimeGrid',
                        duration: { weeks: 1 },
                    }
                }
            });
            calendar.render();
        });

        return {
            bookings,
        }
    }
});
</script>
