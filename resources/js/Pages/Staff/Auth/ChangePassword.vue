<script setup>
import StaffLayout from "@/Layouts/StaffLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import { ref } from 'vue';
import InputError from "@/Components/InputError.vue";

const toast = useToast();

const props = defineProps({
    currentUrl: String,
    title: {
        type: String,
        default: 'Staff Password Change'
    },
    user: Object,
});

const passwordForm = useForm({
    password: '',
});

const submitPassword = () => passwordForm.post(route('staff.change_password.update', props.user.id), {
    preserveScroll: true,
    onSuccess: () => {
        toast.success('Password Updated Successfully!');
        passwordForm.reset();
    }
});
</script>

<template>
    <StaffLayout :currentUrl="currentUrl" :title="title">
        <Head title="Staff Password Change" />
        <div class="main">
            <div class="main-content dashboard">
                <div class="row">
                    <div class="col-12">
                        <div class="box ">
                            <div class="box-header pt-0">
                                <div class="me-auto">
                                    <h4 class="card-title mb-0 fs-22">Staff Password Change</h4>
                                </div>
                            </div>
                            <div class="box-body pb-0 activity mt-18">
                                <form class="form" @submit.prevent="submitPassword">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 mb-2">
                                            <div class="form-group">
                                                <label>New Password</label><br>
                                                <input type="password" v-model="passwordForm.password" class="form-control">
                                                <InputError class="mt-2" :message="passwordForm.errors.password" />
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-4 col-12 mb-2">
                                            <div class="form-group">
                                                <div class="button">
                                                    <button type="submit" class="btn btn-primary">Update Password</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </StaffLayout>
</template>
