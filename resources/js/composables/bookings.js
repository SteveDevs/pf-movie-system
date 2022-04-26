import { ref, inject } from 'vue'
import { useRouter } from 'vue-router'

export default function usePosts() {
    const bookings = ref({})
    const booking = ref({
        booking_id: '',
    })
    const router = useRouter()
    const validationErrors = ref({})
    const isLoading = ref(false)
    const swal = inject('$swal')

    const getBookings = async () => {
        axios.get('/api/bookings')
            .then(response => {
                bookings.value = response.data;
            })
    }

    /*const getBooking = async (id) => {
        axios.get('/api/posts/' + id)
            .then(response => {
                post.value = response.data.data;
            })
    }*/

    const storeBooking = async (play_id) => {
        if (isLoading.value) return;

        isLoading.value = true
        if (JSON.parse(localStorage.getItem('loggedIn'))) {
            const userEmail = localStorage.getItem('email');
            axios.post('/api/bookings/store', {email: userEmail, play_id: play_id})
                .then(response => {
                    router.push({name: 'users.user.bookings.index'})
                    swal({
                        icon: 'success',
                        title: 'Booking saved successfully'
                    })
                })
                .catch(error => {
                    if (error.response?.data) {
                        validationErrors.value = error.response.data.errors
                    }
                })
                .finally(() => isLoading.value = false)
        }

    }

    const cancelBooking = async (id) => {
        swal({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this action!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, cancel it!',
            confirmButtonColor: '#ef4444',
            timer: 20000,
            timerProgressBar: true,
            reverseButtons: true
        })
            .then(result => {
                if (result.isConfirmed) {
                    axios.delete('/api/bookings/cancel' + id)
                        .then(response => {
                            router.push({name: 'bookings.index'})
                            swal({
                                icon: 'success',
                                title: 'Booking cancelled successfully'
                            })
                        })
                        .catch(error => {
                            swal({
                                icon: 'error',
                                title: 'Something went wrong'
                            })
                        })
                }
            })
    }

    return {
        bookings,
        getBookings,
        storeBooking,
        cancelBooking,
        validationErrors,
        isLoading
    }
}
