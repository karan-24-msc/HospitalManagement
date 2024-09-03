<script setup>
import StaffLayout from "@/Layouts/StaffLayout.vue";
import {Head, Link, useForm} from "@inertiajs/vue3";
import {useToast} from "vue-toastification";
import InputError from "@/Components/InputError.vue";

const toast = useToast();

const props = defineProps({
    currentUrl: String,
    title: {
        type: String,
        default: 'Edit Patient Prescription'
    },
    prescription: Object,
});
console.log(props.prescription)
</script>

<template>
    <StaffLayout :currentUrl="currentUrl" :title="title">
        <Head title="Edit Patient Prescription" />
        <div class="main">
            <div class="main-content dashboard">
                <div class="row">
                    <div class="col-12">
                        <div class="box">
                            <div class="box-header pt-0">
                                <div class="me-auto">
                                    <h4 class="card-title mb-0 fs-22">Patient Prescription: {{ prescription.data.date }}</h4>
                                </div>
                                <div class="float-end">
                                    <a :href="route('patient.prescription.download', { patientPrescription: prescription.data.id })" class="btn btn-secondary">Download Prescription</a>
                                </div>
                            </div>
                            <div class="box-body pb-0  activity mt-18">
                                <div class="row mb-3">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Disease Description:</label><br>
                                            <p>{{ prescription.data.disease_description }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Clinical Diagnosis:</label><br>
                                            <p>{{ prescription.data.clinical_diagnosis }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label>Advice:</label><br>
                                            <p>{{ prescription.data.advice }}</p>
                                        </div>
                                    </div>

                                </div>

                                <h5>Medicine List</h5>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Medicine Name</th>
                                        <th>Medicine Take</th>
                                        <th>Medicine Time</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="medicine in prescription.data.medicine_treatment" >
                                        <td>{{ medicine.name }}</td>
                                        <td>{{ medicine.take }}</td>
                                        <td>{{ medicine.time }}</td>
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
