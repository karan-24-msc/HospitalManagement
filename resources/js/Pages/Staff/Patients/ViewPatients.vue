<script setup>

import StaffLayout from "@/Layouts/StaffLayout.vue";
import {Head, Link, useForm} from "@inertiajs/vue3";
import Datepicker from 'vue3-datepicker';
import {useToast} from "vue-toastification";
import InputError from "@/Components/InputError.vue";
import {ref, watch} from "vue";

const toast = useToast();

defineProps({
    currentUrl:String,
    title: {
        type: String,
        default: 'New Patients'
    },
})

const searchQuery = ref('');
const patients = ref([]);
const isLoading = ref(false);

const fetchPatients = async () => {
    if (searchQuery.value.length >= 4) {
        isLoading.value = true;
        try {
            console.log('helo')
            const response = await fetch(route('fetch.patients', { query: searchQuery.value }));
            const data = await response.json();
            patients.value = data.patients;
        } catch (error) {
            toast.error("Error fetching patients");
        } finally {
            isLoading.value = false;
        }
    }
};

watch(searchQuery, fetchPatients);

</script>

<template>
    <StaffLayout :currentUrl="currentUrl" :title="title">
        <Head title="New Patients" />
        <div class="main">
            <div class="main-content dashboard">
                <div class="row">
                    <div class="col-12">
                        <div class="box">
                            <div class="box-header pt-0">
                                <div class="me-auto">
                                    <h4 class="card-title mb-0 fs-22">View Patients List</h4>
                                    <div class="position-relative mb-4 mt-4">
                                        <input
                                            type="text"
                                            class="form-control"
                                            placeholder="Search with patient Id"
                                            v-model="searchQuery"
                                            @input="fetchPatients"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="box-body pb-0 table-responsive activity mt-18">
                                <table class="table table-vcenter text-nowrap table-bordered dataTable no-footer mw-100" id="task-profile" role="grid">
                                    <thead>
                                    <tr class="top">
                                        <th>Patient Id</th>
                                        <th>Patient Name</th>
                                        <th>Phone</th>
                                        <th>Patient Gender</th>
                                        <th>Patient Age</th>
                                        <th>Assigned Doctor</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="patient in patients" :key="patient.id">
                                        <td>{{ patient.registration_no }}</td>
                                        <td>{{ patient.name }}</td>
                                        <td>{{ patient.phone }}</td>
                                        <td>{{ patient.gender }}</td>
                                        <td>{{ patient.age }}</td>
                                        <td>{{ patient.doctor.name }}</td>
                                        <td>
                                            <Link class="btn btn-primary" :href="route('patient.show', { patient: patient.id })">
                                                View Patient
                                            </Link>
                                        </td>
                                    </tr>
                                    <tr v-if="!patients.length && !isLoading">
                                        <td colspan="7" class="text-center">No patients found</td>
                                    </tr>
                                    <tr v-if="isLoading">
                                        <td colspan="7" class="text-center">Loading...</td>
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

