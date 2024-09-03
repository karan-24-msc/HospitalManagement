<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";
import {Head} from "@inertiajs/vue3";
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import {ref} from "vue";

const date = ref();

const appointmentSection = ref(null);

const props = defineProps({
    information:Object,
    departments:Object,
    users:Object
})
console.log(props.users)

const getImageUrl = (imagePath) => {
    return `http://127.0.0.1:8000/${imagePath}`;
}
const scrollToAppointment = () => {
    appointmentSection.value.scrollIntoView({ behavior: 'smooth' });
};

</script>

<template>
    <UserLayout :information="information" :departments="departments">
        <Head title="Doctors" />
        <section class="blog section" id="blog">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h2>Our Proffesionals</h2>
                            <img src="/assets/user/img/section-img.png" alt="#">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div v-for="user in users" class="col-lg-4 col-md-6 col-12">
                        <div class="single-news">
                            <div class="news-head">
                                <img v-if="user.user.profile_photo_path" :src="getImageUrl(user.user.profile_photo_path)" alt="#">
                                <img v-else src="/upload/no_img.jpg" style="height: 110px" alt="">
                            </div>
                            <div class="news-body">
                                <div class="news-content">
                                    <h2>{{ user.user.name }}</h2>
                                    <h6>{{ user.department_info.department_name }} Department</h6>
                                    <p class="text">{{ user.speciality }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </UserLayout>
</template>
