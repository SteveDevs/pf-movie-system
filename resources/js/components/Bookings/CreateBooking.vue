<template>
    <form @submit.prevent="submitForm">
        <!-- Movies -->
        <div class="mt-4">
            <label for="post-category" class="text-xl font-normal leading-normal mt-0 mb-2 text-green-800">
                {{movie.name}}
            </label>
            <select-2 v-model="movie.play_id" :options="plays" :settings="{ width: '50%' }"></select-2>
            <select-2 v-model="movie.no_tickets" :options="numbers" :settings="{ width: '50%' }"></select-2>
        </div>

        <!-- Buttons -->
        <div class="mt-4">
            <button :disabled="isLoading" class="inline-flex items-center px-3 py-2 bg-blue-600 text-white rounded disabled:opacity-75 disabled:cursor-not-allowed">
                <div v-show="isLoading" class="inline-block animate-spin w-4 h-4 mr-2 border-t-2 border-t-white border-r-2 border-r-white border-b-2 border-b-white border-l-2 border-l-blue-600 rounded-full"></div>
                <span v-if="isLoading">Processing...</span>
                <span v-else>Save Booking</span>
            </button>
        </div>
    </form>
</template>

<script>
import { onMounted, reactive, watchEffect } from "vue";
import useBookings from "../../composables/bookings";
import usePlays from "../../composables/plays";
import { useRoute } from "vue-router";

export default {
    setup() {
        const route = useRoute()

        const { plays, getPlaysByMovie } = usePlays()

        const { storeBooking } = useBookings()

        var numbers = [];
        for (var i = 1; i <= 30; i++) {
            numbers.push({
                id: i,
                text: i
            });
        }

        function submitForm() {
            storeBooking(movie.play_id, movie.no_tickets)
        }

        onMounted(() => {
            getPlaysByMovie(route.params.id)
        })

        const movie = reactive({
            id: route.params.id,
            name: route.params.name,
            play_id: '',
            no_tickets: 1
        })

        return {
            plays,
            movie,
            numbers,
            submitForm
        }
    }
}
</script>
