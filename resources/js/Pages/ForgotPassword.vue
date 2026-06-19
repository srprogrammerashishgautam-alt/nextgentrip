<script setup>
import { Link, useForm } from '@inertiajs/vue3'

const props = defineProps({
    status: String,
    csrf_token: String,
})

const form = useForm({
    _token: props.csrf_token,
    email: '',
})

const submit = () => {
    form.post('/forgot-password', {
        preserveScroll: true,
    })
}
</script>

<template>
    <main class="auth-shell">
        <section class="auth-panel">
            <div class="brand-mark">N</div>
            <p class="eyebrow">Account recovery</p>
            <h1>Reset your password</h1>
            <p class="muted">Enter your email and we will send reset instructions when mail is configured.</p>

            <div v-if="props.status" class="alert alert-success">
                {{ props.status }}
            </div>

            <form class="form-stack" @submit.prevent="submit">
                <label>
                    Email
                    <input v-model="form.email" type="email" autocomplete="email" placeholder="owner@example.com" required>
                    <span v-if="form.errors.email" class="field-error">{{ form.errors.email }}</span>
                </label>

                <button class="primary-btn" type="submit" :disabled="form.processing">
                    {{ form.processing ? 'Sending...' : 'Send reset link' }}
                </button>
            </form>

            <p class="auth-switch">
                Remembered it?
                <Link href="/login">Back to login</Link>
            </p>
        </section>
    </main>
</template>
