<template>
    <div class="row mb-4">
        <div class="col-lg-6 col-md-6 mb-2">
            <div class="form-group">
                <label>Rate</label><br />
                <input type="text" class="form-control" v-model="field.rate" />
                <InputError class="mt-2" :message="error?.rate" />
            </div>
        </div>
        <div class="col-lg-6 col-md-6 mb-2">
            <div class="form-group">
                <label>Condition</label><br />
                <select class="form-control" v-model="field.condition">
                    <option value="" disabled>Select One</option>
                    <option value="Normal">Normal</option>
                    <option value="Average">Average</option>
                    <option value="Critical">Critical</option>
                </select>
                <InputError class="mt-2" :message="error?.condition" />
            </div>
        </div>
    </div>
</template>

<script setup>
import { defineProps } from 'vue';
import InputError from "@/Components/InputError.vue";

// Define the props
const props = defineProps({
    field: Object,
    error: Object
});
</script>

<style scoped>
/* Add your styles here */
</style>
