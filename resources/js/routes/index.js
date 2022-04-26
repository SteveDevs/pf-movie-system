import { createRouter, createWebHistory } from "vue-router";

import AuthenticatedLayout from "../layouts/Authenticated";
import GuestLayout from "../layouts/Guest";

import PlaysIndex from '../components/Plays/Index'
import UserBookingsIndex from '../components/Users/User/Bookings/Index'
import Login from '../components/Login'
import Register from '../components/Register'
import CreateBooking from '../components/Bookings/CreateBooking';

function auth(to, from, next) {
    if (JSON.parse(localStorage.getItem('loggedIn'))) {
        next()
    }

    next('/login')
}

const routes = [
    {
        path: '/',
        redirect: { name: 'login' },
        component: GuestLayout,
        children: [
            {
                path: '/login',
                name: 'login',
                component: Login
            },
        ]
    },
    {
        path: '/register',
        redirect: { name: 'register' },
        component: GuestLayout,
        children: [
            {
                path: '/register',
                name: 'register',
                component: Register
            },
        ]
    },
    {
        path: '/plays',
        component: GuestLayout,
        children: [
            {
                path: '/plays',
                name: 'plays',
                component: PlaysIndex
            },
        ]
    },
    {
        path: '/bookings/create/:id?:name',
        name: 'bookings.create',
        component: CreateBooking,
        meta: { title: 'Create Booking' }
    },
    {
        component: AuthenticatedLayout,
        beforeEnter: auth,
        children: [
            {
                path: '/users/user/bookings',
                name: 'users.user.bookings',
                component: UserBookingsIndex,
                meta: { title: 'Bookings' }
            }
        ]
    }
]

export default createRouter({
    history: createWebHistory(),
    routes
})
