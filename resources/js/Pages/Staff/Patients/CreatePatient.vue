<script setup>

import StaffLayout from "@/Layouts/StaffLayout.vue";
import {Head, Link, useForm} from "@inertiajs/vue3";
import Datepicker from 'vue3-datepicker';
import {useToast} from "vue-toastification";
import InputError from "@/Components/InputError.vue";
import {ref} from "vue";
import VueDatePicker from "@vuepic/vue-datepicker";

const toast = useToast();

const doctors = ref([]);

const props = defineProps({
    currentUrl:String,
    title: {
        type: String,
        default: 'Patient Create'
    },
    departments:Object
})

const fetchDoctors = async () => {
    if (patientForm.assigned_dep) {
        const response = await fetch(route('fetch.doctors', patientForm.assigned_dep));
        const data = await response.json();
        doctors.value = data;
    }
};


const patientForm = useForm({
    assigned_dep: '',
    assigned_doc: '',
    name: '',
    age: '',
    gender: '',
    blood_group: '',
    contact: '',
    opt_contact: '',
    email: '',
    religion: '',
    father_name: '',
    father_bg: '',
    father_age: '',
    mother_name: '',
    mother_bg: '',
    mother_age: '',
    address: '',
});

const storePatient = () => patientForm.post(route('patient.store'),{
    preserveScroll: true,
    onSuccess: () => {
        toast.success('Patient Created Successfully!');
        patientForm.reset();
        closeModal();
    }
})

</script>

<template>
    <StaffLayout :currentUrl="currentUrl" :title="title">
        <Head title="New Patients" />
        <div class="main">
            <div class="main-content dashboard">
                <div class="row">
                    <div class="col-12">
                        <div class="box ">
                            <div class="box-header  pt-0">
                                <div class="me-auto">
                                    <h4 class="card-title mb-0 fs-22">Patient Edit</h4>
                                </div>

                            </div>
                            <div class="box-body pb-0 activity mt-18">
                                <form class="form" @submit.prevent="storePatient">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 mb-2">
                                            <div class="form-group">
                                                <label>Select Department</label><br>
                                                <select class="form-control" tabindex="0" v-model="patientForm.assigned_dep" @change="fetchDoctors">
                                                    <option value="" selected disabled>Select....</option>
                                                    <option v-for="department in departments" :value="department.id">{{ department.department_name }}</option>
                                                </select>
                                                <InputError class="mt-2" :message="patientForm.errors.assigned_dep" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 mb-2">
                                            <div class="form-group">
                                                <label>Select Doctor</label><br>
                                                <select class="form-control" v-model="patientForm.assigned_doc">
                                                    <option value="" selected disabled>Select....</option>
                                                    <option v-for="doctor in doctors" :value="doctor.user.id">{{ doctor.user.name }}</option>
                                                </select>
                                                <InputError class="mt-2" :message="patientForm.errors.assigned_doc" />
                                            </div>
                                        </div>


                                        <div class="col-lg-6 col-md-6 mb-2">
                                            <div class="form-group">
                                                <label>Patient Name</label><br>
                                                <input class="form-control" name="name" type="text" v-model="patientForm.name">
                                                <InputError class="mt-2" :message="patientForm.errors.name" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 mb-2">
                                            <div class="form-group">
                                                <label>Patient Age</label><br>
                                                <input class="form-control" name="age" type="number" v-model="patientForm.age">
                                                <InputError class="mt-2" :message="patientForm.errors.age" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 mb-2">
                                            <div class="form-group">
                                                <label>Patient Gender</label><br>
                                                <select class="form-control" v-model="patientForm.gender">
                                                    <option value="" disabled selected>Select One</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Others">Others</option>
                                                </select>
                                                <InputError class="mt-2" :message="patientForm.errors.gender" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 mb-2">
                                            <div class="form-group">
                                                <label>Patient Blood Group</label><br>
                                                <select class="form-control" v-model="patientForm.blood_group">
                                                    <option value="" disabled selected>Select One</option>
                                                    <option value="A+">A+</option>
                                                    <option value="A-">A-</option>
                                                    <option value="B+">B+</option>
                                                    <option value="B-">B-</option>
                                                    <option value="O+">O+</option>
                                                    <option value="O-">O-</option>
                                                    <option value="AB+">AB+</option>
                                                    <option value="AB-">AB-</option>
                                                </select>
                                                <InputError class="mt-2" :message="patientForm.errors.blood_group" />
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 mb-2">
                                            <div class="form-group">
                                                <label>Patient Contact</label><br>
                                                <input class="form-control" name="contact" type="text" v-model="patientForm.contact">
                                                <InputError class="mt-2" :message="patientForm.errors.contact" />
                                            </div>
                                        </div>




                                        <div class="col-lg-6 col-md-6 mb-2">
                                            <div class="form-group">
                                                <label>Optional Contact</label><br>
                                                <input class="form-control" name="opt_contact" type="text" v-model="patientForm.opt_contact">
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 mb-2">
                                            <div class="form-group">
                                                <label>Patient Email</label><br>
                                                <input class="form-control" name="email" type="email" v-model="patientForm.email">
                                                <InputError class="mt-2" :message="patientForm.errors.email" />
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 mb-2">
                                            <div class="form-group">
                                                <label>Patient Religion</label><br>
                                                <input class="form-control" name="religion" type="text" v-model="patientForm.religion">
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 mb-2">
                                            <div class="form-group">
                                                <label>Patient's Father Name</label><br>
                                                <input class="form-control" name="father_name" type="text" v-model="patientForm.father_name">
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 mb-2">
                                            <div class="form-group">
                                                <label>Patient's Father Bg</label><br>
                                                <input class="form-control" name="father_bg" type="text" v-model="patientForm.father_bg">
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 mb-2">
                                            <div class="form-group">
                                                <label>Patient's Father Age</label><br>
                                                <input class="form-control" name="father_age" type="text" v-model="patientForm.father_age">
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 mb-2">
                                            <div class="form-group">
                                                <label>Patient's Mother Name</label><br>
                                                <input class="form-control" name="mother_name" type="text" v-model="patientForm.mother_name">
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 mb-2">
                                            <div class="form-group">
                                                <label>Patient's Mother Name</label><br>
                                                <input class="form-control" name="mother_bg" type="text" v-model="patientForm.mother_bg">
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 mb-2">
                                            <div class="form-group">
                                                <label>Patient's Mother Age</label><br>
                                                <input class="form-control" name="mother_age" type="text" v-model="patientForm.mother_age">
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 mb-2">
                                            <div class="form-group">
                                                <label>Patient's Address</label><br>
                                                <input class="form-control" name="address" type="text" v-model="patientForm.address">
                                                <InputError class="mt-2" :message="patientForm.errors.address" />
                                            </div>
                                        </div>


                                        <div class="col-12 mt-6">
                                            <div class="form-group">
                                                <div class="button">
                                                    <button type="submit" class="btn btn-primary">Update</button>
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
