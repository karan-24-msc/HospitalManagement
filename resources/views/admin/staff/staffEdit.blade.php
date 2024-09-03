@extends('admin.layouts.master')
@section('title')
    Staff Add
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
                        <h4 class="pull-left page-title">Staff Edit</h4>
                        <ol class="breadcrumb pull-right">
                            <li><a href="#">ABC Hospital</a></li>
                            <li class="">Staff Management</li>
                            <li class="">Staff Edit</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><h3 class="panel-title">Staff Add Form</h3></div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" action="{{ route('staff.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" value="{{ $user->id }}" name="id">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Name</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="Employee Name">
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="example-email">Email</label>
                                    <div class="col-md-10">
                                        <input type="email"  name="email" value="{{ $user->email }}" class="form-control" readonly placeholder="Employee Email">
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="example-email">Phone</label>
                                    <div class="col-md-10">
                                        <input type="text" name="phone" value="{{ $user->phone }}" class="form-control" placeholder="Employee Phone">
                                        @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Employee Type</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="emp_type">
                                            <option value="" disabled selected>Select One</option>
                                            <option {{ $user->emp_type == 'DOCTOR' ? 'selected' : '' }} value="DOCTOR">DOCTOR</option>
                                            <option {{ $user->emp_type == 'NURSE' ? 'selected' : '' }} value="NURSE">NURSE</option>
                                            <option {{ $user->emp_type == 'STAFF' ? 'selected' : '' }} value="STAFF">STAFF(RECEPTIONIST and OTHER)</option>
                                        </select>
                                        @error('emp_type')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="example-email">Designation</label>
                                    <div class="col-md-10">
                                        <input type="text"  name="designation" value="{{ $user->name }}" class="form-control" placeholder="Employee Designation">
                                        @error('designation')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Employment Type</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="employment_type">
                                            <option value="" disabled>Select One</option>
                                            <option {{ $user->staffInformation->employment_type == 'Permanent' ? 'selected' : '' }} value="Permanent">Permanent</option>
                                            <option {{ $user->staffInformation->employment_type == 'Contractual' ? 'selected' : '' }} value="Contractual">Contractual</option>
                                            <option {{ $user->staffInformation->employment_type == 'Probation' ? 'selected' : '' }} value="Probation">Probation</option>
                                            <option {{ $user->staffInformation->employment_type == 'Intern' ? 'selected' : '' }} value="Intern">Intern</option>
                                        </select>
                                        @error('employment_type')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="example-email">Department</label>
                                    <div class="col-md-10">
                                        <select class="form-control" name="department">
                                            <option value="" disabled selected>Select One</option>
                                            @foreach($departments as $department)
                                                <option {{ $department->id == $user->staffInformation->department ? 'selected' : '' }} value="{{ $department->id }}">{{ $department->department_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="example-email">Speciality</label>
                                    <div class="col-md-10">
                                        <input type="text"  name="speciality" value="{{ $user->staffInformation->speciality }}" class="form-control" placeholder="Enter Doctor Speciality">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Doctor Type</label>
                                    <div class="col-md-10">
                                        <input type="text"  name="doctor_type" value="{{ $user->staffInformation->doctor_type }}" class="form-control" placeholder="Enter Doctor Type">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Joining Date</label>
                                    <div class="col-md-10">
                                        <input type="text" id="datepicker" name="joining_date" placeholder="dd/mm/yyyy" value="{{ $user->staffInformation->joining_date }}" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="example-email">Profile Image</label>
                                    <div class="col-md-10">
                                        <input type="file" class="form-control" name="profile_photo_path" id="image">
                                        @error('profile_photo_path')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="example-email"></label>
                                    <div class="col-md-10">
                                        <img src="{{ (!empty($user->profile_photo_path)) ? url($user->profile_photo_path):
                                                    url('upload/no_img.jpg') }}" style="height: 100px" id="showImage"><br> <br>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="text-center">
                                        <input type="submit" class="btn btn-primary" value="Update">
                                    </div>
                                </div>

                            </form>
                        </div> <!-- panel-body -->
                    </div> <!-- panel -->
                </div> <!-- col -->
            </div>


        </div>
        <!-- container -->
    </div>
    <!-- content -->
@endsection

@push('admin_scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script>
        $('#image').change(function (e){
            var reader = new FileReader();
            reader.onload = function (e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    </script>
@endpush

