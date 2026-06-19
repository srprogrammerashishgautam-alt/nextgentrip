<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
    stats: {
        type: Array,
        default: () => [],
    },
})
</script>

<template>
    <main class="site-shell">
        <nav class="top-nav">
            <Link class="brand" href="/">NextGenTrip</Link>
            <div class="nav-actions">
                <Link href="/login">Login</Link>
                <Link class="nav-button" href="/register">Register</Link>
            </div>
        </nav>

        <section class="home-hero">
            <div>
                <p class="eyebrow">AI-first hotel extranet</p>
                <h1>Automated hotel onboarding, CRS, rates, inventory, and channel operations.</h1>
                <p class="hero-copy">NextGenTrip helps hotel partners move from discovery to go-live with automated KYC, AI content, room setup, rate loading, and OTA channel mapping.</p>
                <div class="hero-actions">
                    <Link class="primary-btn" href="/register">Start onboarding</Link>
                    <Link class="secondary-btn" href="/login">Partner login</Link>
                </div>
            </div>

            <div class="hero-board">
                <div class="board-row">
                    <span>Onboarding</span>
                    <strong>9 steps</strong>
                </div>
                <div class="board-row">
                    <span>KYC/OCR</span>
                    <strong>AI assisted</strong>
                </div>
                <div class="board-row">
                    <span>Channel sync</span>
                    <strong>Real time</strong>
                </div>
            </div>
        </section>

        <section class="stats-grid">
            <article v-for="item in stats" :key="item.label" class="stat-card">
                <strong>{{ item.value }}</strong>
                <span>{{ item.label }}</span>
            </article>
        </section>
    </main>
</template>
