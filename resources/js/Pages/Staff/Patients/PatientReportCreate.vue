<script setup>
import StaffLayout from "@/Layouts/StaffLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import InputError from "@/Components/InputError.vue";
import { ref } from "vue";
import ReportTestFields from "@/Components/ReportTestFields.vue";

const toast = useToast();

const props = defineProps({
    currentUrl: String,
    title: {
        type: String,
        default: 'Patient Report Create',
    },
    patient: String, // Updated to Object to match how it's being used
});

const reportForm = useForm({
    hematology: [
        {
            cbc_esr: [{ rate: '', condition: '' }],
            tc_dc_hb_esr: [{ rate: '', condition: '' }],
            blood_film: [{ rate: '', condition: '' }],
            platelet_count: [{ rate: '', condition: '' }],
            tce: [{ rate: '', condition: '' }],
            mp: [{ rate: '', condition: '' }],
            htc_mcv_mcc_mch: [{ rate: '', condition: '' }],
            reticulocyte_count: [{ rate: '', condition: '' }],
            bt_ct: [{ rate: '', condition: '' }],
            prothrombine_time: [{ rate: '', condition: '' }],
            aptt: [{ rate: '', condition: '' }],
            fibrinogen: [{ rate: '', condition: '' }],
            fdp: [{ rate: '', condition: '' }],
            dimer: [{ rate: '', condition: '' }],
        },
    ],
    biochemistry: [
        {
            glucose: [{ rate: '', condition: '' }],
            lipid_profile: [{ rate: '', condition: '' }],
            urea_bun: [{ rate: '', condition: '' }],
            creatine: [{ rate: '', condition: '' }],
            creatine_clearance_rate: [{ rate: '', condition: '' }],
            bilirubin: [{ rate: '', condition: '' }],
            ast: [{ rate: '', condition: '' }],
            alt: [{ rate: '', condition: '' }],
            alkaline_phosphates: [{ rate: '', condition: '' }],
            ck: [{ rate: '', condition: '' }],
            ck_mb: [{ rate: '', condition: '' }],
            ldh: [{ rate: '', condition: '' }],
            amylase: [{ rate: '', condition: '' }],
            pro_bnp: [{ rate: '', condition: '' }],
            pancreatic_amylase: [{ rate: '', condition: '' }],
            lipage: [{ rate: '', condition: '' }],
            acid_phosphates: [{ rate: '', condition: '' }],
            s_total_protine: [{ rate: '', condition: '' }],
            s_albumin: [{ rate: '', condition: '' }],
            a_g_ration: [{ rate: '', condition: '' }],
            uric_acid: [{ rate: '', condition: '' }],
            arterial_blood_gas: [{ rate: '', condition: '' }],
            s_electrolytes: [{ rate: '', condition: '' }],
            s_calcium: [{ rate: '', condition: '' }],
            y_gt: [{ rate: '', condition: '' }],
            ammonia: [{ rate: '', condition: '' }],
            s_iron: [{ rate: '', condition: '' }],
            tibc: [{ rate: '', condition: '' }],
            s_ferritin: [{ rate: '', condition: '' }],
            magnisium: [{ rate: '', condition: '' }],
            inorganic_phosphate: [{ rate: '', condition: '' }],
        },
    ],
    stool: [
        {
            r_e: [{ rate: '', condition: '' }],
            reduction_substance: [{ rate: '', condition: '' }],
            occult_blood_test: [{ rate: '', condition: '' }],
        },
    ],
    urine: [
        {
            re_me: [{ rate: '', condition: '' }],
            bile_salt: [{ rate: '', condition: '' }],
            bile_pigment: [{ rate: '', condition: '' }],
            urobilinogen: [{ rate: '', condition: '' }],
            total_protine: [{ rate: '', condition: '' }],
            ketones: [{ rate: '', condition: '' }],
            ph: [{ rate: '', condition: '' }],
            sputum: [{ rate: '', condition: '' }],
            skin_scroping: [{ rate: '', condition: '' }],
        },
    ],
    serology: [
        {
            i_c_t_for_malaria: [{ rate: '', condition: '' }],
            a_s_o_titre: [{ rate: '', condition: '' }],
            vdrl: [{ rate: '', condition: '' }],
            widal: [{ rate: '', condition: '' }],
            r_a_test: [{ rate: '', condition: '' }],
            hbs_ag: [{ rate: '', condition: '' }],
            dengue_igg: [{ rate: '', condition: '' }],
            dengue_igm: [{ rate: '', condition: '' }],
            c_reactive_protein: [{ rate: '', condition: '' }],
            tpha: [{ rate: '', condition: '' }],
        },
    ],
    immunology: [
        {
            t3: [{ rate: '', condition: '' }],
            t4: [{ rate: '', condition: '' }],
            tsh: [{ rate: '', condition: '' }],
            ft4: [{ rate: '', condition: '' }],
            b_hcg: [{ rate: '', condition: '' }],
            testosterone: [{ rate: '', condition: '' }],
            progesterone: [{ rate: '', condition: '' }],
            prolactin: [{ rate: '', condition: '' }],
            ferritin: [{ rate: '', condition: '' }],
            afp: [{ rate: '', condition: '' }],
            ige: [{ rate: '', condition: '' }],
            hav_igm: [{ rate: '', condition: '' }],
            hev_igm: [{ rate: '', condition: '' }],
            anti_hcv: [{ rate: '', condition: '' }],

            hbsag_elisa: [{ rate: '', condition: '' }],
            h_pylori_igg: [{ rate: '', condition: '' }],
            anf_ana: [{ rate: '', condition: '' }],
            hbc_ag: [{ rate: '', condition: '' }],
            hiv_1_2: [{ rate: '', condition: '' }],
            covid_19: [{ rate: '', condition: '' }],
        },
    ],
    blood_bank: [
        {
            blood_typing_and_rh_factor: [{ rate: '', condition: '' }],
            cross_matching: [{ rate: '', condition: '' }]
        },
    ],
    histopathology_cytology: [
        {
            fnac: [{ rate: '', condition: '' }],
            pap_smear: [{ rate: '', condition: '' }]
        },
    ],
    microbiology: [
        {
            throat_swab: [{ rate: '', condition: '' }],
            throat_swab_for_klb: [{ rate: '', condition: '' }],
            ear_swab: [{ rate: '', condition: '' }],
            nose_swab: [{ rate: '', condition: '' }],
            eye_swab: [{ rate: '', condition: '' }],
            pus_cs: [{ rate: '', condition: '' }],
            urine_cs: [{ rate: '', condition: '' }],
            blood_cs: [{ rate: '', condition: '' }],
            hvs_cs: [{ rate: '', condition: '' }],
            prostatic_smear: [{ rate: '', condition: '' }],
            wound_swab: [{ rate: '', condition: '' }],
            tracheal_aspirate: [{ rate: '', condition: '' }],
            bronchial_lavage: [{ rate: '', condition: '' }],
            stool_cs: [{ rate: '', condition: '' }],
            others: [{ rate: '', condition: '' }],
        },
    ],
    ultra_snow_gram: [{ details: '', condition: '' }],
    x_ray: [{ details: '', condition: '' }],
    ecg: [{ details: '', condition: '' }],
    eco_ett: [{ details: '', condition: '' }],
    c_t_scan: [{ details: '', condition: '' }],
    others: [{ details: '', condition: '' }],
    patient_id: props.patient,
    date: '',
});

