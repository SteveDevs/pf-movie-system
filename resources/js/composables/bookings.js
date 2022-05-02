import { ref, inject } from 'vue'
import { useRouter } from 'vue-router'

export default function usePosts() {
    const bookings = ref({})
    const booking = ref({
        id: '',
    })
    const router = useRouter()
    const validationErrors = ref({})
    const isLoading = ref(false)
    const swal = inject('$swal')

    const getBookings = async () => {
        axios.get('/api/bookings')
            .then(response => {
                bookings.value = response.data.data;
            })
    }

    /*const getBooking = async (id) => {
        axios.get('/api/posts/' + id)
            .then(response => {
                post.value = response.data.data;
            })
    }*/

    const storeBooking = async (play_id, no_tickets) => {
        if (isLoading.value) return;

        isLoading.value = true
        if (JSON.parse(localStorage.getItem('loggedIn'))) {
            axios.post('/api/bookings/store', {no_tickets: no_tickets, play_id: play_id})
                .then(response => {
                    router.push({name: 'users.user.bookings'})
                })
                .catch(error => {
                    if (error.response?.data) {
                        validationErrors.value = error.response.data.errors
                    }
                })
                .finally(() => isLoading.value = false)
        }

    }

    const cancelBooking = async (bookingId) => {
        axios.post('/api/bookings/cancel', { id: bookingId})
            .then(response => {
                window.location.reload()
            })
            .catch(error => {
                alert(error.response)
                console.log(error)
            })
    }

    return {
        bookings,
        booking,
        getBookings,
        storeBooking,
        cancelBooking,
        validationErrors,
        isLoading
    }
}
