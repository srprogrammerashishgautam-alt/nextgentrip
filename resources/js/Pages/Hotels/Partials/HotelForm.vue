<script setup>
defineProps({
    form: Object,
    statuses: Array,
    submitLabel: String,
})

defineEmits(['submit'])
</script>

<template>
    <form class="panel form-grid" @submit.prevent="$emit('submit')">
        <label>Hotel name<input v-model="form.hotel_name" type="text"><small class="field-error">{{ form.errors.hotel_name }}</small></label>
        <label>Slug<input v-model="form.hotel_slug" type="text"><small class="field-error">{{ form.errors.hotel_slug }}</small></label>
        <label>Email<input v-model="form.email" type="email"><small class="field-error">{{ form.errors.email }}</small></label>
        <label>Mobile<input v-model="form.mobile" type="text"><small class="field-error">{{ form.errors.mobile }}</small></label>
        <label class="span-2">Address<input v-model="form.address" type="text"><small class="field-error">{{ form.errors.address }}</small></label>
        <label>City<input v-model="form.city" type="text"><small class="field-error">{{ form.errors.city }}</small></label>
        <label>State<input v-model="form.state" type="text"><small class="field-error">{{ form.errors.state }}</small></label>
        <label>Country<input v-model="form.country" type="text"><small class="field-error">{{ form.errors.country }}</small></label>
        <label>Star rating<input v-model="form.star_rating" type="number" min="1" max="5"><small class="field-error">{{ form.errors.star_rating }}</small></label>
        <label>Latitude<input v-model="form.latitude" type="number" step="0.0000001"><small class="field-error">{{ form.errors.latitude }}</small></label>
        <label>Longitude<input v-model="form.longitude" type="number" step="0.0000001"><small class="field-error">{{ form.errors.longitude }}</small></label>
        <label>GST number<input v-model="form.gst_number" type="text"><small class="field-error">{{ form.errors.gst_number }}</small></label>
        <label>PAN number<input v-model="form.pan_number" type="text"><small class="field-error">{{ form.errors.pan_number }}</small></label>
        <label>Status<select v-model="form.status"><option v-for="status in statuses" :key="status" :value="status">{{ status }}</option></select><small class="field-error">{{ form.errors.status }}</small></label>
        <div class="span-2 form-actions">
            <button class="primary-btn action-fit" type="submit" :disabled="form.processing">{{ submitLabel }}</button>
        </div>
    </form>
</template>
