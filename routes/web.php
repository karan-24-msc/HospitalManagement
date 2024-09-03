<?php

use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StaffsController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\PatientManageController;
use App\Http\Controllers\Staff\AppointmentManageController;
use App\Http\Controllers\Staff\StaffController;
use App\Http\Controllers\Staff\StaffPatientManageController;
use App\Http\Resources\PatientResource;
use App\Http\Resources\StaffPatientAppointmentResource;
use App\Models\Patient;
use App\Models\PatientAppointment;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

//admin routes
Route::get('admin/login', [AdminController::class, 'loginForm'])->name('admin.loginForm');
Route::post('admin/login', [AdminController::class, 'adminLogin'])->name('admin.login');

Route::middleware('admin.auth')->group(function () {
    Route::get('admin/dashboard', [AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::get('admin/logout',  [AdminController::class,'logout'])->name('admin.logout');
});

Route::middleware('admin.auth')->prefix('admin')->group(function (){
    Route::controller(SettingController::class)->prefix('settings')->group(function () {
        Route::get('/information', 'information')->name('information');
        Route::post('/information/store', 'storeInformation')->name('information.store');
        Route::get('/create-ticket', 'createTicket');
        Route::post('/store-ticket', 'storeTicket')->name('store-ticket');
        Route::post('/update/{ticket}', 'updateTicket')->name('update-ticket');
    });

    Route::controller(StaffsController::class)->prefix('staff')->group(function () {
        Route::get('/list', 'staffList')->name('staff.list');
        Route::get('/add', 'staffAdd')->name('staff.add');
        Route::post('/store', 'storeStaff')->name('staff.store');
        Route::get('/edit/{user}', 'editStaff')->name('staff.edit');
        Route::post('/update', 'updateStaff')->name('staff.update');
        Route::get('/delete/{user}', 'deleteStaff')->name('staff.delete');

        Route::get('/password-change/{user}', 'changeStaffPassword')->name('staff.password.change');
        Route::post('/password-update/{user}', 'updateStaffPassword')->name('staff.password.update');
    });

    Route::get('/contact-message', [AdminController::class,'contactMessage'])->name('contact.message');

    Route::get('/department', [StaffsController::class,'department'])->name('department.index');
    Route::post('/department-store', [StaffsController::class,'departmentStore'])->name('department.store');
    Route::put('/department-update/{department}', [StaffsController::class,'departmentUpdate'])->name('department.update');
    Route::get('/department-delete/{department}', [StaffsController::class,'departmentDelete'])->name('department.delete');

    Route::controller(UnitController::class)->prefix('unit')->group(function () {
        Route::get('/', 'unit')->name('unit.index');
        Route::post('/store', 'unitStore')->name('unit.store');
        Route::put('/update/{unit}', 'unitUpdate')->name('unit.update');
        Route::get('/delete/{unit}', 'unitDelete')->name('unit.delete');

        Route::prefix('bed')->group(function () {
            Route::get('/', 'bed')->name('bed.index');
            Route::post('/store', 'bedStore')->name('bed.store');
            Route::put('/update/{bed}', 'bedUpdate')->name('bed.update');
            Route::get('/delete/{bed}', 'bedDelete')->name('bed.delete');
        });
    });

    Route::get('/patient-appointment',[PatientManageController::class,'adminPatientAppointment'])->name('admin.patient_appointment');
    Route::get('/patient-appointment/approve/{id}',[PatientManageController::class,'adminPatientAppointmentApprove'])->name('admin.appointment.approve');
    Route::get('/patient-appointment/decline/{id}',[PatientManageController::class,'adminPatientAppointmentDecline'])->name('admin.appointment.decline');
    Route::post('/patient-appointment/time-update/{appointment}',[PatientManageController::class,'adminPatientAppointmentUpdate'])->name('admin.appointment.time.update');
});

//user routes
Route::get('/',[IndexController::class,'index'])->name('index');
Route::get('/contact',[IndexController::class,'contact'])->name('contact');
Route::get('/doctors',[IndexController::class,'doctors'])->name('doctors');
Route::post('/store-contact',[IndexController::class,'storeContact'])->name('store.contact');
Route::post('/store-appointment',[IndexController::class,'storeAppointment'])->name('store.appointment');
Route::get('/fetch-doctors/{department}',[IndexController::class,'fetchDoctors'])->name('fetch.doctors');


//staff routes
Route::get('/staff/login',[IndexController::class,'staffLoginPage'])->name('staff.login');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('staff/dashboard', function () {
        $appointments = PatientAppointment::with(['staff','departmentInfo'])
            ->where('app_status', 0)
            ->where('doctor', Auth::user()->id)
            ->get();

        $appointments = count($appointments);

        $patients = Patient::with(['appointmentInfo','doctor','departmentInfo'])
            ->where('status', 0)
            ->where('assigned_doc', Auth::user()->id)
            ->get();

        $patients = count($patients);

        $totalPatients = Patient::with(['appointmentInfo','doctor','departmentInfo'])
            ->where('assigned_doc', Auth::user()->id)
            ->get();

        $totalPatients = count($totalPatients);

        return Inertia::render('Staff/Dashboard',[
            'patients' => $patients,
            'appointments' => $appointments,
            'totalPatients' => $totalPatients,
        ]);
    })->name('dashboard');

    Route::get('/profile', [StaffController::class,'staffProfile'])->name('staff.profile');
    Route::get('/profile/edit', [StaffController::class,'staffProfileEdit'])->name('staff.profile_edit');
    Route::post('/profile/update/{user}', [StaffController::class,'staffProfileUpdate'])->name('staff.profile_update');
    Route::get('/profile/change-password', [StaffController::class,'staffPasswordChange'])->name('staff.change_password');
    Route::post('/profile/change-password/update/{user}', [StaffController::class,'staffPasswordUpdate'])->name('staff.change_password.update');

    Route::prefix('staff')->group(function () {
        Route::controller(AppointmentManageController::class)->prefix('appointments')->middleware('doctor.auth')->group(function () {
            Route::get('/new-appointments', 'newAppointments')->name('new.appointments');
            Route::get('/approved-appointments', 'approvedAppointments')->name('approved.appointments');
            Route::get('/declined-appointments', 'declinedAppointments')->name('declined.appointments');

            Route::get('/approved-appointments-data', 'approvedAppointmentsData')->name('approved.appointments.data');

            Route::get('/create-patient-appointment/{appointmentId}', 'createPatientAppointment')->name('appointment.patientCreate');
            Route::get('/approve/{id}', 'staffPatientAppointmentApprove')->name('new.appointments.approve');
            Route::get('/decline/{id}', 'staffPatientAppointmentDecline')->name('new.appointments.decline');
            Route::post('/change-time/{id}', 'staffPatientAppointmentChangeDateTime')->name('new.appointments.changeDateTime');
        });

        Route::controller(StaffPatientManageController::class)->prefix('patient')->group(function () {
            Route::get('/view-patients', 'viewPatients')->name('view.patients');
            Route::get('/fetch-patients', 'fetchPatients')->name('fetch.patients');
            Route::get('/create', 'createPatient')->name('create.patient');
            Route::post('/store', 'storePatient')->name('patient.store');
            Route::get('/show/{patient}', 'showPatients')->name('patient.show');
            Route::get('/edit/{patient}', 'editPatients')->name('patient.edit');
            Route::post('/update/{patient}', 'updatePatients')->name('patient.update');

            //investigation/reports
            Route::get('/investigation/{id}', 'patientInvestigation')->name('patient.investigation');
            Route::get('/report/create/{id}', 'reportCreate')->name('patient.report.create');
            Route::post('/report/store', 'reportStore')->name('patient.report.store');
            Route::get('/report/view/{patientReport}', 'reportView')->name('patient.report.view');
            Route::get('/report/download/{patientReport}', 'reportDownload')->name('patient.report.download');
            Route::get('/report/single/download/{patientReport}/{reportName}', 'reportSingleDownload')->name('patient.report.single.download');

            //prescription
            Route::get('/prescription/{id}', 'prescriptionProcess')->name('patient.prescription');
            Route::get('/prescription/view/{patientPrescription}', 'prescriptionEdit')->name('patient.prescription.view');
            Route::get('/prescription/download/{patientPrescription}', 'prescriptionDownload')->name('patient.prescription.download');

            Route::prefix('admission')->group(function () {
                Route::get('/process/{patient}', 'processAdmission')->name('patient.admission');
                Route::get('/discharge/{patient}', 'dischargeAdmission')->name('patient.admission.discharge');
                Route::get('/fetch/beds/{unit}', 'fetchUnitBeds')->name('fetch.beds');
                Route::post('/store/{patient}', 'patientAdmissionStore')->name('patient.admission.store');
            });


            Route::middleware('doctor.auth')->group(function () {
                Route::get('/new-patients', 'newPatients')->name('new.patients');
                Route::get('/admitted-patients', 'admittedPatients')->name('admitted.patients');
                Route::get('/regular-patients', 'regularPatients')->name('regular.patients');
                Route::get('/discharged-patients', 'dischargedPatients')->name('discharged.patients');


                Route::get('/prescription/create/{patient}', 'prescriptionCreate')->name('patient.prescription.create');
                Route::post('/prescription/store', 'prescriptionStore')->name('patient.prescription.store');
            });
        });
    });
});

Route::redirect('/staff', '/staff/dashboard');
Route::redirect('/dashboard', '/staff/dashboard');
Route::redirect('/admin', '/admin/dashboard');



//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});

