@extends('admin.layouts.master')
@section('title')
    Manage Beds
@endsection
@section('admin_content')

    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header-title">
                        <h4 class="pull-left page-title">Manage Beds</h4>
                        <ol class="breadcrumb pull-right">
                            <li><a href="#">ABC Hospital</a></li>
                            <li class="">Manage Beds</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Beds List</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Bed Name</th>
                                            <th>Unit Name</th>
                                            <th>Bed Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                        @foreach($beds as $key => $bed)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $bed->name }}</td>
                                                <td>{{ $bed->unit->name }}</td>
                                                <td>
                                                    @if($bed->status == 1)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">In-Active</span>
                                                @endif
                                                <td>
                                                    <!-- Edit Button and Modal -->
                                                    <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#editModal-{{ $bed->id }}"><i class="fa fa-pencil" title="Edit"></i></a>

                                                    <!-- Edit Modal -->
                                                    <div id="editModal-{{ $bed->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-{{ $bed->id }}" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    <h4 class="modal-title" id="editModalLabel-{{ $bed->id }}">Edit Bed</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- Form to edit department -->
                                                                    <form action="{{ route('bed.update', $bed->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('PUT')

                                                                        <label class="form-label">Select Unit</label><br>
                                                                        <select class="form-control" name="unit_id">
                                                                            <option value="" selected disabled>Select One</option>
                                                                            @foreach($units as $unit)
                                                                                <option value="{{ $unit->id }}" {{ $unit->id == $bed->unit_id ? 'selected' : '' }}>{{ $unit->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('unit_id')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                        @enderror<br><br>

                                                                        <label class="form-label">Bed Name</label><br>
                                                                        <input type="text" class="form-control" name="name" value="{{ $bed->name }}">
                                                                        @error('name')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                        @enderror

                                                                        <br><br>

                                                                        <label class="form-label">Select Bed Type</label><br>
                                                                        <select class="form-control" name="bed_type">
                                                                            <option value="" selected disabled>Select One</option>
                                                                            <option value="Ward" {{ $bed->bed_type == 'Ward' ? 'selected' : '' }}>Ward</option>
                                                                            <option value="Cabin" {{ $bed->bed_type == 'Cabin' ? 'selected' : '' }}>Cabin</option>
                                                                        </select>
                                                                        @error('bed_type')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                        @enderror

                                                                        <br><br>
                                                                        <input type="submit" class="btn btn-primary btn-sm" value="Update">
                                                                    </form>
                                                                </div>
                                                            </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                    </div><!-- /.modal -->

                                                    <!-- Delete Button -->
                                                    <a href="{{ route('bed.delete', $bed->id) }}" class="btn btn-danger" id="delete"><i class="fa fa-times" title="In-Active"></i></a>
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

                <div class="col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Add New Unit</h3>
                        </div>
                        <div class="panel-body">
                            <form method="POST" action="{{ route('bed.store') }}">
                                @csrf
                                <label class="form-label">Select Unit</label><br>
                                <select class="form-control" name="unit_id">
                                    <option value="" selected disabled>Select One</option>
                                    @foreach($units as $unit)
                                        <option value="{{ $unit->id }}" {{ $unit->id == request('unit_id') ? 'selected' : '' }}>{{ $unit->name }}</option>
                                    @endforeach
                                </select> <br>
                                @error('unit_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror

                                <label class="form-label">Bed Name</label><br>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}"><br>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror

                                <label class="form-label">Select Bed Type</label><br>
                                <select class="form-control" name="bed_type">
                                    <option value="" selected disabled>Select One</option>
                                    <option value="Ward" {{ old('bed_type') == 'Ward' ? 'selected' : '' }}>Ward</option>
                                    <option value="Cabin" {{ old('bed_type') == 'Cabin' ? 'selected' : '' }}>Cabin</option>
                                </select>
                                @error('bed_type')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <br><br>
                                <input type="submit" class="btn btn-primary btn-sm" value="Submit">
                            </form>
                        </div>
                    </div>
                </div>

            </div>


        </div>
        <!-- container -->
    </div>
    <!-- content -->
@endsection

