<script setup>
import {Link, useForm} from "@inertiajs/vue3";
import VueDatePicker from "@vuepic/vue-datepicker";
import {ref} from "vue";
import {useToast} from "vue-toastification";
import InputError from "@/Components/InputError.vue";

const appointmentModal = ref(true)

const toast = useToast();

const doctors = ref([]);

const appointmentForm = useForm({
    name: '',
    email: '',
    phone: '',
    department: '',
    doctor: '',
    date: '',
    note: '',
    app_gender: '',
    app_age: '',
});

const closeModal = () => {
    // Hide modal using jQuery
    $(`.modal`).modal('hide');

    // Manually remove modal backdrop
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();

    // Clear form data or reset state as needed
    selectedAppointment.value = null;
};

defineProps({
    information:Object,
    departments:Object
})

const fetchDoctors = async () => {
    if (appointmentForm.department) {
        const response = await fetch(route('fetch.doctors', appointmentForm.department));
        const data = await response.json();
        doctors.value = data;
    }
};

const submitAppointment = () => appointmentForm.post(route('store.appointment'),{
    preserveScroll: true,
    onSuccess: () => {
        toast.success('Appointment successfully booked!');
        appointmentForm.reset();
        closeModal();
    }
})
</script>

<template>
    <div>

        <!-- header-start -->
        <header class="header" >
            <!-- Topbar -->
            <div class="topbar">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-5 col-12">
                            <!-- Contact -->
