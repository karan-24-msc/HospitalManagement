<script setup>

import StaffLayout from "@/Layouts/StaffLayout.vue";
import {Head, Link} from "@inertiajs/vue3";

defineProps({
    currentUrl:String,
    title: {
        type: String,
        default: 'Dashboard',
    },
    patients: String,
    appointments: String,
    totalPatients: String
})
</script>

<template>
   <StaffLayout :currentUrl="currentUrl" :title="title">
       <Head title="Dashboard" />
       <div class="main">
           <div class="main-content dashboard">
               <div class="row">
                   <div class="col-12">
                       <div class="box card-box">
                           <template v-if="$page.props.auth.user.emp_type == 'DOCTOR'">
                               <div class="icon-box bg-color-1">
                                   <Link :href="route('new.appointments')" class="d-flex">
                                       <div class="icon bg-icon-1">
                                           <i class="bx bxs-user bx-tada bx-tada"></i>
                                       </div>
                                       <div class="content">
                                           <h5 class="title-box">Appointments</h5>
                                           <p class="color-1 mb-0 pt-4">{{ appointments }} New Appointments</p>
                                       </div>
                                   </Link>
                               </div>
                               <div class="icon-box bg-color-2">
                                   <Link :href="route('new.patients')" class="d-flex">
                                       <div class="icon bg-icon-2">
                                           <i class='bx bxs-user'></i>
                                       </div>
                                       <div class="content click-c">
                                           <h5 class="title-box">New Patients</h5>
                                           <p class="color-2 mb-0 pt-4">{{ patients }} New Patients</p>
                                       </div>
                                   </Link>
                               </div>
                               <div class="icon-box bg-color-3">
                                   <div class="icon bg-icon-3">
                                       <i class="bx bxs-user"></i>
                                   </div>
                                   <div class="content">
                                       <h5 class="title-box">Total Patients</h5>
                                       <p class="color-3 mb-0 pt-4">{{ totalPatients }} Total Patients</p>
                                   </div>
                               </div>
                               <div class="icon-box bg-color-4">
                                   <Link :href="route('create.patient')" class="d-flex">
                                       <div class="icon bg-white">
                                           <i class="bx bx-plus"></i>
                                       </div>
                                       <div class="content d-flex align-items-center">
                                           <h5 class="color-white">Create New Patient</h5>
                                       </div>
                                   </Link>
                               </div>
                           </template>

                           <template v-else>
                               <h4>Welcome to your Dashboard - {{ $page.props.auth.user.name }}</h4>
                           </template>
                       </div>
                   </div>

               </div>





               <div id="add_project" class="modal custom-modal fade" role="dialog">
                   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                       <div class="modal-content">
                           <div class="modal-header">
                               <h5 class="modal-title">Create Project</h5>
                               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                   <span aria-hidden="true">&times;</span>
                               </button>
                           </div>
                           <div class="modal-body">
                               <form>
                                   <div class="row">
                                       <div class="col-sm-6 mb-0">
                                           <div class="form-group">
                                               <label>Project Name</label>
                                               <input class="form-control" value="" type="text">
                                           </div>
                                       </div>
                                       <div class="col-sm-6 mb-0">
                                           <div class="form-group">
                                               <label>Client</label>
                                               <select class="select">
                                                   <option>Client 1</option>
                                                   <option>Client 2</option>
                                               </select>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="row">
                                       <div class="col-sm-6 mb-0">
                                           <div class="form-group">
                                               <label>Start Date</label>
                                               <div class="cal-icon">
                                                   <input class="form-control " type="date">
                                               </div>
                                           </div>
                                       </div>
                                       <div class="col-sm-6 mb-0">
                                           <div class="form-group">
                                               <label>End Date</label>
                                               <div class="cal-icon">
                                                   <input class="form-control" type="date">
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="row">
                                       <div class="col-sm-3 mb-0">
                                           <div class="form-group">
                                               <label>Rate</label>
                                               <input placeholder="$50" class="form-control" value="" type="text">
                                           </div>
                                       </div>
                                       <div class="col-sm-3 mb-0">
                                           <div class="form-group">
                                               <label>&nbsp;</label>
                                               <select class="select">
                                                   <option>Hourly</option>
                                                   <option selected>Fixed</option>
                                               </select>
                                           </div>
                                       </div>
                                       <div class="col-sm-6 mb-0">
                                           <div class="form-group">
                                               <label>Priority</label>
                                               <select class="select">
                                                   <option selected>High</option>
                                                   <option>Medium</option>
                                                   <option>Low</option>
                                               </select>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label>Description</label>
                                       <textarea rows="4" class="form-control" placeholder="Enter your message here"></textarea>
                                   </div>
                                   <div class="form-group">
                                       <label>Upload Files</label>
                                       <input class="form-control" type="file">
                                   </div>
                                   <div class="submit-section">
                                       <button class="btn btn-primary submit-btn">Save</button>
                                   </div>
                               </form>
                           </div>
                       </div>
                   </div>
               </div>

               <div class="modal custom-modal fade" id="delete_project" role="dialog">
                   <div class="modal-dialog modal-dialog-centered">
                       <div class="modal-content">
                           <div class="modal-body">
                               <div class="form-header">
                                   <h3>Delete Project</h3>
                                   <p>Are you sure want to delete?</p>
                               </div>
                               <div class="modal-btn delete-action">
                                   <div class="row">
                                       <div class="col-6 mb-0">
                                           <a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
                                       </div>
                                       <div class="col-6 mb-0">
                                           <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>

               <div class="modal custom-modal fade" id="edit_project" role="dialog">
                   <div class="modal-dialog modal-dialog-centered">
                       <div class="modal-content">
                           <div class="modal-body">
                               <div class="form-header">
                                   <h5 class="modal-title">Edit Project</h5>
                               </div>
                           </div>
                           <div class="modal-body">
                               <form>
                                   <div class="row">
                                       <div class="col-sm-6 mb-0">
                                           <div class="form-group">
                                               <label>Project Name</label>
                                               <input class="form-control" value="Gold App" type="text">
                                           </div>
                                       </div>
                                       <div class="col-sm-6 mb-0">
                                           <div class="form-group">
                                               <label>Client</label>
                                               <select class="select">
                                                   <option>Client 1</option>
                                                   <option>Client 2</option>
                                               </select>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="submit-section">
                                       <button class="btn btn-primary submit-btn">Save</button>
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
