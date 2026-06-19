<script setup>
import { Link, useForm } from '@inertiajs/vue3'
import HotelForm from './Partials/HotelForm.vue'

defineProps({ statuses: Array })

const form = useForm({
    hotel_name: '',
    hotel_slug: '',
    email: '',
    mobile: '',
    address: '',
    city: '',
    state: '',
    country: 'India',
    latitude: '',
    longitude: '',
    gst_number: '',
    pan_number: '',
    star_rating: '',
    status: 'draft',
})
</script>

<template>
    <main class="dashboard-shell">
        <aside class="sidebar">
            <Link class="brand" href="/dashboard">NextGenTrip</Link>
            <nav><Link class="active" href="/hotels">Hotels</Link></nav>
        </aside>
        <section class="dashboard-main">
            <header class="dashboard-header">
                <div><p class="eyebrow">Create hotel</p><h1>Add hotel</h1></div>
                <Link class="secondary-btn" href="/hotels">Back</Link>
            </header>
            <HotelForm :form="form" :statuses="statuses" submit-label="Create hotel" @submit="form.post('/hotels')" />
        </section>
    </main>
</template>
