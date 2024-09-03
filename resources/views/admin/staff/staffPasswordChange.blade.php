@extends('admin.layouts.master')
@section('title')
    Staff Change Password
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
                        <h4 class="pull-left page-title">Staff Change Password</h4>
                        <ol class="breadcrumb pull-right">
                            <li><a href="#">ABC Hospital</a></li>
                            <li class="">Staff Management</li>
                            <li class="">Staff Change Password</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><h3 class="panel-title">Staff Change Password Form</h3></div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" action="{{ route('staff.password.update',$user->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Password</label>
                                    <div class="col-md-4">
                                        <input type="password" class="form-control" name="password" >
                                        @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="text-center">
                                        <input type="submit" class="btn btn-primary" value="Submit">
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
@endpush

