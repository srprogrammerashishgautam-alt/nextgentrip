<script setup>
import { Link, useForm } from '@inertiajs/vue3'

const props = defineProps({
    csrf_token: String,
})

const form = useForm({
    _token: props.csrf_token,
    name: '',
    email: '',
    mobile: '',
    property_type: 'Hotel',
    password: '',
    password_confirmation: '',
})

const submit = () => {
    form.post('/register', {
        preserveScroll: true,
    })
}
</script>

<template>
    <main class="auth-shell">
        <section class="auth-panel wide">
            <div class="brand-mark">N</div>
            <p class="eyebrow">Hotel onboarding</p>
            <h1>Create partner account</h1>
            <p class="muted">Start the zero-touch onboarding flow for your property.</p>

            <form class="form-grid" @submit.prevent="submit">
                <label>
                    Full name
                    <input v-model="form.name" type="text" autocomplete="name" placeholder="Ashish Gautam" required>
                    <span v-if="form.errors.name" class="field-error">{{ form.errors.name }}</span>
                </label>

                <label>
                    Email
                    <input v-model="form.email" type="email" autocomplete="email" placeholder="owner@example.com" required>
                    <span v-if="form.errors.email" class="field-error">{{ form.errors.email }}</span>
                </label>

                <label>
                    Mobile
                    <input v-model="form.mobile" type="tel" autocomplete="tel" placeholder="+91 9876543210">
                    <span v-if="form.errors.mobile" class="field-error">{{ form.errors.mobile }}</span>
                </label>

                <label>
                    Property type
                    <select v-model="form.property_type">
                        <option>Hotel</option>
                        <option>Resort</option>
                        <option>Villa</option>
                        <option>Apartment</option>
                        <option>Homestay</option>
                    </select>
                    <span v-if="form.errors.property_type" class="field-error">{{ form.errors.property_type }}</span>
                </label>

                <label>
                    Password
                    <input v-model="form.password" type="password" autocomplete="new-password" placeholder="Minimum 8 characters" required>
                    <span v-if="form.errors.password" class="field-error">{{ form.errors.password }}</span>
                </label>

                <label>
                    Confirm password
                    <input v-model="form.password_confirmation" type="password" autocomplete="new-password" placeholder="Repeat password" required>
                    <span v-if="form.errors.password_confirmation" class="field-error">{{ form.errors.password_confirmation }}</span>
                </label>

                <button class="primary-btn span-2" type="submit" :disabled="form.processing">
                    {{ form.processing ? 'Creating account...' : 'Register' }}
                </button>
            </form>

            <p class="auth-switch">
                Already registered?
                <Link href="/login">Login</Link>
            </p>
        </section>
    </main>
</template>
