import { ref, reactive } from 'vue'
import { useRouter } from "vue-router";

const user = reactive({
    name: '',
    email: '',
    password: '',
    password_confirmation: ''
})

export default function useRegister() {
    const processing = ref(false)
    const validationErrors = ref({})
    const router = useRouter()

    const registerForm = reactive({
        email: '',
        name: '',
        password: '',
        password_confirmation: ''
    })

    const submitRegister = async () => {
        if (processing.value) return

        processing.value = true
        validationErrors.value = {}

        axios.post('/register', registerForm)
            .then(async response => {
                await router.push({ name: 'login' })
            })
            .catch(error => {
                if (error.response?.data) {
                    validationErrors.value = error.response.data.errors
                }
            })
            .finally(() => processing.value = false)
    }

    return {
        user,
        registerForm,
        validationErrors,
        processing,
        submitRegister
    }
}
