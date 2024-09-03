<script setup>
import { Link, router, usePage } from "@inertiajs/vue3";
import { ref, watchEffect } from 'vue';
import sideBarMenu from '@/Composibles/sidebarMenu.js'

const { props } = usePage();
const empType = props.auth.user.emp_type; // assuming emp_type is passed through the props

const sidebarMenu = ref(sideBarMenu(empType));

const isSidebarOpen = ref(true);

const prop = defineProps({
    currentUrl:String,
    title:String
})

const getImageUrl = (imagePath) => {
    return `http://127.0.0.1:8000/${imagePath}`;
}
function toggleSidebar() {
    isSidebarOpen.value = !isSidebarOpen.value;
}

document.addEventListener('DOMContentLoaded', () => {
    toggleBodyClass();
});
watchEffect(() => {
    toggleBodyClass();
});

function toggleBodyClass() {
    if (!isSidebarOpen.value) {
        document.body.classList.add('sidebar-closed');
    } else {
        document.body.classList.remove('sidebar-closed');
    }
}

function toggleDropdown(index) {
    sidebarMenu.value[index].active = !sidebarMenu.value[index].active;
}


const isActive = (menuItem) => {
    if (menuItem.link === prop.currentUrl) {
        return true;
    }
    if (menuItem.children) {
        return menuItem.children.some(child => isActive(child));
    }
    return false;
};


const logout = () => {
    router.post(route('logout'));
};
</script>

<template>

    <!-- SIDEBAR -->
    <div class="sidebar" :class="{ 'active': isSidebarOpen }">
        <div class="sidebar-logo">
            <Link :href="route('dashboard')" class="active">
                <img :src="getImageUrl($page.props.siteInformation?.logo)" height="90px" alt="Protend logo">
            </Link>
            <a class="sidebar-close" @click="toggleSidebar">
                <i :class="isSidebarOpen ? 'bx bx-left-arrow-alt' : 'bx bx-menu'"></i>
            </a>
        </div>
        <div class="simplebar-sc" data-simplebar>
            <ul class="sidebar-menu tf">
                <li v-for="(menu, index) in sidebarMenu" :key="index" :class="{ 'sidebar-submenu': menu.children }">
                    <Link v-if="!menu.children" :href="menu.link" :class="{ 'active': isActive(menu) }">
                        <i :class="menu.icon"></i>
                        <span>{{ menu.label }}</span>
                    </Link>
                    <a v-else class="sidebar-menu-dropdown" :class="{ 'active': isActive(menu) }" @click="toggleDropdown(index)">
                        <i :class="menu.icon"></i>
                        <span>{{ menu.label }}</span>
                        <div class="dropdown-icon"><i class='bx bx-chevron-down' :class="{ 'active': menu.active }"></i></div>
                    </a>
                    <ul v-if="menu.children" class="sidebar-menu sidebar-menu-dropdown-content" :class="{ 'active': menu.active }">
                        <li v-for="(child, childIndex) in menu.children" :key="childIndex">
                            <Link :href="child.link" :class="{ 'active': isActive(child) }">{{ child.label }}</Link>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="darkmode-toggle" id="darkmode-toggle" onclick="switchTheme()">
                        <div>
                            <i class='bx bx-cog mr-10'></i>
                            <span>darkmode</span>
                        </div>
                        <span class="darkmode-switch"></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- END SIDEBAR -->
    <!-- Main Header -->
    <div class="main-header">
        <div class="d-flex">
            <div class="mobile-toggle" id="" @click="toggleSidebar">
                <i class='bx bx-menu'></i>
            </div>
            <div class="main-title">
                {{ title }}
            </div>
        </div>

        <div class="d-flex align-items-center">

            <!-- App Search-->
<!--            <form class="app-search d-none d-lg-block">-->
<!--                <div class="position-relative">-->
<!--                    <input type="text" class="form-control" placeholder="Search">-->
<!--                    <span class="bx bx-search-alt"></span>-->
<!--                </div>-->
<!--            </form>-->
            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class='bx bx-search-alt' ></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary h-100" type="submit"><i class='bx bx-search-alt' ></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <!-- <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                        <i class="bx bx-fullscreen"></i>
                    </button>
            </div> -->
            <div class="dropdown d-inline-block mt-12">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img v-if="$page.props.auth.user.profile_photo_path" class="rounded-circle header-profile-user" width="70px" :src="getImageUrl($page.props.auth.user.profile_photo_path)"
                         alt="Header Avatar">
                    <img v-else class="rounded-circle header-profile-user" width="70px" src="/upload/no_img.jpg"
                         alt="Header Avatar">
                    <span class="pulse-css"></span>
                    <span class="info d-xl-inline-block  color-span">
                            <span class="d-block fs-20 font-w600">{{ $page.props.auth.user.name }}</span>
                            <span class="d-block mt-7" >{{ $page.props.auth.user.email }}</span>
                        </span>

                    <i class='bx bx-chevron-down'></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <Link class="dropdown-item" :href="route('staff.profile')"><i class="bx bx-user font-size-16 align-middle me-1"></i> <span>Profile</span></Link>
                    <div class="dropdown-divider"></div>
                    <form @submit.prevent="logout">
                        <button type="submit" class="dropdown-item text-danger"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span>Logout</span></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Header -->
   <!-- MAIN CONTENT -->

    <main :class="{ 'full-width': !isSidebarOpen }">
       <slot></slot>
   </main>
   <!-- END MAIN CONTENT -->

    <div class="overlay" :class="{ 'active': isSidebarOpen }"></div>
</template>

<style scoped>
.sidebar {
    /* Your default sidebar styles */
    /* Make sure it's hidden by default */
    transform: translateX(-100%);
    transition: transform 0.3s ease;
}

.sidebar.active {
    /* Display the sidebar when active */
    transform: translateX(0);
}

.full-width {
    width: 100%;
}

/* Adjust body width when sidebar is closed */
.sidebar-closed .main-header {
    /* Adjust header width if necessary */
}

.sidebar-closed main {
    width: 100%;
}
</style>
