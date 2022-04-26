import { ref, inject } from 'vue'

export default function useMovies() {
    const movies  = ref({})

    const movie = ref({})
    const getMoviePlays = async (id) => {
        axios.get('/api/movies/bookings/' + id + '/create')
            .then(response => {
                movies.value = response.data.data;
            })
    }
    const getMovie = async (id) => {
        axios.get('/api/movies/bookings/' + id + '/create')
            .then(response => {
                movie.value = response.data.data;
            })
    }

    return { movie, movies, getMoviePlays, getMovie }
}
