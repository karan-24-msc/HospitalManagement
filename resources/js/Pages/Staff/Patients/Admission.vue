<script setup>

import StaffLayout from "@/Layouts/StaffLayout.vue";
import {Head, Link, useForm} from "@inertiajs/vue3";
import Datepicker from 'vue3-datepicker';
import {useToast} from "vue-toastification";
import InputError from "@/Components/InputError.vue";
import {ref} from "vue";

const toast = useToast();

const beds = ref([])

const props = defineProps({
    currentUrl:String,
    title: {
        type: String,
        default: 'Process Admission'
    },
    patient:Object,
    doctors:Object,
    units:Object,
})

const admissionForm = useForm({
    admission_date: '',
    unit_id: '',
    bed_id: '',
    patient_id: props.patient.id,
    consultant_id: '',
});

const fetchBeds = async () => {
    if (admissionForm.unit_id) {
        const response = await fetch(route('fetch.beds', admissionForm.unit_id));
        const data = await response.json();
        beds.value = data;
        console.log(beds.value)
    }
};


const submitAdmission = () => admissionForm.post(route('patient.admission.store',props.patient.id),{
    preserveScroll: true,
    onSuccess: () => {
        toast.success('Patient Admitted Successfully!');
        admissionForm.reset();
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
                                    <h4 class="card-title mb-0 fs-22">Process Admission for Patient - {{ patient.registration_no }}</h4>
                                </div>

                            </div>
                            <div class="box-body pb-0 activity mt-18">
                                <form class="form" @submit.prevent="submitAdmission">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 mb-2">
                                            <div class="form-group">
                                                <label>Admission Date</label><br>
                                                <Datepicker class="form-control" v-model="admissionForm.admission_date"/>
                                                <InputError class="mt-2" :message="admissionForm.errors.admission_date" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 mb-2">
                                            <div class="form-group">
                                                <label>Select Unit</label><br>
                                                <select class="form-control" v-model="admissionForm.unit_id" @change="fetchBeds">
                                                    <option value="" disabled selected>Select One</option>
                                                    <option v-for="unit in units" :value="unit.id">{{ unit.name }}</option>
                                                </select>
                                                <InputError class="mt-2" :message="admissionForm.errors.unit_id" />
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 mb-2">
                                            <div class="form-group">
                                                <label>Select Bed</label><br>
                                                <select class="form-control" v-model="admissionForm.bed_id">
                                                    <option value="" disabled selected>Select One</option>
                                                    <option v-for="bed in beds" :value="bed.id">{{ bed.name }}</option>
                                                </select>
                                                <InputError class="mt-2" :message="admissionForm.errors.bed_id" />
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 mb-2">
                                            <div class="form-group">
                                                <label>Select Consultant</label><br>
                                                <select class="form-control" v-model="admissionForm.consultant_id">
                                                    <option value="" disabled selected>Select One</option>
                                                    <option v-for="doctor in doctors" :value="doctor.user.id">{{ doctor.user.name }}</option>
                                                </select>
                                                <InputError class="mt-2" :message="admissionForm.errors.consultant_id" />
                                            </div>
                                        </div>

                                        <div class="col-lg-5 col-md-4 col-12 mb-2">
                                            <div class="form-group">
                                                <div class="button">
                                                    <button type="submit" class="btn btn-primary">Process Admission</button>
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
