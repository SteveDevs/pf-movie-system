<template>

        <div v-for="cinemaPlay in cinemaPlays" >

            <h4 class='font-bold text-3xl'>{{cinemaPlay.name}}</h4>
            <h3 class="text-lg">Playing:</h3>
            <div class="divide-y" v-for="movie in cinemaPlay.movies">
                <h6 class="text-xl font-normal leading-normal mt-0 mb-2 text-green-800">{{movie.movie_name}}</h6>
                <div v-for="play in movie.plays">
                    <div class="inline-block mr-4">Start Time: {{play.start_time}}<br>
                        End Time: {{play.end_time}}</div>

                    <router-link :to="{ name: 'bookings.create', params: { id: movie.id, name: movie.movie_name }}" class="inline-block bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded mb-4">
                        Book
                    </router-link>
                </div>

            </div>
        </div>

</template>
<script>
import { useRouter } from "vue-router";

export default {
    data() {
        return {
            cinemaPlays: []
        }
    },
    mounted() {
        this.fetchPlays()
    },
    methods: {
        fetchPlays() {
            axios.get('/api/movie-plays')
                .then(response => this.cinemaPlays = response.data.data)
                .catch( error => console.log(error))
        }
    }
}
</script>
