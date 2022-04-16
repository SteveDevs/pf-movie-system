require('./bootstrap');

import { createApp } from "vue"
import MovieIndex from './components/Movies/Index'

const app = createApp({})
app.component('movies-index', MovieIndex)
app.mount('#app')
