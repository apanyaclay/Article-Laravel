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
                                    <a href="{{ route('article.index') }}" class="btn btn-primary">Back</a>
                                </div>
                            </div>
                            <!-- form start -->
                            <form action="{{ route('article.update', ['id' => $article->id]) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Title Article</label>
                                                <input type="text" class="form-control" placeholder="Enter Title Article"
                                                    id="title" name="title"
                                                    value="{{ old('title', $article->title) }}">
                                                @error('title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Slug</label>
                                                <input type="text" class="form-control" placeholder="Enter Slug"
                                                    id="slug" name="slug" value="{{ old('slug', $article->slug) }}">
                                                @error('slug')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Content</label>
                                                <textarea name="content" id="editor" class="form-control">{!! old('content', $article->content) !!}</textarea>
                                                @error('content')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Excerpt</label>
                                                <textarea name="excerpt" id="editor1" class="form-control">{{ old('excerpt', $article->excerpt) }}</textarea>
                                                @error('excerpt')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Category</label>
                                                <select name="category_id" id="category_id" class="form-control">
                                                    @foreach ($category as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $item->id == $article->category_id ? 'selected' : '' }}>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Tag</label>
                                                <select class="select2" multiple="multiple" data-placeholder="Select Tag"
                                                    style="width: 100%;" name="tag_id[]" id="tag_id">
                                                    @foreach ($tag as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ in_array($item->id, $article->tags->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('tag_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Image</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="customFile"
                                                        name="image">
                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                </div>
                                                <div class="mt-2">
                                                    @if ($article->image)
                                                        <img src="{{ asset('storage/' . $article->image) }}" id="preview"
                                                            alt="Current Image"
                                                            style="max-width: 300px; max-height: 200px;">
                                                    @else
                                                        <img src="{{ asset('storage/default.jpg') }}" id="preview"
                                                            alt="Preview Image"
                                                            style="max-width: 300px; max-height: 200px;">
                                                    @endif
                                                </div>
                                                @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="draft"
                                                        {{ $article->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                                    <option value="published"
                                                        {{ $article->status == 'published' ? 'selected' : '' }}>Published
                                                    </option>
                                                    <option value="archived"
                                                        {{ $article->status == 'archived' ? 'selected' : '' }}>Archived
                                                    </option>
                                                </select>
                                                @error('status')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
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
    <!-- CKeditor -->
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <!-- Select2 -->
    <script src="{{ URL::to('assets/plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap4'
            })
            $('#title').on('input', function() {
                var name = $(this).val();
                var slug = name.toLowerCase().replace(/ /g, '-');
                $('#slug').val(slug);
            });
            var options = {
                filebrowserImageBrowseUrl: '{{ url('/laravel-filemanager?type=Images') }}',
                filebrowserImageUploadUrl: '{{ url('/laravel-filemanager/upload?type=Images&_token=') }}{{ csrf_token() }}',
                filebrowserBrowseUrl: '{{ url('/laravel-filemanager?type=Files') }}',
                filebrowserUploadUrl: '{{ url('/laravel-filemanager/upload?type=Files&_token=') }}{{ csrf_token() }}',
                clipboard_handleImages: false,
            };

            CKEDITOR.replace('editor', options);
            CKEDITOR.replace('editor1', options);

            // Event untuk mengubah gambar dan menampilkan preview
            $(".custom-file-input").change(function() {
                previewImage(this);
            });

            function previewImage(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#preview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        });
    </script>
@endpush
