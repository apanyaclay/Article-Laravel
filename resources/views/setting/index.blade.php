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
                                <h3 class="card-title">Site Settings</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{ route('setting.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @foreach ($settings as $key => $value)
                                        @if ($key == 'site_logo')
                                            <div class="form-group">
                                                <label
                                                    for="{{ $key }}">{{ ucwords(str_replace('_', ' ', $key)) }}</label>
                                                <input type="file" class="form-control" id="{{ $key }}"
                                                    name="{{ $key }}">
                                                @if ($value)
                                                    <img src="{{ asset('storage/' . $value) }}" alt="Site Logo"
                                                        style="max-height: 100px; margin-top: 10px;">
                                                @endif
                                            </div>
                                        @else
                                            <div class="form-group">
                                                <label
                                                    for="{{ $key }}">{{ ucwords(str_replace('_', ' ', $key)) }}</label>
                                                <input type="text" class="form-control" id="{{ $key }}"
                                                    name="{{ $key }}" value="{{ $value }}">
                                            </div>
                                        @endif
                                    @endforeach
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </form>
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
