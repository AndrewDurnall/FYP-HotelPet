<template>

</template>

<script>
export default {
    name: "availability"
}

export function checkAvailability(startDate, endDate, bookings) {

        const startDate = this.form.startDate;

        const endDate = this.form.endDate;

        axios.get('/bookings/check', {
            params: {
                startDate: startDate,
                endDate: endDate
            }
        })
            .then(response => {
                this.availability = response.data.available;
                this.pens = response.data.pens;
            })
            .catch(error => {
                console.error()

            });

}
</script>

<style scoped>

</style>
