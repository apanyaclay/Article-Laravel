@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
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
                                @can('create user')
                                    <div class="float-right">
                                        <a href="{{ route('user.create') }}" class="btn btn-primary">Add</a>
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
                                            <th>Email</th>
                                            <th>Roles</th>
                                            @canany(['update user', 'delete user'])
                                            <th>Action</th>
                                            @endcanany
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user as $value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>
                                                    @if (!empty($value->getRoleNames()))
                                                        @foreach ($value->getRoleNames() as $item)
                                                            <label class="badge bg-primary mx-1">{{ $item }}</label>
                                                        @endforeach
                                                    @endif
                                                </td>
                                                @canany(['update user', 'delete user'])
                                                <td class="d-flex justify-content-center">
                                                    @can('update user')
                                                        <a href="{{ route('user.edit', ['id' => $value->id]) }}"
                                                            class="btn btn-sm btn-outline-warning mr-1">Edit</a>
                                                    @endcan
                                                    @can('delete user')
                                                        <a href="#"
                                                            data-href="{{ route('user.destroy', ['id' => $value->id]) }}"
                                                            onclick="confirmToDelete(this)"
                                                            class="btn btn-sm btn-outline-danger">Delete</a>
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
