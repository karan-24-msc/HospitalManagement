const sideBarMenu = (empType) => {
    const menu = [
        {
            label: 'Dashboard',
            icon: 'bx bxs-home',
            children: [
                { label: 'Dashboard', link: route('dashboard') },
                { label: 'User Profile', link: route('staff.profile') },
            ],
            active: false
        },
        {
            label: 'Appointment Manage',
            icon: 'bx bxs-clinic',
            children: [
                { label: 'New Appointments', link: route('new.appointments') },
                { label: 'Approved Appointments', link: route('approved.appointments') },
                { label: 'Declined Appointments', link: route('declined.appointments') },
            ],
            active: false
        },
        {
            label: 'Patient Manage',
            icon: 'bx bxs-user',
            children: [
                { label: 'New Patients', link: route('new.patients') },
                { label: 'Regular Patients', link: route('regular.patients') },
                { label: 'Admitted Patients', link: route('admitted.patients') },
                { label: 'Discharged Patients', link: route('discharged.patients') },
            ],
            active: false
        },
        {
            label: 'Create Patient',
            icon: 'bx bxs-user',
            link: route('create.patient')
        },
        {
            label: 'View Patients',
            icon: 'bx bxs-user',
            link: route('view.patients')
        },
    ];

    if (empType == 'LAB_OFFICER') {
        return menu.filter(item => item.label === 'Dashboard' || item.label === 'View Patients');
    }

    if (empType !== 'DOCTOR') {
        return menu.filter(item => item.label === 'Dashboard' || item.label === 'Create Patient' || item.label === 'View Patients');
    }
    return menu;
};

export default sideBarMenu;
