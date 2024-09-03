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
                        <h4 class="pull-left page-title">Company Information</h4>
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
                            <h3 class="panel-title">Company Details</h3>


                        </div>
                        <div class="panel-body">



                                <div class="text-right" style="margin-bottom: 3px">
                                    <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#myModal">Edit Company Info</button>
                                </div>

                                <!-- sample modal content -->
                                <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="myModalLabel">Edit Company Details</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('information.store') }}" enctype="multipart/form-data">
                                                    @csrf
                                                    <label class="form-label">Company Name</label>
                                                    <input type="text" class="form-control" name="name" value="{{ $information->name }}">

                                                    @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <br>

                                                    <label class="form-label">Company Contact No</label>
                                                    <input type="text" class="form-control" name="contact" value="{{ $information->contact }}">

                                                    @error('contact')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <br>

                                                    <label class="form-label">Company Email</label>
                                                    <input type="text" class="form-control" name="email" value="{{ $information->email }}">

                                                    @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <br>

                                                    <label class="form-label">Company Address</label>
                                                    <input type="text" class="form-control" name="address" value="{{ $information->address }}">

                                                    @error('address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <br>

                                                    <label class="form-label">Company Logo</label>
                                                    <input type="file" class="form-control" name="logo" id="image">

                                                    @error('logo')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <br>

                                                    <img src="{{ (!empty($information->logo)) ? url($information->logo):
                                                    url('upload/no_img.jpg') }}" style="height: 30px" id="showImage"><br> <br>

                                                    <input type="submit" class="btn btn-primary btn-sm" value="Update">
                                                </form>
                                            </div>

                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->




                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <b>Company Name</b>
                                                </td>
                                                <td>
                                                    {{ $information->name }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <b>Company Contact No</b>
                                                </td>
                                                <td>
                                                    {{ $information->contact }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <b>Company Email</b>
                                                </td>
                                                <td>
                                                    {{ $information->email }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <b>Company Address</b>
                                                </td>
                                                <td>
                                                    {{ $information->address }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <b>Company Logo</b>
                                                </td>
                                                <td>
                                                    <img src="{{ (!empty($information->logo)) ? url($information->logo):
                                                    url('upload/no_img.jpg') }}" style="height: 30px" >
                                                </td>
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

