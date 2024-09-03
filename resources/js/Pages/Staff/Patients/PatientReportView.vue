<script setup>
import StaffLayout from "@/Layouts/StaffLayout.vue";
import {Head} from "@inertiajs/vue3";
import {ref} from "vue";

const props = defineProps({
    currentUrl: String,
    title: {
        type: String,
        default: 'View Patient Report'
    },
    report: Object,
});
console.log(props.report)

const openSection = ref(null);

const reportSections = [
    { title: 'Hematology Report', key: 'hematology', type: 'standard' },
    { title: 'Biochemistry Report', key: 'biochemistry', type: 'standard' },
    { title: 'Stool Report', key: 'stool', type: 'standard' },
    { title: 'Urine Report', key: 'urine', type: 'standard' },
    { title: 'Serology Report', key: 'serology', type: 'standard' },
    { title: 'Immunology Report', key: 'immunology', type: 'standard' },
    { title: 'Blood Bank Report', key: 'blood_bank', type: 'standard' },
    { title: 'Histopathology Cytology Report', key: 'histopathology_cytology', type: 'standard' },
    { title: 'Microbiology Report', key: 'microbiology', type: 'standard' },
    { title: 'Ultra Snow Gram', key: 'ultra_snow_gram', type: 'special' },
    { title: 'X-Ray', key: 'x_ray', type: 'special' },
    { title: 'ECG', key: 'ecg', type: 'special' },
    { title: 'Echo/ETT', key: 'eco_ett', type: 'special' },
    { title: 'C.T. Scan', key: 'c_t_scan', type: 'special' },
    { title: 'Others', key: 'others', type: 'special' },
];

const toggleSection = (sectionIndex) => {
    openSection.value = openSection.value === sectionIndex ? null : sectionIndex;
};

const testName = (key) => {
    return key.replace(/_/g, ' ').replace(/\b\w/g, char => char.toUpperCase());
}
</script>

<template>
    <StaffLayout :currentUrl="currentUrl" :title="title">
        <Head title="Edit Patient Prescription" />
        <div class="main">
            <div class="main-content dashboard">
                <div class="row">
                    <div class="col-12">
<!--                        {{ $page.props.auth.user.emp_type }}-->
                        <div class="d-flex justify-content-between mb-4">
                            <h4 class="card-title mb-0 fs-22">Patient Report: {{ report.data.date }}</h4>
                            <a :href="route('patient.report.download', { patientReport: report.data.id })" class="btn btn-secondary">Download Full Report</a>
                        </div>
                        <div v-for="(reportSection, sectionIndex) in reportSections" :key="sectionIndex" class="box mb-4">
                            <div class="box-header pt-0">
                                <div class="d-flex justify-content-between mb-2" @click="toggleSection(sectionIndex)">
                                    <h5 class="text-center mb-0">{{ reportSection.title }}</h5>
                                    <a :href="route('patient.report.single.download', { patientReport: report.data.id,reportName: reportSection.key })" class="btn btn-primary" >Download {{ reportSection.title }}</a>
                                </div>
                            </div>
                            <div v-if="openSection === sectionIndex" class="box-body pb-0 activity mt-4 mb-4">
                                <template v-if="reportSection.type === 'standard'">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Test Name</th>
                                            <th>Count Rate</th>
                                            <th>Condition</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(test, index) in report.data[reportSection.key][0]" :key="index">
                                            <td>{{ testName(index) }}</td>
                                            <td>{{ test[0].rate }}</td>
                                            <td>{{ test[0].condition }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </template>
                                <template v-if="reportSection.type === 'special'">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Details</th>
                                            <th>Condition</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-if="report.data[reportSection.key].length > 0">
                                            <td>{{ report.data[reportSection.key][0].details }}</td>
                                            <td>{{ report.data[reportSection.key][0].condition }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </StaffLayout>
</template>
