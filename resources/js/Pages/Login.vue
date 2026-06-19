<script setup>
import { Link, useForm } from '@inertiajs/vue3'

const props = defineProps({
    status: String,
    csrf_token: String,
})

const form = useForm({
    _token: props.csrf_token,
    email: '',
    password: '',
    remember: false,
})

const submit = () => {
    form.post('/login', {
        preserveScroll: true,
    })
}
</script>

<template>
    <main class="auth-shell">
        <section class="auth-panel">
            <div class="brand-mark">N</div>
            <p class="eyebrow">Partner access</p>
            <h1>Sign in to NextGenTrip</h1>
            <p class="muted">Manage onboarding, rates, inventory, bookings, and channel sync from one workspace.</p>

            <div v-if="props.status" class="alert alert-success">
                {{ props.status }}
            </div>

            <form class="form-stack" @submit.prevent="submit">
                <label>
                    Email
                    <input v-model="form.email" type="email" autocomplete="email" placeholder="owner@example.com" required>
                    <span v-if="form.errors.email" class="field-error">{{ form.errors.email }}</span>
                </label>

                <label>
                    Password
                    <input v-model="form.password" type="password" autocomplete="current-password" placeholder="Enter password" required>
                    <span v-if="form.errors.password" class="field-error">{{ form.errors.password }}</span>
                </label>

                <div class="form-row">
                    <label class="check-label">
                        <input v-model="form.remember" type="checkbox">
                        Remember me
                    </label>
                    <Link href="/forgot-password">Forgot password?</Link>
                </div>

                <button class="primary-btn" type="submit" :disabled="form.processing">
                    {{ form.processing ? 'Signing in...' : 'Login' }}
                </button>
            </form>

            <p class="auth-switch">
                New hotel partner?
                <Link href="/register">Create an account</Link>
            </p>
        </section>
    </main>
</template>
