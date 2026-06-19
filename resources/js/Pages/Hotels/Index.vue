<script setup>
import { Link, router } from '@inertiajs/vue3'
import { ref, watch } from 'vue'

const props = defineProps({
    hotels: Object,
    summary: Object,
    filters: Object,
})

const search = ref(props.filters?.search || '')

watch(search, value => {
    router.get('/hotels', { search: value }, { preserveState: true, replace: true })
})

const remove = hotel => {
    if (confirm(`Archive ${hotel.hotel_name}?`)) {
        router.delete(`/hotels/${hotel.id}`)
    }
}
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
                <div>
                    <p class="eyebrow">Hotel module</p>
                    <h1>Hotels</h1>
                </div>
                <Link class="primary-btn action-fit" href="/hotels/create">Add hotel</Link>
            </header>

            <section class="metric-grid">
                <article class="metric-card"><span>Total</span><strong>{{ summary.total }}</strong></article>
                <article class="metric-card"><span>Active</span><strong>{{ summary.active }}</strong></article>
                <article class="metric-card"><span>Draft</span><strong>{{ summary.draft }}</strong></article>
                <article class="metric-card"><span>Inactive</span><strong>{{ summary.inactive }}</strong></article>
            </section>

            <section class="panel table-panel">
                <div class="table-toolbar">
                    <input v-model="search" type="search" placeholder="Search hotels">
                </div>
                <div class="data-table">
                    <div class="table-row table-head">
                        <span>Hotel</span><span>City</span><span>Status</span><span>Rating</span><span></span>
                    </div>
                    <div v-for="hotel in hotels.data" :key="hotel.id" class="table-row">
                        <span><strong>{{ hotel.hotel_name }}</strong><small>{{ hotel.email || 'No email' }}</small></span>
                        <span>{{ hotel.city || '-' }}</span>
                        <span><em class="status-pill">{{ hotel.status }}</em></span>
                        <span>{{ hotel.star_rating || '-' }}</span>
                        <span class="row-actions">
                            <Link :href="`/hotels/${hotel.id}`">View</Link>
                            <Link :href="`/hotels/${hotel.id}/edit`">Edit</Link>
                            <button type="button" @click="remove(hotel)">Archive</button>
                        </span>
                    </div>
                </div>
            </section>
        </section>
    </main>
</template>
