<script setup>
import StaffLayout from "@/Layouts/StaffLayout.vue";
import {Head, Link, useForm} from "@inertiajs/vue3";
import Datepicker from 'vue3-datepicker';
import {useToast} from "vue-toastification";
import InputError from "@/Components/InputError.vue";
import {ref} from "vue";

const toast = useToast();

const props = defineProps({
    currentUrl: String,
    title: {
        type: String,
        default: 'Patient Prescription'
    },
    patient: Object
});

const prescriptionForm = useForm({
    medicine_treatment: [
        {name: '', take: '', time: ''}
    ],
    disease_description: '',
    clinical_diagnosis: '',
    advice: '',
    patient_id: props.patient.id,
    date: '',
});

const addMedicineRow = () => {
    prescriptionForm.medicine_treatment.push({name: '', take: '', time: ''});
};

const removeMedicineRow = (index) => {
    if (prescriptionForm.medicine_treatment.length > 1) {
        prescriptionForm.medicine_treatment.splice(index, 1);
    }
};

const submitPatientPrescription = () => prescriptionForm.post(route('patient.prescription.store'), {
    preserveScroll: true,
    onSuccess: () => {
        toast.success('Patient Prescription Stored Successfully!');
        prescriptionForm.reset();
    }
});
</script>

<template>
    <StaffLayout :currentUrl="currentUrl" :title="title">
        <Head title="Patient Prescription"/>
        <div class="main">
            <div class="main-content dashboard">
                <div class="row">
                    <div class="col-12">
                        <div class="box ">
                            <div class="box-header  pt-0">
                                <div class="me-auto">
                                    <h4 class="card-title mb-0 fs-22">Patient Prescription Create</h4>
                                </div>
                            </div>
                            <div class="box-body pb-0 activity mt-18">
                                <form class="form" @submit.prevent="submitPatientPrescription">
                                    <h5>Medicines List</h5>
                                    <div class="row mb-4" v-for="(medicine, index) in prescriptionForm.medicine_treatment"
                                         :key="index">
                                        <div class="col-lg-5 col-md-5 mb-2">
                                            <div class="form-group">
                                                <label>Medicine Name</label><br>
                                                <input type="text" class="form-control" v-model="medicine.name">
                                                <InputError class="mt-2"
                                                            :message="prescriptionForm.errors.medicine_treatment?.[index]?.name"/>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-3 mb-2">
                                            <div class="form-group">
                                                <label>Medicine Take</label><br>
                                                <input type="number" class="form-control" v-model="medicine.take">
                                                <InputError class="mt-2"
                                                            :message="prescriptionForm.errors.medicine_treatment?.[index]?.take"/>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-3 mb-2">
                                            <div class="form-group">
                                                <label>Medicine Time</label><br>
                                                <select class="form-control" v-model="medicine.time">
                                                    <option value="" disabled selected>Select One</option>
                                                    <option value="Before Eating">Before Eating</option>
                                                    <option value="After Eating">After Eating</option>
                                                </select>
                                                <InputError class="mt-2"
                                                            :message="prescriptionForm.errors.medicine_treatment?.[index]?.time"/>
                                            </div>
                                        </div>

                                        <div class="col-lg-1 col-md-1 mb-2 d-flex align-items-end">
                                            <button type="button" class="btn btn-danger"
                                                    @click="removeMedicineRow(index)"
                                                    :disabled="prescriptionForm.medicine_treatment.length === 1">-
                                            </button>
                                            <button type="button" class="btn btn-success ms-2" @click="addMedicineRow">
                                                +
                                            </button>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-lg-12 col-md-12 mb-2">
                                            <div class="form-group">
                                                <label>Disease Description</label><br>
                                                <textarea class="form-control" rows="5" v-model="prescriptionForm.disease_description"></textarea>
                                                <InputError class="mt-2" :message="prescriptionForm.errors.disease_description" />
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 mb-2">
                                            <div class="form-group">
                                                <label>Clinical Diagnosis</label><br>
                                                <input class="form-control" v-model="prescriptionForm.clinical_diagnosis"/>
                                                <InputError class="mt-2" :message="prescriptionForm.errors.clinical_diagnosis" />
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 mb-2">
                                            <div class="form-group">
                                                <label>Prescription Date</label><br>
                                                <Datepicker class="form-control" v-model="prescriptionForm.date"/>
                                                <InputError class="mt-2" :message="prescriptionForm.errors.date" />
                                            </div>
                                        </div>


                                        <div class="col-lg-12 col-md-12 mb-2">
                                            <div class="form-group">
                                                <label>Advice</label><br>
                                                <textarea class="form-control" rows="5" v-model="prescriptionForm.advice"></textarea>
                                                <InputError class="mt-2" :message="prescriptionForm.errors.advice" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-5 col-md-4 col-12">
                                            <div class="form-group">
                                                <div class="button">
                                                    <button type="submit" class="btn btn-primary">Prescription Store</button>
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