<!--                            <ul class="top-link">-->
<!--                                <li><a href="#">About</a></li>-->
<!--                                <li><a href="#">Doctors</a></li>-->
<!--                                <li><a href="#">Contact</a></li>-->
<!--                                <li><a href="#">FAQ</a></li>-->
<!--                            </ul>-->
                            <!-- End Contact -->
                        </div>
                        <div class="col-lg-6 col-md-7 col-12">
                            <!-- Top Contact -->
                            <ul class="top-contact">
                                <li><i class="fa fa-phone"></i>{{ information.contact }}</li>
                                <li><i class="fa fa-envelope"></i><a href="mailto:support@yourmail.com">{{ information.email }}</a></li>
                            </ul>
                            <!-- End Top Contact -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Topbar -->
            <!-- Header Inner -->
            <div class="header-inner">
                <div class="container">
                    <div class="inner">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-12">
                                <!-- Start Logo -->
                                <div class="logo">
                                    <Link :href="route('index')">
                                        <img class="head-logo" :src="information.logo">
                                    </Link>
                                </div>
                                <!-- End Logo -->
                                <!-- Mobile Nav -->
                                <div class="mobile-nav"></div>
                                <!-- End Mobile Nav -->
                            </div>
                            <div class="col-lg-7 col-md-9 col-12">
                                <!-- Main Menu -->
                                <div class="main-menu">
                                    <nav class="navigation">
                                        <ul class="nav menu">
                                            <li class=""><Link :href="route('index')">Home</Link></li>
                                            <li><Link :href="route('doctors')">Doctos </Link></li>
                                            <li><Link :href="route('contact')">Contact Us</Link></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-lg-2 col-12">
                                <div class="get-quote">
                                    <a href="appointment.html" class="btn" data-toggle="modal" data-target="#exampleModalCenter">Book Appointment</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ End Header Inner -->
        </header>
        <!-- header-end -->

        <main>
            <slot></slot>
        </main>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content border_rounded">
                    <div class="modal-header header_area">
                        <h5 class="modal-title text-center" id="exampleModalLongTitle">We Are Always Ready to Help You. Book An Appointment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form" action="#" @submit.prevent="submitAppointment">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12 mb-2">
                                    <div class="form-group">
                                        <label>Name</label><br>
                                        <input class="form-control" name="name" type="text" v-model="appointmentForm.name">
                                        <InputError class="mt-2" :message="appointmentForm.errors.name" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 mb-2">
                                    <div class="form-group">
                                        <label>Email</label><br>
                                        <input class="form-control" name="email" type="email" v-model="appointmentForm.email">
                                        <InputError class="mt-2" :message="appointmentForm.errors.email" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 mb-2">
                                    <div class="form-group">
                                        <label>Phone</label><br>
                                        <input class="form-control" name="phone" type="text" v-model="appointmentForm.phone">
                                        <InputError class="mt-2" :message="appointmentForm.errors.phone" />
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-12 mb-2">
                                    <div class="form-group">
                                        <label>Gender</label><br>
                                        <select class="form-control" v-model="appointmentForm.app_gender">
                                            <option value="" disabled selected>Select One</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Others">Others</option>
                                        </select>
                                        <InputError class="mt-2" :message="appointmentForm.errors.app_gender" />
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12 mb-2">
                                    <div class="form-group">
                                        <label>Age</label><br>
                                        <input class="form-control" name="phone" type="number" v-model="appointmentForm.app_age">
                                        <InputError class="mt-2" :message="appointmentForm.errors.app_age" />
                                    </div>
                                </div>


                                <div class="col-lg-6 col-md-6 col-12 mb-2">
                                    <div class="form-group">
                                        <label>Select Department</label><br>
                                        <select class="form-control" tabindex="0" v-model="appointmentForm.department" @change="fetchDoctors">
                                            <option value="" selected disabled>Select....</option>
                                            <option v-for="department in departments" :value="department.id">{{ department.department_name }}</option>
                                        </select>
                                        <InputError class="mt-2" :message="appointmentForm.errors.department" />
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-12 mb-2">
                                    <div class="form-group">
                                        <label>Select Doctor</label><br>
                                        <select class="form-control" v-model="appointmentForm.doctor">
                                            <option value="" selected disabled>Select....</option>
                                            <option v-for="doctor in doctors" :value="doctor.user.id">{{ doctor.user.name }}</option>
                                        </select>
                                        <InputError class="mt-2" :message="appointmentForm.errors.doctor" />
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-12 mb-2">
                                    <div class="form-group">
                                        <label>Date</label><br>
                                        <VueDatePicker v-model="appointmentForm.date"></VueDatePicker>
                                        <InputError class="mt-2" :message="appointmentForm.errors.name" />
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-12 mb-2">
                                    <div class="form-group">
                                        <label>Write a Note</label><br>
                                        <textarea name="message" rows="5" placeholder="Write Your Message Here....." v-model="appointmentForm.note"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-5 col-md-4 col-12 mb-2">
                                    <div class="form-group">
                                        <div class="button">
                                            <button type="submit" class="btn">Book An Appointment</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- Footer Area -->
        <footer id="footer" class="footer ">
            <!-- Footer Top -->
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="single-footer">
                                <h2>About Us</h2>
                                <p>Lorem ipsum dolor sit am consectetur adipisicing elit do eiusmod tempor incididunt ut labore dolore magna.</p>
                                <!-- Social -->
                                <ul class="social">
                                    <li><a href="#"><i class="icofont-facebook"></i></a></li>
                                    <li><a href="#"><i class="icofont-google-plus"></i></a></li>
                                    <li><a href="#"><i class="icofont-twitter"></i></a></li>
                                    <li><a href="#"><i class="icofont-vimeo"></i></a></li>
                                    <li><a href="#"><i class="icofont-pinterest"></i></a></li>
                                </ul>
                                <!-- End Social -->
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="single-footer f-link">
                                <h2>Quick Links</h2>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <ul>
                                            <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Home</a></li>
                                            <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>About Us</a></li>
                                            <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Services</a></li>
                                            <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Our Cases</a></li>
                                            <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Other Links</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <ul>
                                            <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Consuling</a></li>
                                            <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Finance</a></li>
                                            <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Testimonials</a></li>
                                            <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>FAQ</a></li>
                                            <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Contact Us</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="single-footer">
                                <h2>Open Hours</h2>
                                <p>Lorem ipsum dolor sit ame consectetur adipisicing elit do eiusmod tempor incididunt.</p>
                                <ul class="time-sidual">
                                    <li class="day">Monday - Fridayp <span>8.00-20.00</span></li>
                                    <li class="day">Saturday <span>9.00-18.30</span></li>
                                    <li class="day">Monday - Thusday <span>9.00-15.00</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="single-footer">
                                <h2>Newsletter</h2>
                                <p>subscribe to our newsletter to get allour news in your inbox.. Lorem ipsum dolor sit amet, consectetur adipisicing elit,</p>
                                <form action="mail/mail.php" method="get" target="_blank" class="newsletter-inner">
                                    <input name="email" placeholder="Email Address" class="common-input" onfocus="this.placeholder = ''"
                                           onblur="this.placeholder = 'Your email address'" required="" type="email">
                                    <button class="button"><i class="icofont icofont-paper-plane"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ End Footer Top -->
            <!-- Copyright -->
            <div class="copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="copyright-content">
                                <p>© Copyright 2018  |  All Rights Reserved by <a href="https://www.wpthemesgrid.com" target="_blank">wpthemesgrid.com</a> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ End Copyright -->
        </footer>
        <!--/ End Footer Area -->

    </div>
</template>

<style scoped>
.border_rounded {
    border-radius: 20px; /* Adjust the value to change the roundness */
}

.header_area{
    padding: 30px;
    align-items: center;
}
</style>
