<script setup>

import StaffLayout from "@/Layouts/StaffLayout.vue";
import {Head} from "@inertiajs/vue3";
import {useToast} from "vue-toastification";
import {onMounted, ref} from "vue";

const toast = useToast();

const appointments = ref([]);

const props = defineProps({
    currentUrl:String,
    title: {
        type: String,
        default: 'Approved Appointments'
    },
    //appointments:Object
})

const fetchAppointments = async () => {
    try {
        const response = await fetch(route('approved.appointments.data'));
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        const data = await response.json();
        //console.log(data);
        appointments.value = data.appointments;
    } catch (error) {
        console.error('Error fetching appointments:', error);
    }
};

onMounted(() => {
    fetchAppointments();
});
const createPatientData = async (appointmentId) =>{
    const response = await fetch(route('appointment.patientCreate', appointmentId));
    console.log(response)
    if (response.ok){
        toast.success('Patient Data Created');
        fetchAppointments();
    }
}
</script>

<template>
    <StaffLayout :currentUrl="currentUrl" :title="title">
        <Head title="Approved Appointments" />
        <div class="main">
            <div class="main-content dashboard">
                <div class="row">
                    <div class="col-12">
                        <div class="box ">
                            <div class="box-header  pt-0">
                                <div class="me-auto">
                                    <h4 class="card-title mb-0 fs-22">New Appointments List</h4>

                                </div>

                            </div>
                            <div class="box-body pb-0 table-responsive activity mt-18">
                                <table class="table table-vcenter text-nowrap table-bordered dataTable no-footer mw-100" id="task-profile" role="grid">
                                    <thead>
                                    <tr class="top">
                                        <th class="border-bottom-0 sorting fs-14 font-w500" tabindex="0" aria-controls="task-profile" rowspan="1" colspan="1" style="width: 222.312px;">Patient Id</th>
                                        <th class="border-bottom-0 sorting fs-14 font-w500" tabindex="0" aria-controls="task-profile" rowspan="1" colspan="1" style="width: 222.312px;">Patient Name</th>
                                        <th class="border-bottom-0 sorting fs-14 font-w500" tabindex="0" aria-controls="task-profile" rowspan="1" colspan="1" style="width: 84.8281px;">Phone</th>
                                        <th class="border-bottom-0 sorting fs-14 font-w500" tabindex="0" aria-controls="task-profile" rowspan="1" colspan="1" style="width: 87.9844px;">Appointment Schedule</th>
                                        <th class="border-bottom-0 sorting_disabled fs-14 font-w500" rowspan="1" colspan="1" style="width: 145.391px;">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="appointment in appointments">
                                        <td>
                                            {{ appointment.app_id }}
                                        </td>
                                        <td>
                                            {{ appointment.app_name }}
                                        </td>
                                        <td>{{ appointment.app_phone }}</td>
                                        <td>
                                            {{ appointment.app_date }}
                                        </td>

                                        <td>
                                            <a v-if="appointment.patient_status == 0" class="btn btn-primary"  @click="createPatientData(appointment.id)">
                                                Create Patient Data
                                            </a>
                                            <template v-else>--</template>
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
<!--v-if="appointment.patient_status == '0'"-->
