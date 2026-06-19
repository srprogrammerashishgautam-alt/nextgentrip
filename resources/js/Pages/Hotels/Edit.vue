<script setup>
import { Link, useForm } from '@inertiajs/vue3'
import HotelForm from './Partials/HotelForm.vue'

const props = defineProps({ hotel: Object, statuses: Array })

const form = useForm({
    hotel_name: props.hotel.hotel_name || '',
    hotel_slug: props.hotel.hotel_slug || '',
    email: props.hotel.email || '',
    mobile: props.hotel.mobile || '',
    address: props.hotel.address || '',
    city: props.hotel.city || '',
    state: props.hotel.state || '',
    country: props.hotel.country || 'India',
    latitude: props.hotel.latitude || '',
    longitude: props.hotel.longitude || '',
    gst_number: props.hotel.gst_number || '',
    pan_number: props.hotel.pan_number || '',
    star_rating: props.hotel.star_rating || '',
    status: props.hotel.status || 'draft',
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
                <div><p class="eyebrow">Edit hotel</p><h1>{{ hotel.hotel_name }}</h1></div>
                <Link class="secondary-btn" :href="`/hotels/${hotel.id}`">Back</Link>
            </header>
            <HotelForm :form="form" :statuses="statuses" submit-label="Save changes" @submit="form.put(`/hotels/${hotel.id}`)" />
        </section>
    </main>
</template>
