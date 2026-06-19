<script setup>
import { Link, router } from '@inertiajs/vue3'

const props = defineProps({
    user: Object,
    metrics: {
        type: Object,
        default: () => ({ hotels: 0, onboarding: 0, bookings: 0, revenue: 0 }),
    },
    tasks: {
        type: Array,
        default: () => [],
    },
})

const logout = () => {
    router.post('/logout')
}
</script>

<template>
    <main class="dashboard-shell">
        <aside class="sidebar">
            <Link class="brand" href="/">NextGenTrip</Link>
            <nav>
                <a class="active" href="#">Overview</a>
                <Link href="/hotels">Hotels</Link>
                <a href="#">Onboarding</a>
                <a href="#">Inventory</a>
                <a href="#">Channels</a>
            </nav>
        </aside>

        <section class="dashboard-main">
            <header class="dashboard-header">
                <div>
                    <p class="eyebrow">Partner dashboard</p>
                    <h1>Welcome{{ props.user?.name ? `, ${props.user.name}` : '' }}</h1>
                </div>
                <button class="secondary-btn" type="button" @click="logout">Logout</button>
            </header>

            <section class="metric-grid">
                <article class="metric-card">
                    <span>Total hotels</span>
                    <strong>{{ props.metrics.hotels }}</strong>
                </article>
                <article class="metric-card">
                    <span>Onboarding sessions</span>
                    <strong>{{ props.metrics.onboarding }}</strong>
                </article>
                <article class="metric-card">
                    <span>Bookings</span>
                    <strong>{{ props.metrics.bookings }}</strong>
                </article>
                <article class="metric-card">
                    <span>Revenue</span>
                    <strong>Rs {{ props.metrics.revenue }}</strong>
                </article>
            </section>

            <section class="work-grid">
                <article class="panel">
                    <h2>Next setup tasks</h2>
                    <div class="task-list">
                        <div v-for="task in props.tasks" :key="task.label" class="task-row">
                            <span>{{ task.label }}</span>
                            <strong>{{ task.status }}</strong>
                        </div>
                    </div>
                </article>

                <article class="panel">
                    <h2>Go-live readiness</h2>
                    <div class="readiness">
                        <strong>0%</strong>
                        <span>Complete profile, KYC, contract, rooms, rates, and first channel mapping to activate.</span>
                    </div>
                </article>
            </section>
        </section>
    </main>
</template>
