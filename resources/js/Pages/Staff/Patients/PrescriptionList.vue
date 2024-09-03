<script setup>

import StaffLayout from "@/Layouts/StaffLayout.vue";
import {Head, Link, useForm} from "@inertiajs/vue3";
import Datepicker from 'vue3-datepicker';
import {useToast} from "vue-toastification";
import InputError from "@/Components/InputError.vue";
import {ref} from "vue";

const toast = useToast();

const props = defineProps({
    currentUrl:String,
    title: {
        type: String,
        default: 'Patient Prescriptions'
    },
    prescriptions:Object,
    patient:String,
})

console.log(props.prescriptions)
</script>

<template>
    <StaffLayout :currentUrl="currentUrl" :title="title">
        <Head title="Patient Prescriptions" />
        <div class="main">
            <div class="main-content dashboard">
                <div class="row">
                    <div class="col-12">
                        <div class="box ">
                            <div class="box-header  pt-0">
                                <div class="me-auto">
                                    <h4 class="card-title mb-0 fs-22">Patient Prescriptions</h4>
                                </div>
                                <div class="d-flex">
                                    <Link v-if="$page.props.auth.user.emp_type == 'DOCTOR'" :href="route('patient.prescription.create', { patient: patient })" class="btn btn-primary">Create Patient Prescription</Link>
                                </div>
                            </div>
                            <div class="box-body pb-0 table-responsive activity mt-18">
                                <table class="table table-vcenter text-nowrap table-bordered dataTable no-footer mw-100" id="task-profile" role="grid">
                                    <thead>
                                    <tr class="top">
                                        <th>Patient Id</th>
                                        <th>Patient Name</th>
                                        <th>Prescription Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="prescription in prescriptions.data" :key="prescription.id">
                                        <td>
                                            {{ prescription.patientInfo.registration_no }}
                                        </td>
                                        <td>
                                            {{ prescription.patientInfo.name }}
                                        </td>
                                        <td>{{ prescription.date }}</td>

                                        <td>
                                            <Link class="btn btn-primary" :href="route('patient.prescription.view', { patientPrescription: prescription.id })">
                                                View
                                            </Link>
                                            <a :href="route('patient.prescription.download', { patientPrescription: prescription.id })" class="btn btn-secondary ml-3">
                                                Download
                                            </a>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </StaffLayout>
</template>