const sections = ref({
    hematology: true,
    biochemistry: false,
    stool: false,
    urine: false,
    serology: false,
    immunology: false,
    blood_bank: false,
    histopathology_cytology: false,
    microbiology: false,
    ultra_snow_gram: false,
    x_ray: false,
    ecg: false,
    eco_ett: false,
    c_t_scan: false,
    others: false,
});

const toggleSection = (section) => {
    sections.value[section] = !sections.value[section];
};

const submitPatientReport = () =>
    reportForm.post(route('patient.report.store'), {
        preserveScroll: true,
        onSuccess: () => {
            toast.success('Patient Report Stored Successfully!');
            reportForm.reset();
        },
    });
</script>

<template>
    <StaffLayout :currentUrl="currentUrl" :title="title">
        <Head title="Patient Report Create" />
        <div class="main">
            <div class="main-content dashboard">
                <div class="row">
                    <div class="col-12">
                        <div class="box">
                            <div class="box-header pt-0">
                                <div class="me-auto">
                                    <h4 class="card-title mb-0 fs-22">Patient Report Create</h4>
                                </div>
                            </div>
                            <div class="box-body pb-0 activity mt-18">
                                <form class="form" @submit.prevent="submitPatientReport">
                                    <!-- Hematology Section -->
                                    <h5 @click="toggleSection('hematology')" class="cursor-pointer mb-4">
                                        Hematology
                                        <span class="float-end" v-if="sections.hematology"><button type="button" class="btn btn-sm btn-danger">-</button></span>
                                        <span class="float-end" v-else><button type="button" class="btn btn-sm btn-success">+</button></span>
                                    </h5>
                                    <div v-if="sections.hematology" class="mb-4">
                                        <div v-for="(field, fieldName) in reportForm.hematology[0]" :key="fieldName" class="mb-4">
                                            <h6>{{ fieldName.replace(/_/g, ' ').toUpperCase() }}</h6>
                                            <ReportTestFields
                                                v-for="(item, index) in field"
                                                :key="index"
                                                :field="reportForm.hematology[0][fieldName][index]"
                                                :error="reportForm.errors.hematology?.[0]?.[fieldName]?.[index]"
                                            />
                                        </div>
                                    </div>

                                    <!-- Biochemistry Section -->
                                    <h5 @click="toggleSection('biochemistry')" class="cursor-pointer mb-4">
                                        Biochemistry
                                        <span class="float-end" v-if="sections.biochemistry"><button type="button" class="btn btn-sm btn-danger">-</button></span>
                                        <span class="float-end" v-else><button type="button" class="btn btn-sm btn-success">+</button></span>
                                    </h5>
                                    <div v-if="sections.biochemistry" class="mb-4">
                                        <div v-for="(field, fieldName) in reportForm.biochemistry[0]" :key="fieldName" class="mb-4">
                                            <h6>{{ fieldName.replace(/_/g, ' ').toUpperCase() }}</h6>
                                            <ReportTestFields
                                                v-for="(item, index) in field"
                                                :key="index"
                                                :field="reportForm.biochemistry[0][fieldName][index]"
                                                :error="reportForm.errors.biochemistry?.[0]?.[fieldName]?.[index]"
                                            />
                                        </div>
                                    </div>

                                    <!-- Stool Section -->
                                    <h5 @click="toggleSection('stool')" class="cursor-pointer mb-4">
                                        Stool
                                        <span class="float-end" v-if="sections.stool"><button type="button" class="btn btn-sm btn-danger">-</button></span>
                                        <span class="float-end" v-else><button type="button" class="btn btn-sm btn-success">+</button></span>
                                    </h5>
                                    <div v-if="sections.stool" class="mb-4">
                                        <div v-for="(field, fieldName) in reportForm.stool[0]" :key="fieldName" class="mb-4">
                                            <h6>{{ fieldName.replace(/_/g, ' ').toUpperCase() }}</h6>
                                            <ReportTestFields
                                                v-for="(item, index) in field"
                                                :key="index"
                                                :field="reportForm.stool[0][fieldName][index]"
                                                :error="reportForm.errors.stool?.[0]?.[fieldName]?.[index]"
                                            />
                                        </div>
                                    </div>

                                    <!-- Urine Section -->
                                    <h5 @click="toggleSection('urine')" class="cursor-pointer mb-4">
                                        Urine
                                        <span class="float-end" v-if="sections.urine"><button type="button" class="btn btn-sm btn-danger">-</button></span>
                                        <span class="float-end" v-else><button type="button" class="btn btn-sm btn-success">+</button></span>
                                    </h5>
                                    <div v-if="sections.urine" class="mb-4">
                                        <div v-for="(field, fieldName) in reportForm.urine[0]" :key="fieldName" class="mb-4">
                                            <h6>{{ fieldName.replace(/_/g, ' ').toUpperCase() }}</h6>
                                            <ReportTestFields
                                                v-for="(item, index) in field"
                                                :key="index"
                                                :field="reportForm.urine[0][fieldName][index]"
                                                :error="reportForm.errors.urine?.[0]?.[fieldName]?.[index]"
                                            />
                                        </div>
                                    </div>

                                    <!-- Serology Section -->
                                    <h5 @click="toggleSection('serology')" class="cursor-pointer mb-4">
                                        Serology
                                        <span class="float-end" v-if="sections.serology"><button type="button" class="btn btn-sm btn-danger">-</button></span>
                                        <span class="float-end" v-else><button type="button" class="btn btn-sm btn-success">+</button></span>
                                    </h5>
                                    <div v-if="sections.serology" class="mb-4">
                                        <div v-for="(field, fieldName) in reportForm.serology[0]" :key="fieldName" class="mb-4">
                                            <h6>{{ fieldName.replace(/_/g, ' ').toUpperCase() }}</h6>
                                            <ReportTestFields
                                                v-for="(item, index) in field"
                                                :key="index"
                                                :field="reportForm.serology[0][fieldName][index]"
                                                :error="reportForm.errors.serology?.[0]?.[fieldName]?.[index]"
                                            />
                                        </div>
                                    </div>

                                    <!-- Immunology Section -->
                                    <h5 @click="toggleSection('immunology')" class="cursor-pointer mb-4">
                                        Immunology
                                        <span class="float-end" v-if="sections.immunology"><button type="button" class="btn btn-sm btn-danger">-</button></span>
                                        <span class="float-end" v-else><button type="button" class="btn btn-sm btn-success">+</button></span>
                                    </h5>
                                    <div v-if="sections.immunology" class="mb-4">
                                        <div v-for="(field, fieldName) in reportForm.immunology[0]" :key="fieldName" class="mb-4">
                                            <h6>{{ fieldName.replace(/_/g, ' ').toUpperCase() }}</h6>
                                            <ReportTestFields
                                                v-for="(item, index) in field"
                                                :key="index"
                                                :field="reportForm.immunology[0][fieldName][index]"
                                                :error="reportForm.errors.immunology?.[0]?.[fieldName]?.[index]"
                                            />
                                        </div>
                                    </div>

                                    <!-- Blood Bank Section -->
                                    <h5 @click="toggleSection('blood_bank')" class="cursor-pointer mb-4">
                                        Blood Bank
                                        <span class="float-end" v-if="sections.blood_bank"><button type="button" class="btn btn-sm btn-danger">-</button></span>
                                        <span class="float-end" v-else><button type="button" class="btn btn-sm btn-success">+</button></span>
                                    </h5>
                                    <div v-if="sections.blood_bank" class="mb-4">
                                        <div v-for="(field, fieldName) in reportForm.blood_bank[0]" :key="fieldName" class="mb-4">
                                            <h6>{{ fieldName.replace(/_/g, ' ').toUpperCase() }}</h6>
                                            <ReportTestFields
                                                v-for="(item, index) in field"
                                                :key="index"
                                                :field="reportForm.blood_bank[0][fieldName][index]"
                                                :error="reportForm.errors.blood_bank?.[0]?.[fieldName]?.[index]"
                                            />
                                        </div>
                                    </div>

                                    <!-- Histopathology Cytology Section -->
                                    <h5 @click="toggleSection('histopathology_cytology')" class="cursor-pointer mb-4">
                                        Histopathology Cytology
                                        <span class="float-end" v-if="sections.histopathology_cytology"><button type="button" class="btn btn-sm btn-danger">-</button></span>
                                        <span class="float-end" v-else><button type="button" class="btn btn-sm btn-success">+</button></span>
                                    </h5>
                                    <div v-if="sections.histopathology_cytology" class="mb-4">
                                        <div v-for="(field, fieldName) in reportForm.histopathology_cytology[0]" :key="fieldName" class="mb-4">
                                            <h6>{{ fieldName.replace(/_/g, ' ').toUpperCase() }}</h6>
                                            <ReportTestFields
                                                v-for="(item, index) in field"
                                                :key="index"
                                                :field="reportForm.histopathology_cytology[0][fieldName][index]"
                                                :error="reportForm.errors.histopathology_cytology?.[0]?.[fieldName]?.[index]"
                                            />
                                        </div>
                                    </div>

                                    <!-- Microbiology Section -->
                                    <h5 @click="toggleSection('microbiology')" class="cursor-pointer mb-4">
                                        Microbiology
                                        <span class="float-end" v-if="sections.microbiology"><button type="button" class="btn btn-sm btn-danger">-</button></span>
                                        <span class="float-end" v-else><button type="button" class="btn btn-sm btn-success">+</button></span>
                                    </h5>
                                    <div v-if="sections.microbiology" class="mb-4">
                                        <div v-for="(field, fieldName) in reportForm.microbiology[0]" :key="fieldName" class="mb-4">
                                            <h6>{{ fieldName.replace(/_/g, ' ').toUpperCase() }}</h6>
                                            <ReportTestFields
                                                v-for="(item, index) in field"
                                                :key="index"
                                                :field="reportForm.microbiology[0][fieldName][index]"
                                                :error="reportForm.errors.microbiology?.[0]?.[fieldName]?.[index]"
                                            />
                                        </div>
                                    </div>

                                    <!-- Ultra Snow Gram Section -->
                                    <h5 @click="toggleSection('ultra_snow_gram')" class="cursor-pointer mb-4">
                                        Ultra Snow Gram
                                        <span class="float-end" v-if="sections.ultra_snow_gram"><button type="button" class="btn btn-sm btn-danger">-</button></span>
                                        <span class="float-end" v-else><button type="button" class="btn btn-sm btn-success">+</button></span>
                                    </h5>
                                    <div v-if="sections.ultra_snow_gram" class="mb-4">
                                        <div class="row mb-4">
                                            <div class="col-lg-6 col-md-6 mb-2">
                                                <div class="form-group">
                                                    <label>Details</label><br />
                                                    <input type="text" class="form-control" v-model="reportForm.ultra_snow_gram[0].details" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 mb-2">
                                                <div class="form-group">
                                                    <label>Condition</label><br />
                                                    <input type="text" class="form-control" v-model="reportForm.ultra_snow_gram[0].condition" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- X-Ray Section -->
                                    <h5 @click="toggleSection('x_ray')" class="cursor-pointer mb-4">
                                        X-Ray
                                        <span class="float-end" v-if="sections.x_ray"><button type="button" class="btn btn-sm btn-danger">-</button></span>
                                        <span class="float-end" v-else><button type="button" class="btn btn-sm btn-success">+</button></span>
                                    </h5>
                                    <div v-if="sections.x_ray" class="mb-4">
                                        <div class="row mb-4">
                                            <div class="col-lg-6 col-md-6 mb-2">
                                                <div class="form-group">
                                                    <label>Details</label><br />
                                                    <input type="text" class="form-control" v-model="reportForm.x_ray[0].details" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 mb-2">
                                                <div class="form-group">
                                                    <label>Condition</label><br />
                                                    <input type="text" class="form-control" v-model="reportForm.x_ray[0].condition" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Ecg Section -->
                                    <h5 @click="toggleSection('ecg')" class="cursor-pointer mb-4">
                                        ECG
                                        <span class="float-end" v-if="sections.ecg"><button type="button" class="btn btn-sm btn-danger">-</button></span>
                                        <span class="float-end" v-else><button type="button" class="btn btn-sm btn-success">+</button></span>
                                    </h5>
                                    <div v-if="sections.ecg" class="mb-4">
                                        <div class="row mb-4">
                                            <div class="col-lg-6 col-md-6 mb-2">
                                                <div class="form-group">
                                                    <label>Details</label><br />
                                                    <input type="text" class="form-control" v-model="reportForm.ecg[0].details" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 mb-2">
                                                <div class="form-group">
                                                    <label>Condition</label><br />
                                                    <input type="text" class="form-control" v-model="reportForm.ecg[0].condition" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Echo Section -->
                                    <h5 @click="toggleSection('eco_ett')" class="cursor-pointer mb-4">
                                       Echo/ETT
                                        <span class="float-end" v-if="sections.eco_ett"><button type="button" class="btn btn-sm btn-danger">-</button></span>
                                        <span class="float-end" v-else><button type="button" class="btn btn-sm btn-success">+</button></span>
                                    </h5>
                                    <div v-if="sections.eco_ett" class="mb-4">
                                        <div class="row mb-4">
                                            <div class="col-lg-6 col-md-6 mb-2">
                                                <div class="form-group">
                                                    <label>Details</label><br />
                                                    <input type="text" class="form-control" v-model="reportForm.eco_ett[0].details" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 mb-2">
                                                <div class="form-group">
                                                    <label>Condition</label><br />
                                                    <input type="text" class="form-control" v-model="reportForm.eco_ett[0].condition" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- c_t_scan Section -->
                                    <h5 @click="toggleSection('c_t_scan')" class="cursor-pointer mb-4">
                                        C.T Scan
                                        <span class="float-end" v-if="sections.c_t_scan"><button type="button" class="btn btn-sm btn-danger">-</button></span>
                                        <span class="float-end" v-else><button type="button" class="btn btn-sm btn-success">+</button></span>
                                    </h5>
                                    <div v-if="sections.c_t_scan" class="mb-4">
                                        <div class="row mb-4">
                                            <div class="col-lg-6 col-md-6 mb-2">
                                                <div class="form-group">
                                                    <label>Details</label><br />
                                                    <input type="text" class="form-control" v-model="reportForm.c_t_scan[0].details" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 mb-2">
                                                <div class="form-group">
                                                    <label>Condition</label><br />
                                                    <input type="text" class="form-control" v-model="reportForm.c_t_scan[0].condition" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- others Section -->
                                    <h5 @click="toggleSection('others')" class="cursor-pointer mb-4">
                                        Others
                                        <span class="float-end" v-if="sections.others"><button type="button" class="btn btn-sm btn-danger">-</button></span>
                                        <span class="float-end" v-else><button type="button" class="btn btn-sm btn-success">+</button></span>
                                    </h5>
                                    <div v-if="sections.others" class="mb-4">
                                        <div class="row mb-4">
                                            <div class="col-lg-6 col-md-6 mb-2">
                                                <div class="form-group">
                                                    <label>Details</label><br />
                                                    <input type="text" class="form-control" v-model="reportForm.others[0].details" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 mb-2">
                                                <div class="form-group">
                                                    <label>Condition</label><br />
                                                    <input type="text" class="form-control" v-model="reportForm.others[0].condition" />
                                                </div>
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
