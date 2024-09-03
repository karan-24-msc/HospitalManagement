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
        default: 'Discharged Patients'
    },
    patients:Object
})
</script>

<template>
    <StaffLayout :currentUrl="currentUrl" :title="title">
        <Head title="Discharged Patients" />
        <div class="main">
            <div class="main-content dashboard">
                <div class="row">
                    <div class="col-12">
                        <div class="box ">
                            <div class="box-header  pt-0">
                                <div class="me-auto">
                                    <h4 class="card-title mb-0 fs-22">Discharged Patients List</h4>

                                </div>
                            </div>
                            <div class="box-body pb-0 table-responsive activity mt-18">
                                <table class="table table-vcenter text-nowrap table-bordered dataTable no-footer mw-100" id="task-profile" role="grid">
                                    <thead>
                                    <tr class="top">
                                        <th class="border-bottom-0 sorting fs-14 font-w500" tabindex="0" aria-controls="task-profile" rowspan="1" colspan="1" style="width: 222.312px;">Patient Id</th>
                                        <th class="border-bottom-0 sorting fs-14 font-w500" tabindex="0" aria-controls="task-profile" rowspan="1" colspan="1" style="width: 222.312px;">Patient Name</th>
                                        <th class="border-bottom-0 sorting fs-14 font-w500" tabindex="0" aria-controls="task-profile" rowspan="1" colspan="1" style="width: 84.8281px;">Phone</th>
                                        <th class="border-bottom-0 sorting fs-14 font-w500" tabindex="0" aria-controls="task-profile" rowspan="1" colspan="1" style="width: 87.9844px;">Patient Gender</th>
                                        <th class="border-bottom-0 sorting fs-14 font-w500" tabindex="0" aria-controls="task-profile" rowspan="1" colspan="1" style="width: 110.719px;">Patient Age</th>
                                        <th class="border-bottom-0 sorting fs-14 font-w500" tabindex="0" aria-controls="task-profile" rowspan="1" colspan="1" style="width: 110.719px;">Assigned Doctor</th>
                                        <th class="border-bottom-0 sorting_disabled fs-14 font-w500" rowspan="1" colspan="1" style="width: 145.391px;">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="patient in patients.data" :key="patient.id">
                                        <td>
                                            {{ patient.registration_no }}
                                        </td>
                                        <td>
                                            {{ patient.name }}
                                        </td>
                                        <td>{{ patient.contact }}</td>
                                        <td>
                                            {{ patient.gender }}
                                        </td>
                                        <td>
                                            {{ patient.age }}
                                        </td>
                                        <td>
                                            {{ patient.doctor.name }}
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
