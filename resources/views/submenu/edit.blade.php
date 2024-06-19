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
                                <div class="float-right">
                                    <a href="{{ route('submenu.index') }}" class="btn btn-primary">Back</a>
                                </div>
                            </div>
                            <!-- form start -->
                            <form action="{{ route('submenu.update', ['id'=>$submenu->id]) }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Name Sub Menu</label>
                                                <input type="text" class="form-control" placeholder="Enter Name Sub Menu" id="name" name="name" value="{{$submenu->name}}">
                                                @error('name') <span class="text-danger">{{$message}}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Menu</label>
                                                <select name="menu_id" id="menu_id">
                                                    @foreach ($menu as $item)
                                                        <option value="{{$item->id}}" {{$item->id == $submenu->menu_id ? 'selected': ''}}>{{$item->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('menu_id') <span class="text-danger">{{$message}}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Route</label>
                                                <input type="text" class="form-control" placeholder="Enter Route" id="route" name="route" value="{{$submenu->route}}">
                                                @error('route') <span class="text-danger">{{$message}}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <input type="text" class="form-control" placeholder="Enter Description" id="description" name="description" value="{{$submenu->description}}">
                                                @error('description') <span class="text-danger">{{$message}}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>No Order</label>
                                                <input type="number" class="form-control" placeholder="Enter No Order" id="order_no" name="order_no" value="{{$submenu->order_no}}">
                                                @error('order_no') <span class="text-danger">{{$message}}</span> @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Active</label>
                                                <select name="is_active" id="is_active">
                                                    <option value="1" {{$submenu->is_active == 1 ? 'selected' : ''}}>Active</option>
                                                    <option value="0" {{$submenu->is_active == 0 ? 'selected' : ''}}>Not Active</option>
                                                </select>
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
