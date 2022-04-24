<template>
    <table>
        <tr v-for="play in plays">
            <td>{{ play.name }}</td>
        </tr>
    </table>
</template>
<script>
export default {
    data() {
        return {
            plays: []
        }
    },
    mounted() {
        this.fetchPlays()
    },
    methods: {
        fetchPlays() {
            axios.get('/api/movie-plays')
                .then(response => this.plays = response.data)
                .catch( error => console.log(error))
        }
    }
}
</script>
