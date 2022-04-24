import { ref } from 'vue'

export default function usePlays() {
    const plays = ref({})

    const getPlays = async () => {
        axios.get('/api/movie-plays')
            .then(response => {
                plays.value = response.data.data;
            })
    }

    return { plays, getPlays }
}
