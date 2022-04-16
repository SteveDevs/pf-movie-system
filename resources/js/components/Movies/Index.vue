<template>
    <table>
        <tr v-for="movie in movies">
            <td>{{ movie.name }}</td>
        </tr>
    </table>
</template>
<script>
export default {
    data() {
        return {
            movies: []
        }
    },
    mounted() {
        this.fetchMovies()
    },
    methods: {
        fetchMovies() {
            axios.get('/api/movies')
                .then(response => this.movies = response.data)
                .catch( error => console.log(error))
        }
    }
}
</script>
