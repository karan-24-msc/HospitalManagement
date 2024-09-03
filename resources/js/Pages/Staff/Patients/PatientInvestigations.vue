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
        default: 'Patient Investigations'
    },
    patient:String,
    reports:Object,
})


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
                                    <h4 class="card-title mb-0 fs-22">Patient Investigations List</h4>
                                </div>
                                <div class="d-flex">
                                    <Link v-if="$page.props.auth.user.emp_type == 'LAB_OFFICER'" :href="route('patient.report.create', { id: patient })" class="btn btn-primary">Create Patient Report</Link>
                                </div>
                            </div>
                            <div class="box-body pb-0 table-responsive activity mt-18">
                                <table class="table table-vcenter text-nowrap table-bordered dataTable no-footer mw-100" id="task-profile" role="grid">
                                    <thead>
                                    <tr class="top">
                                        <th>Patient Id</th>
                                        <th>Patient Name</th>
                                        <th>Report Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="report in reports.data" :key="report.id">
                                        <td>
                                            {{ report.patientInfo.registration_no }}
                                        </td>
                                        <td>
                                            {{ report.patientInfo.name }}
                                        </td>
                                        <td>{{ report.date }}</td>

                                        <td>
                                            <Link class="btn btn-primary" :href="route('patient.report.view', { patientReport: report.id })">
                                                View
                                            </Link>
<!--                                            <a :href="route('patient.report.download', { patientReport: report.id })" class="btn btn-secondary ml-3">-->
<!--                                                Download-->
<!--                                            </a>-->
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
