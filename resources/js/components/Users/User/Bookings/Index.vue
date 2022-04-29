<template>
    <div v-for="booking in bookings">
            <h4 class='font-bold text-3xl'>{{booking.movie_name}}</h4>
            <h3 class="text-lg">Start At: {{booking.start_time}}</h3>
            <h3 class="text-lg">End At: {{booking.end_time}}</h3>
            <h3 class="text-lg">No of tickets: {{booking.no_tickets}}</h3>
        <h3 class="text-lg">Ref: {{booking.unique_ref}}</h3>
        <button @click="cancel(booking.id )" class="inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150 ml-4" :class="{ 'opacity-25': processing }" :disabled="processing">
            Cancel
        </button>

    </div>
</template>
<script>
import useBookings from "../../../../composables/bookings";

import { onMounted } from "vue";

export default {
    setup() {

        const { bookings, getBookings, cancelBooking } = useBookings()

        function cancel(bookingId) {
            cancelBooking(bookingId)
        }

        onMounted(() => {
            getBookings()
        })

        return {
            bookings,
            cancel
        }
    }
}
</script>
