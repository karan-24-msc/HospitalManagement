<script setup>

import StaffLayout from "@/Layouts/StaffLayout.vue";
import {Head, Link, useForm} from "@inertiajs/vue3";
import Datepicker from 'vue3-datepicker';
import {useToast} from "vue-toastification";
import InputError from "@/Components/InputError.vue";
import {ref} from "vue";

const toast = useToast();

defineProps({
    currentUrl:String,
    title: {
        type: String,
        default: 'Admitted Patients'
    },
    patients:Object
})

</script>

<template>
    <StaffLayout :currentUrl="currentUrl" :title="title">
        <Head title="Admitted Patients" />
        <div class="main">
            <div class="main-content dashboard">
                <div class="row">
                    <div class="col-12">
                        <div class="box ">
                            <div class="box-header  pt-0">
                                <div class="me-auto">
                                    <h4 class="card-title mb-0 fs-22">Admitted Patients List</h4>

                                </div>
                                <!--                                <div class="card-options pr-3">-->
                                <!--                                    <div class="dropdown"> <a href="#" class="btn ripple btn-outline-light dropdown-toggle fs-14" data-bs-toggle="dropdown" aria-expanded="false"> See All <i class="feather feather-chevron-down"></i> </a>-->
                                <!--                                        <ul class="dropdown-menu dropdown-menu-end" role="menu" style="">-->
                                <!--                                            <li><a href="#">Monthly</a></li>-->
                                <!--                                            <li><a href="#">Yearly</a></li>-->
                                <!--                                            <li><a href="#">Weekly</a></li>-->
                                <!--                                        </ul>-->
                                <!--                                    </div>-->
                                <!--                                </div>-->
                            </div>
                            <div class="box-body pb-0 table-responsive activity mt-18">
                                <table class="table table-vcenter text-nowrap table-bordered dataTable no-footer mw-100" id="task-profile" role="grid">
                                    <thead>
                                    <tr class="top">
                                        <th>Admission Id</th>
                                        <th>Patient Name</th>
                                        <th>Admission Date</th>
                                        <th>Unit</th>
                                        <th>Bed</th>
                                        <th>Assigned Doctor</th>
                                        <th>Admission Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="patient in patients.data" :key="patient.id">
                                        <td>
                                            {{ patient.admission_id }}
                                        </td>
                                        <td>
                                            {{ patient.patient.name }}
                                        </td>
                                        <td>{{ patient.admission_date }}</td>
                                        <td>
                                            {{ patient.unit.name }}
                                        </td>
                                        <td>
                                            {{ patient.bed.name }}
                                        </td>
                                        <td>
                                            {{ patient.doctor.name }}
                                        </td>
                                        <td v-if="patient.admission_status == 1">
                                            <span class="badge  badge-success">Admitted</span>
                                        </td>

                                        <td v-else>
                                            <span class="badge  badge-warning">Discharged</span>
                                        </td>

                                        <td>
                                            <Link class="btn btn-primary" :href="route('patient.show', { patient: patient.id })">
                                                View Patient
                                            </Link>
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
