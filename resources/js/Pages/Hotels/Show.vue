<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
    hotel: Object,
    roomTypes: Array,
    ratePlans: Array,
    inventory: Array,
    bookings: Array,
})
</script>

<template>
    <main class="dashboard-shell">
        <aside class="sidebar">
            <Link class="brand" href="/dashboard">NextGenTrip</Link>
            <nav>
                <Link href="/dashboard">Overview</Link>
                <Link class="active" href="/hotels">Hotels</Link>
            </nav>
        </aside>
        <section class="dashboard-main">
            <header class="dashboard-header">
                <div><p class="eyebrow">Hotel profile</p><h1>{{ hotel.hotel_name }}</h1></div>
                <div class="nav-actions">
                    <Link class="secondary-btn" href="/hotels">Back</Link>
                    <Link class="primary-btn action-fit" :href="`/hotels/${hotel.id}/edit`">Edit</Link>
                </div>
            </header>

            <section class="metric-grid">
                <article class="metric-card"><span>Status</span><strong>{{ hotel.status }}</strong></article>
                <article class="metric-card"><span>Rooms</span><strong>{{ roomTypes.length }}</strong></article>
                <article class="metric-card"><span>Rates</span><strong>{{ ratePlans.length }}</strong></article>
                <article class="metric-card"><span>Bookings</span><strong>{{ bookings.length }}</strong></article>
            </section>

            <section class="work-grid">
                <article class="panel">
                    <h2>Property details</h2>
                    <div class="detail-grid">
                        <span>Email</span><strong>{{ hotel.email || '-' }}</strong>
                        <span>Mobile</span><strong>{{ hotel.mobile || '-' }}</strong>
                        <span>City</span><strong>{{ hotel.city || '-' }}</strong>
                        <span>GST</span><strong>{{ hotel.gst_number || '-' }}</strong>
                    </div>
                </article>
                <article class="panel">
                    <h2>Latest bookings</h2>
                    <div class="task-list">
                        <div v-for="booking in bookings" :key="booking.id" class="task-row">
                            <span>{{ booking.booking_reference }}</span><strong>{{ booking.status }}</strong>
                        </div>
                        <p v-if="!bookings.length" class="muted">No bookings yet.</p>
                    </div>
                </article>
            </section>
        </section>
    </main>
</template>
