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
        default: 'Patient Information'
    },
    patient:Object
})

const dischargePatient = async () => {
    const response = await fetch(route('patient.admission.discharge', { patient: props.patient.id }));

    if (response.ok) {
        toast.success('Patient successfully discharged.');
        window.location.reload();
    } else {
        toast.error('Failed to discharge the patient.');
    }
};
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
                                    <h4 class="card-title mb-0 fs-22">Patient Information</h4>
                                </div>
                                <div class="d-flex">
                                    <Link v-if="$page.props.auth.user.emp_type != 'LAB_OFFICER'" :href="route('patient.edit', { patient: patient.id })" class="btn btn-primary">Edit Patient</Link>
                                    <Link v-if="patient.status != 2 && ($page.props.auth.user.emp_type != 'LAB_OFFICER')" :href="route('patient.admission', { patient: patient.id })" class="btn btn-success ml-4">Process Admission</Link>
                                    <Link v-if="$page.props.auth.user.emp_type != 'LAB_OFFICER'" :href="route('patient.prescription', { id: patient.id })" class="btn btn-dark ml-4">Patient Prescription</Link>
                                    <Link :href="route('patient.investigation', { id: patient.id })" class="btn btn-warning ml-4">Patient Investigation</Link>
                                    <button v-if="patient.status == 2 && ($page.props.auth.user.emp_type != 'LAB_OFFICER')" @click="dischargePatient" class="btn btn-danger ml-4">Discharge Patient</button>
                                </div>
                            </div>
                            <div class="box-body pb-0 table-responsive activity mt-18">
                                <table class="table table-vcenter text-nowrap table-bordered dataTable no-footer mw-100" id="task-profile" role="grid">
                                    <tr>
                                        <td>Registration No.</td>
                                        <td>{{ patient.registration_no }}</td>
                                    </tr>

                                    <tr>
                                        <td>Patient Name</td>
                                        <td>{{ patient.name }}</td>
                                    </tr>

                                    <tr>
                                        <td>Patient Age</td>
                                        <td>{{ patient.age }}</td>
                                    </tr>

                                    <tr>
                                        <td>Patient Gender</td>
                                        <td>{{ patient.gender }}</td>
                                    </tr>

                                    <tr>
                                        <td>Patient Blood Group</td>
                                        <td>{{ patient.blood_group }}</td>
                                    </tr>

                                    <tr>
                                        <td>Patient Contact</td>
                                        <td>{{ patient.contact }}</td>
                                    </tr>

                                    <tr>
                                        <td>Patient Email</td>
                                        <td>{{ patient.email }}</td>
                                    </tr>

                                    <tr>
                                        <td>Patient Optional Contact</td>
                                        <td>{{ patient.opt_contact }}</td>
                                    </tr>

                                    <tr>
                                        <td>Patient Religion</td>
                                        <td>{{ patient.religion }}</td>
                                    </tr>

                                    <tr>
                                        <td>Patient Father's Name</td>
                                        <td>{{ patient.father_name }}</td>
                                    </tr>

                                    <tr>
                                        <td>Patient Father's Blood Group</td>
                                        <td>{{ patient.father_bg }}</td>
                                    </tr>

                                    <tr>
                                        <td>Patient Father's Age</td>
                                        <td>{{ patient.father_age }}</td>
                                    </tr>

                                    <tr>
                                        <td>Patient Mother's Name</td>
                                        <td>{{ patient.mother_name }}</td>
                                    </tr>

                                    <tr>
                                        <td>Patient Mother's Blood Group</td>
                                        <td>{{ patient.mother_bg }}</td>
                                    </tr>

                                    <tr>
                                        <td>Patient Mother's Age</td>
                                        <td>{{ patient.mother_age }}</td>
                                    </tr>

                                    <tr>
                                        <td>Patient Address</td>
                                        <td>{{ patient.address }}</td>
                                    </tr>

                                    <tr>
                                        <td>Patient Status</td>
                                        <td v-if="patient.status == 0">
                                            <span class="badge badge-danger">Not Approved</span>
                                        </td>

                                        <td v-else-if="patient.status == 1">
                                            <span class="badge badge-success">Regular Patient</span>
                                        </td>

                                        <td v-else-if="patient.status == 2">
                                            <span class="badge badge-warning">Admitted Patient</span>
                                        </td>

                                        <td v-else-if="patient.status == 3">
                                            <span class="badge badge-danger">Discharged Patient</span>
                                        </td>

                                        <td v-else>
                                            <span class="badge badge-primary">--</span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </StaffLayout>
</template>
