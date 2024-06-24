@extends('layouts.app')
@push('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush
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
                                <div class="float-right">
                                    <a href="{{ route('category.index') }}" class="btn btn-primary">Back</a>
                                </div>
                            </div>
                            <!-- form start -->
                            <form action="{{ route('category.update', ['id'=>$categorie->id]) }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Name Category</label>
                                                <input type="text" class="form-control" placeholder="Enter Name Category" id="name" name="name" value="{{$categorie->name}}">
                                                @error('name') <span class="text-danger">{{$message}}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Slug</label>
                                                <input type="text" class="form-control" placeholder="Enter Slug" id="slug" name="slug" value="{{$categorie->slug}}">
                                                @error('slug') <span class="text-danger">{{$message}}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <input type="text" class="form-control" placeholder="Enter Description" id="description" name="description" value="{{$categorie->description}}">
                                                @error('description') <span class="text-danger">{{$message}}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Category</label>
                                                <select name="parent_id" id="parent_id" class="form-control select2" style="width: 100%;">
                                                    <option value="">Select Category</option>
                                                    @foreach ($categories as $item)
                                                        <option value="{{$item->id}}" {{$categorie->parent_id == $item->id ?  'selected' : ''}}>{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('parent_id') <span class="text-danger">{{$message}}</span> @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
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
@push('js')
    <!-- Select2 -->
    <script src="{{ URL::to('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap4'
            })
        });
        $('#name').on('input', function() {
            var name = $(this).val();
            var slug = name.toLowerCase().replace(/ /g, '-');
            $('#slug').val(slug);
        });
    </script>
@endpush
