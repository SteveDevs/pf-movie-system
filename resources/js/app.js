require('./bootstrap');

import {createApp, onMounted} from 'vue'
import router from './routes/index'
import VueSweetalert2 from "vue-sweetalert2";
import useAuth from "./composables/auth";
import Select2 from 'vue3-select2-component';


const app = createApp({
    setup() {
        const { getUser } = useAuth()
        onMounted(getUser)
    }
})
app.use(router)
app.use(VueSweetalert2)
app.component('Select2', Select2)
app.mount('#app')
