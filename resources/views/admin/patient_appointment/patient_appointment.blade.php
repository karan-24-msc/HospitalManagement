@extends('admin.layouts.master')
@section('title')
    Company Information
@endsection

@push('admin_styles')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
@endpush

@section('admin_content')

    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header-title">
                        <h4 class="pull-left page-title">Patient Appointments</h4>
                        <ol class="breadcrumb pull-right">
                            <li><a href="#">ABC Hospital</a></li>
                            <li class="">Patient Appointments</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Patient Appointments</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Appointment ID</th>
                                            <th>Patient Name</th>
                                            <th>Patient Email</th>
                                            <th>Patient Phone</th>
                                            <th>Appointment Department</th>
                                            <th>Appointment Doctor</th>
                                            <th>Appointment Date</th>
                                            <th>Appointment Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                        @foreach($patientAppointments as $key => $patientAppointment)
                                            <tr>
                                                <td>{{ $patientAppointment->app_id }}</td>
                                                <td>{{ $patientAppointment->app_name }}</td>
                                                <td>{{ $patientAppointment->app_email }}</td>
                                                <td>{{ $patientAppointment->app_phone }}</td>
                                                <td>{{ $patientAppointment->departmentInfo->department_name }}</td>
                                                <td>{{ $patientAppointment->staff->name ?? 'No Staff' }}</td>
                                                <td>{{ \Carbon\Carbon::parse($patientAppointment->app_date)->format('F j, Y g:i A') }}</td>
                                                <td>
                                                    @if($patientAppointment->app_status == 0)
                                                        <span class="badge badge-warning">On-Hold</span>
                                                    @elseif($patientAppointment->app_status == 1)
                                                        <span class="badge badge-success">Approved</span>
                                                    @else
                                                        <span class="badge badge-danger">Declined</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($patientAppointment->app_status == 0)
                                                        <a href="{{ route('admin.appointment.approve', $patientAppointment->id) }}" class="btn btn-success">
                                                            <i class="fa fa-check" title="Approve"></i>
                                                        </a>
                                                        <a href="{{ route('admin.appointment.decline', $patientAppointment->id) }}" class="btn btn-danger" id="decline">
                                                            <i class="fa fa-times" title="Declined"></i>
                                                        </a>

                                                        <button type="button" class="btn btn-warning waves-effect waves-light" data-toggle="modal" data-target="#appTimeChange-{{ $patientAppointment->id }}">
                                                            <i class="fa fa-pencil" title="Change Appointment Schedule"></i></button>

                                                    @else
                                                        --
                                                    @endif



                                                    <div id="appTimeChange-{{ $patientAppointment->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    <h4 class="modal-title" id="myModalLabel">Edit Company Details</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="POST" action="{{ route('admin.appointment.time.update',$patientAppointment->id) }}" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <h3>{{ \Carbon\Carbon::parse($patientAppointment->app_date)->format('F j, Y g:i A') }}</h3>
                                                                        <label class="form-label">Change Appointment Date</label><br>
                                                                        <input type="text" class="form-control datepicker" readonly name="app_date" value="{{ \Carbon\Carbon::parse($patientAppointment->app_date)->format('d/m/Y') }}"><br><br>

                                                                        <label class="form-label">Change Appointment Time</label><br>
                                                                        <div class="col-md-2">
                                                                            <select class="form-control" name="app_time">
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
                                                                        </div>
                                                                        <br><br>
                                                                        @error('app_date')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                        @enderror
                                                                        <br><br>
                                                                        <input type="submit" class="btn btn-primary btn-sm" value="Update">
                                                                    </form>
                                                                </div>

                                                            </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                    </div><!-- /.modal -->
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- End Row -->


        </div>
        <!-- container -->
    </div>
    <!-- content -->
@endsection
@push('admin_scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script>
        $(document).ready(function (){
            // Initialize datepicker
            $( "#datepicker" ).datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'dd/mm/yy'
            });


        });
    </script>
@endpush

