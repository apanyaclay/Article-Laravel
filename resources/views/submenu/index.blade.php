@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{$title}}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">{{$title}}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                @can('create submenu')
                                <div class="float-right">
                                    <a href="{{route('submenu.create')}}" class="btn btn-primary">Add</a>
                                </div>
                                @endcan
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Menu</th>
                                            <th>No Order</th>
                                            <th>Route</th>
                                            <th>Permission</th>
                                            <th>Description</th>
                                            <th>Active</th>
                                            @canany(['update submenu', 'delete submenu'])
                                            <th>Action</th>
                                            @endcanany
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($submenu as $value)
                                        <tr>
                                            <td>{{$value->id}}</td>
                                            <td>{{$value->name}}</td>
                                            <td>{{$value->menu->name}}</td>
                                            <td>{{$value->order_no}}</td>
                                            <td>{{$value->route}}</td>
                                            <td>{{$value->permission->name}}</td>
                                            <td>{{$value->description}}</td>
                                            <td>@if ($value->is_active == 1)
                                                <label class="badge bg-primary mx-1">Active</label>
                                            @else
                                            <label class="badge bg-secondary mx-1">Not Active</label>
                                            @endif</td>
                                            @canany(['update submenu', 'delete submenu'])
                                            <td class="d-flex justify-content-center">
                                                @can('update submenu')
                                                <a href="{{route('submenu.edit', ['id' => $value->id])}}" class="btn btn-sm btn-outline-warning mr-1">Edit</a>
                                                @endcan
                                                @can('delete submenu')
                                                <a href="#" data-href="{{route('submenu.destroy', ['id' => $value->id])}}" onclick="confirmToDelete(this)" class="btn btn-sm btn-outline-danger">Delete</a>
                                                @endcan
                                            </td>
                                            @endcanany
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->

        <!-- /.content -->
    </div>
@endsection
