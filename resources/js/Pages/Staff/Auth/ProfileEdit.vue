<script setup>
import StaffLayout from "@/Layouts/StaffLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import { ref } from 'vue';

const toast = useToast();

const props = defineProps({
    currentUrl: String,
    title: {
        type: String,
        default: 'Staff Profile Edit'
    },
    user: Object,
});

const getImageUrl = (imagePath) => {
    return `${props.currentUrl.replace('/profile/edit', '')}/${imagePath}`;
};

const userForm = useForm({
    name: props.user.name,
    phone: props.user.phone,
    profile_photo_path: '',
});

const imagePreview = ref(props.user.profile_photo_path ? getImageUrl(props.user.profile_photo_path) : '/upload/no_img.jpg');

const handleImageChange = (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            imagePreview.value = e.target.result;
        };
        reader.readAsDataURL(file);
        userForm.profile_photo_path = file;
    }
};

const submitProfile = () => userForm.post(route('staff.profile_update', props.user.id), {
    preserveScroll: true,
    onSuccess: () => {
        toast.success('Profile Updated Successfully!');
        userForm.reset();
        imagePreview.value = '/upload/no_img.jpg';
    }
});
</script>

<template>
    <StaffLayout :currentUrl="currentUrl" :title="title">
        <Head title="New Patients" />
        <div class="main">
            <div class="main-content dashboard">
                <div class="row">
                    <div class="col-12">
                        <div class="box ">
                            <div class="box-header pt-0">
                                <div class="me-auto">
                                    <h4 class="card-title mb-0 fs-22">User Profile Update</h4>
                                </div>
                            </div>
                            <div class="box-body pb-0 activity mt-18">
                                <form class="form" @submit.prevent="submitProfile">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 mb-2">
                                            <div class="form-group">
                                                <label>Staff Name</label><br>
                                                <input type="text" v-model="userForm.name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 mb-2">
                                            <div class="form-group">
                                                <label>Staff Phone</label><br>
                                                <input type="text" v-model="userForm.phone" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 mb-2">
                                            <div class="form-group">
                                                <label>Staff Profile Image</label><br>
                                                <input type="file" @change="handleImageChange" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 mb-2">
                                            <img :src="imagePreview" style="height: 110px" alt="Profile Image">
                                        </div>
                                        <div class="col-lg-5 col-md-4 col-12 mb-2">
                                            <div class="form-group">
                                                <div class="button">
                                                    <button type="submit" class="btn btn-primary">Update Profile</button>
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
