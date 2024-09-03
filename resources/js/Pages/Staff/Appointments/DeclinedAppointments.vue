<script setup>

import StaffLayout from "@/Layouts/StaffLayout.vue";
import {Head, Link, useForm} from "@inertiajs/vue3";
import Datepicker from 'vue3-datepicker';
import {useToast} from "vue-toastification";
import InputError from "@/Components/InputError.vue";
import {ref} from "vue";

const sl = 1;

const toast = useToast();

defineProps({
    currentUrl:String,
    title: {
        type: String,
        default: 'Declined Appointments'
    },
    appointments:Object
})

const closeModal = () => {
    // Hide modal using jQuery
    $(`.modal`).modal('hide');

    // Manually remove modal backdrop
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();

    // Clear form data or reset state as needed
    selectedAppointment.value = null;
};

const form = useForm({
    'app_date' : '',
    'app_time' : '',
});

const approveAppoinment = async (appointmentId) =>{
    const response = await fetch(route('new.appointments.approve', appointmentId));
    console.log(response)
    if (response.ok){
        toast.success('Appointment successfully booked!');
    }
}

const declineAppoinment = async (appointmentId) =>{
    const response = await fetch(route('new.appointments.decline', appointmentId));
    console.log(response)
    if (response.ok){
        toast.error('Appointment Declined!');
    }
}

const updateAppointment = (appointmentId) => form.post(route('new.appointments.changeDateTime',appointmentId),{
    preserveScroll: true,
    onSuccess: () => {
        toast.success('Appointment successfully Updated!');
        form.reset();
        closeModal();
    }
})
</script>

