@extends('layouts.app')
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush
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
    <div id="confirm-dialog" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h2 class="h2">Are you sure?</h2>
                    <p>The data will be deleted and lost forever</p>
                </div>
                <div class="modal-footer">
                    <a href="#" role="button" id="delete-button" class="btn btn-danger">Delete</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script>
    function confirmToDelete(el) {
        $("#delete-button").attr("href", el.dataset.href);
        $("#confirm-dialog").modal('show');
    }
</script>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
<!-- DataTables  & Plugins -->
<script src="{{ URL::to('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::to('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ URL::to('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::to('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ URL::to('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::to('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ URL::to('assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ URL::to('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ URL::to('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ URL::to('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::to('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::to('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
@endpush
