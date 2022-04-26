import { ref } from 'vue'

export default function usePlays() {
    const plays = ref({})
    const play = ref({})

    const getPlays = async () => {
        axios.get('/api/movie-plays')
            .then(response => {
                plays.value = response.data.data;
            })
    }

    const getPlay = async () => {
        axios.get('/api/plays/play')
            .then(response => {
                play.value = response.data.data;
            })
    }

    const getPlaysByMovie = async (movieId) => {
        axios.get('/api/movies/' + movieId + '/plays')
            .then(response => {
                plays.value = response.data.data;
            })
    }

    return { plays, play, getPlays, getPlay, getPlaysByMovie }
}
