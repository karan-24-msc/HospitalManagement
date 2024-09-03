@extends('admin.layouts.master')
@section('title')
    Company Information
@endsection

@section('admin_content')

    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header-title">
                        <h4 class="pull-left page-title">Staff List</h4>
                        <ol class="breadcrumb pull-right">
                            <li><a href="#">ABC Hospital</a></li>
                            <li class="">Site Setting</li>
                            <li class="">Company Information</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Staff List</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Employee ID</th>
                                            <th>Employee Name</th>
                                            <th>Employee Type</th>
                                            <th>Employee Designation</th>
                                            <th>Employee Phone</th>
                                            <th>Employee Image</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                        @foreach($staffs as $key => $staff)
                                            <tr>
                                                <td>{{ $staff->staffInformation->emp_id }}</td>
                                                <td>{{ $staff->name }}</td>
                                                <td>{{ $staff->emp_type }}</td>
                                                <td>{{ $staff->staffInformation->designation }}</td>
                                                <td>{{ $staff->phone }}</td>
                                                <td><img src="{{ asset($staff->profile_photo_path) }}" style="height: 70px"></td>
                                                <td>
                                                    <a href="{{ route('staff.edit',$staff->id) }}" class="btn btn-warning"><i class="fa fa-pencil" title="Edit"></i></a>
                                                    <a href="{{ route('staff.password.change',$staff->id) }}" class="btn btn-dark"><i class="fa fa-lock" title="Change Password"></i></a>
                                                    <a href="{{ route('staff.delete',$staff->id) }}" class="btn btn-danger" id="delete"><i class="fa fa-trash" title="Delete"></i></a>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function (){
            $('#image').change(function (e){
                var reader = new FileReader();
                reader.onload = function (e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endpush

