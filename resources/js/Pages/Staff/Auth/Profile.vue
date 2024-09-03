<script setup>

import StaffLayout from "@/Layouts/StaffLayout.vue";
import {Head, Link} from "@inertiajs/vue3";

const props = defineProps({
    currentUrl:String,
    title: {
        type: String,
        default: 'Staff Profile',
    },
    user: Object,
    department: Object,
})
const getImageUrl = (imagePath) => {
    return `${props.currentUrl.replace('/profile', '')}/${imagePath}`;
}
</script>

<template>
    <StaffLayout :currentUrl="currentUrl" :title="title">
        <Head title="Staff Profile" />
        <div class="main">
            <div class="main-content dashboard">
                <div class="row">
                    <div class="col-12">
                        <div class="box user-pro-list ">
                            <div class="box-body">
                                <div class="user-pic text-center">
                                    <div class="avatar ">
                                        <img v-if="user.profile_photo_path" :src="getImageUrl(user.profile_photo_path)" style="height: 110px" alt="">

                                        <img v-else src="/upload/no_img.jpg" style="height: 110px" alt="">
                                        <div class="pulse-css"></div>
                                    </div>
                                    <div class="pro-user mt-40">
                                        <h5 class="pro-user-username text-dark mb-1 fs-15" style="color: blue !important">{{ user.name }}</h5>
                                        <h6 class="pro-user-desc text-muted fs-14">{{ user.email }}</h6>

                                    </div>
                                </div>
                            </div>


                            <div class="box-footer pt-38">
                                <div class="btn-list text-center">
                                    <Link :href="route('staff.profile_edit')" class="btn btn-light">Edit Profile </Link>
                                    <Link :href="route('staff.change_password')" class="btn btn-light ml-4">Change Password </Link>
                                </div>
                            </div>

                            <div class="box left-dot pt-39 mb-30">
                                <div class="box-header  border-0 ">
                                    <div class="box-title fs-20 font-w600">Basic Info</div>
                                </div>
                                <div class="box-body pt-16 user-profile">
                                    <div class="table-responsive">
                                        <table class="table mb-0 mw-100 color-span">
                                            <tbody>
                                            <tr>
                                                <td class="py-2 px-0"> <span class="w-50">Employee ID</span> </td>
                                                <td>:</td>
                                                <td class="py-2 px-0"> <span class="">{{ user.staff_information.emp_id ?? '' }}</span> </td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 px-0"> <span class="w-50">Phone Number</span> </td>
                                                <td>:</td>
                                                <td class="py-2 px-0"> <span class="">{{ user.phone }}</span> </td>
                                            </tr>

                                            <tr>
                                                <td class="py-2 px-0"> <span class="w-50">Designation</span> </td>
                                                <td>:</td>
                                                <td class="py-2 px-0"> <span class="">{{ user.staff_information.designation ?? '' }} {{ user.emp_type }}</span> </td>
                                            </tr>

                                            <tr>
                                                <td class="py-2 px-0"> <span class="w-50">Employment Type</span> </td>
                                                <td>:</td>
                                                <td class="py-2 px-0"> <span class="">{{ user.staff_information.employment_type ?? '' }}</span> </td>
                                            </tr>

                                            <template v-if="user.emp_type == 'DOCTOR'">
                                                <tr>
                                                    <td class="py-2 px-0"> <span class="w-50">Department</span> </td>
                                                    <td>:</td>
                                                    <td class="py-2 px-0"> <span class="">{{ department.department_name }}</span> </td>
                                                </tr>

                                                <tr>
                                                    <td class="py-2 px-0"> <span class="w-50">Speciality</span> </td>
                                                    <td>:</td>
                                                    <td class="py-2 px-0"> <span class="">{{ user.staff_information.speciality ?? '' }}</span> </td>
                                                </tr>

                                                <tr>
                                                    <td class="py-2 px-0"> <span class="w-50">Doctor Type</span> </td>
                                                    <td>:</td>
                                                    <td class="py-2 px-0"> <span class="">{{ user.staff_information.doctor_type ?? '' }}</span> </td>
                                                </tr>
                                            </template>

                                            <tr>
                                                <td class="py-2 px-0"> <span class="w-50">Joining Date</span> </td>
                                                <td>:</td>
                                                <td class="py-2 px-0"> <span class="">{{ user.staff_information.joining_date ?? '' }}</span> </td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </StaffLayout>
</template>
