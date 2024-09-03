<script setup>
import UserLayout from "@/Layouts/UserLayout.vue";
import {Head, useForm} from "@inertiajs/vue3";
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import {ref} from "vue";
import InputError from "@/Components/InputError.vue";
import {useToast} from "vue-toastification";

const date = ref();

const appointmentSection = ref(null);

const toast = useToast();

defineProps({
    information:Object,
    departments:Object
})

const contactForm = useForm({
    name: '',
    email: '',
    phone: '',
    subject: '',
    message: '',
});

const submitContact = () => contactForm.post(route('store.contact'),{
    preserveScroll: true,
    onSuccess: () => {
        toast.success('Message Sent Successfully!');
        contactForm.reset();
        closeModal();
    }
})

const scrollToAppointment = () => {
    appointmentSection.value.scrollIntoView({ behavior: 'smooth' });
};

</script>

<template>
    <UserLayout :information="information" :departments="departments">
        <Head title="Home" />
        <section class="contact-us section">
            <div class="container">
                <div class="inner">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="contact-us-left">
                                <!--Start Google-map -->
                                <div id="myMap">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d224300.1040196625!2d-1.1743202203808433!3d52.35551771407302!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487bbd277027888b%3A0x587f65b678e42e6e!2sEngland%2C%20UK!5e0!3m2!1sen!2s!4v1691168487043!5m2!1sen!2s"
                                        width="600"
                                        height="650"
                                        style="border:0;"
                                        allowfullscreen=""
                                        loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade">
                                    </iframe>
                                </div>
                                <!--/End Google-map -->
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="contact-us-form">
                                <h2>Contact With Us</h2>
                                <p>If you have any questions please fell free to contact with us.</p>
                                <!-- Form -->
                                <form class="form" method="post" @submit.prevent="submitContact">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="text" name="name" placeholder="Name" required="" v-model="contactForm.name">
                                                <InputError class="mt-2" :message="contactForm.errors.name" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="email" name="email" placeholder="Email" required="" v-model="contactForm.email">
                                                <InputError class="mt-2" :message="contactForm.errors.email" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="text" name="phone" placeholder="Phone" required="" v-model="contactForm.phone">
                                                <InputError class="mt-2" :message="contactForm.errors.phone" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="text" name="subject" placeholder="Subject" required="" v-model="contactForm.subject">
                                                <InputError class="mt-2" :message="contactForm.errors.subject" />
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <textarea name="message" placeholder="Your Message" required="" v-model="contactForm.message"></textarea>
                                                <InputError class="mt-2" :message="contactForm.errors.message" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group login-btn">
                                                <button class="btn" type="submit">Send</button>
                                            </div>
                                            <div class="checkbox">
                                                <label class="checkbox-inline" for="2"><input name="news" id="2" type="checkbox">Do you want to subscribe our Newsletter ?</label>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!--/ End Form -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contact-info">
                    <div class="row">
                        <!-- single-info -->
                        <div class="col-lg-4 col-12 ">
                            <div class="single-info">
                                <i class="icofont icofont-ui-call"></i>
                                <div class="content">
                                    <h3>+(000) 1234 56789</h3>
                                    <p>info@company.com</p>
                                </div>
                            </div>
                        </div>
                        <!--/End single-info -->
                        <!-- single-info -->
                        <div class="col-lg-4 col-12 ">
                            <div class="single-info">
                                <i class="icofont-google-map"></i>
                                <div class="content">
                                    <h3>2 Fir e Brigade Road</h3>
                                    <p>Chittagonj, Lakshmipur</p>
                                </div>
                            </div>
                        </div>
                        <!--/End single-info -->
                        <!-- single-info -->
                        <div class="col-lg-4 col-12 ">
                            <div class="single-info">
                                <i class="icofont icofont-wall-clock"></i>
                                <div class="content">
                                    <h3>Mon - Sat: 8am - 5pm</h3>
                                    <p>Sunday Closed</p>
                                </div>
                            </div>
                        </div>
                        <!--/End single-info -->
                    </div>
                </div>
            </div>
        </section>
    </UserLayout>
</template>
