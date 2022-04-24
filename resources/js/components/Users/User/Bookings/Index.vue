<template>
    <table>
        <tr v-for="booking in bookings">
            <td>{{ booking.name }}</td>
        </tr>
    </table>
</template>
<script>
export default {
    data() {
        return {
            bookings: []
        }
    },
    mounted() {
        this.fetchBookings()
    },
    methods: {
        fetchBookings() {
            axios.get('/api/bookings')
                .then(response => this.bookings = response.data)
                .catch( error => console.log(error))
        }
    }
}
</script>
