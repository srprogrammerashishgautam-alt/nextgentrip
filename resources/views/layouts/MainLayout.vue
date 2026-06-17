<template>

<div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

        <div class="container">

            <a class="navbar-brand">
                NextGenTrip
            </a>

            <div>

                <Link href="/" class="btn btn-outline-light me-2">
                    Home
                </Link>

                <Link href="/login" class="btn btn-light me-2">
                    Login
                </Link>

                <Link href="/register" class="btn btn-success">
                    Register
                </Link>

            </div>

        </div>

    </nav>

    <slot />

</div>

</template>

<script setup>
import { Link } from '@inertiajs/vue3'
</script>