<template>
    <StaffLayout :currentUrl="currentUrl" :title="title">
        <Head title="Declined Appointments" />
        <div class="main">
            <div class="main-content dashboard">
                <div class="row">
                    <div class="col-12">
                        <div class="box ">
                            <div class="box-header  pt-0">
                                <div class="me-auto">
                                    <h4 class="card-title mb-0 fs-22">Declined Appointments List</h4>

                                </div>

                            </div>
                            <div class="box-body pb-0 table-responsive activity mt-18">
                                <table class="table table-vcenter text-nowrap table-bordered dataTable no-footer mw-100" id="task-profile" role="grid">
                                    <thead>
                                    <tr class="top">
                                        <th class="border-bottom-0 sorting fs-14 font-w500" tabindex="0" aria-controls="task-profile" rowspan="1" colspan="1" style="width: 50px;">SL</th>
                                        <th class="border-bottom-0 sorting fs-14 font-w500" tabindex="0" aria-controls="task-profile" rowspan="1" colspan="1" style="width: 222.312px;">Patient Id</th>
                                        <th class="border-bottom-0 sorting fs-14 font-w500" tabindex="0" aria-controls="task-profile" rowspan="1" colspan="1" style="width: 222.312px;">Patient Name</th>
                                        <th class="border-bottom-0 sorting fs-14 font-w500" tabindex="0" aria-controls="task-profile" rowspan="1" colspan="1" style="width: 84.8281px;">Phone</th>
                                        <th class="border-bottom-0 sorting fs-14 font-w500" tabindex="0" aria-controls="task-profile" rowspan="1" colspan="1" style="width: 87.9844px;">Appointment Schedule</th>
                                        <th class="border-bottom-0 sorting fs-14 font-w500" tabindex="0" aria-controls="task-profile" rowspan="1" colspan="1" style="width: 110.719px;">Appointment Status</th>
                                        <th class="border-bottom-0 sorting_disabled fs-14 font-w500" rowspan="1" colspan="1" style="width: 145.391px;">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="appointment in appointments.data" :key="appointment.id">
                                        <td>
                                           {{ sl++ }}
                                        </td>
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
                                        <td v-if="appointment.app_status === '0'">
                                            <span class="badge badge-warning">On hold</span>
                                        </td>

                                        <td v-else-if="appointment.app_status === '1'">
                                            <span class="badge badge-success">Approved</span>
                                        </td>

                                        <td v-else>
                                            <span class="badge badge-danger">Declined</span>
                                        </td>


                                        <td>
                                            <a class="btn btn-primary" href="#" data-toggle="modal" :data-target="`#add_project-${appointment.id}`">
                                                View Appointment
                                            </a>
                                        </td>

                                        <div :id="`add_project-${appointment.id}`" class="modal custom-modal fade" role="dialog">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Appointment Information : {{ appointment.app_id }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-sm-6 mb-10">
                                                                <h5>Patient Name:</h5>
                                                                <h6>{{ appointment.app_name }}</h6>
                                                            </div>
                                                            <div class="col-sm-6 mb-10">
                                                                <h5>Patient Email:</h5>
                                                                <h6>{{ appointment.app_email }}</h6>
                                                            </div>

                                                            <div class="col-sm-6 mb-10">
                                                                <h5>Patient Phone:</h5>
                                                                <h6>{{ appointment.app_phone }}</h6>
                                                            </div>

                                                            <div class="col-sm-6 mb-10">
                                                                <h5>Patient Gender:</h5>
                                                                <h6>{{ appointment.app_gender }}</h6>
                                                            </div>

                                                            <div class="col-sm-6 mb-10">
                                                                <h5>Patient Age:</h5>
                                                                <h6>{{ appointment.app_age }}</h6>
                                                            </div>

                                                            <div class="col-sm-6 mb-10">
                                                                <h5>Department :</h5>
                                                                <h6>{{ appointment.department.department_name }}</h6>
                                                            </div>

                                                            <div class="col-sm-6 mb-10">
                                                                <h5>Doctor :</h5>
                                                                <h6>{{ appointment.doctor.name }}</h6>
                                                            </div>

                                                            <div class="col-sm-6 mb-10">
                                                                <h5>Appointment Date :</h5>
                                                                <h6>{{ appointment.app_date }}</h6>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-6 mb-10">
                                                                <a class="btn btn-success" @click="approveAppoinment(appointment.id)">Approve Appointment</a>
                                                            </div>
                                                            <div class="col-6 mb-10">
                                                                <a class="btn btn-danger" @click="declineAppoinment(appointment.id)">Decline Appointment</a>
                                                            </div>
                                                        </div>

                                                        <form class="form" action="#" @submit.prevent="updateAppointment(appointment.id)">
                                                            <div class="row">
                                                                <div class="col-6 mb-10">
                                                                    <div class="form-group">
                                                                        <label>Change Appointment Date</label><br>
<!--                                                                         <VueDatePicker v-model="form.app_date"></VueDatePicker>-->
                                                                        <Datepicker class="form-control" v-model="form.app_date"/>

                                                                        <InputError :message="form.errors.app_date" class="mt-2 text-danger" />
<!--                                                                        <input class="form-control" type="date" v-model="form.app_date">-->
                                                                    </div>
                                                                </div>
                                                                <div class="col-6 mb-10">
                                                                    <div class="form-group">
                                                                        <label>Change Appointment Time</label><br>
                                                                        <select class="form-control" v-model="form.app_time">
                                                                            <option value="" disabled selected>Select One</option>
                                                                            <option value="8:00">8:00</option>
                                                                            <option value="9:00">9:00</option>
                                                                            <option value="10:00">10:00</option>
                                                                            <option value="11:00">11:00</option>
                                                                            <option value="12:00">12:00</option>
                                                                            <option value="13:00">13:00</option>
                                                                            <option value="14:00">14:00</option>
                                                                            <option value="15:00">15:00</option>
                                                                            <option value="16:00">16:00</option>
                                                                            <option value="17:00">17:00</option>
                                                                            <option value="18:00">18:00</option>
                                                                            <option value="19:00">19:00</option>
                                                                            <option value="20:00">20:00</option>
                                                                            <option value="21:00">21:00</option>
                                                                        </select>
                                                                        <InputError :message="form.errors.app_time" class="mt-2 text-danger" />
                                                                    </div>
                                                                </div>
                                                                <div class="submit-section">
                                                                    <button class="btn btn-primary submit-btn">Save</button>
                                                                </div>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
