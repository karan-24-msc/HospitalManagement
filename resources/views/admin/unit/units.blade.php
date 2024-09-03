@extends('admin.layouts.master')
@section('title')
    Manage Unit
@endsection
@section('admin_content')

    <!-- Start content -->
    <div class="content">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-header-title">
                        <h4 class="pull-left page-title">Manage Units</h4>
                        <ol class="breadcrumb pull-right">
                            <li><a href="#">ABC Hospital</a></li>
                            <li class="">Manage Units</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Units List</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Unit Name</th>
                                            <th>Unit Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                        @foreach($units as $key => $unit)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $unit->name }}</td>
                                                <td>
                                                    @if($unit->status == 1)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">In-Active</span>
                                                    @endif
                                                <td>
                                                    <!-- Edit Button and Modal -->
                                                    <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#editModal-{{ $unit->id }}"><i class="fa fa-pencil" title="Edit"></i></a>

                                                    <!-- Edit Modal -->
                                                    <div id="editModal-{{ $unit->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-{{ $unit->id }}" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    <h4 class="modal-title" id="editModalLabel-{{ $unit->id }}">Edit Unit</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- Form to edit department -->
                                                                    <form action="{{ route('unit.update', $unit->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <label class="form-label">Unit Name</label><br>
                                                                        <input type="text" class="form-control" name="name" value="{{ $unit->name }}">

                                                                        @error('name')
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
                                                    <a href="{{ route('unit.delete', $unit->id) }}" class="btn btn-danger" id="delete"><i class="fa fa-times" title="In-Active"></i></a>
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
                            <form method="POST" action="{{ route('unit.store') }}">
                                @csrf
                                <label class="form-label">Unit Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">

                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <br>
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

