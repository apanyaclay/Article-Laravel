@extends('layouts.app')

@push('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- IR-Black Theme -->
    <link rel="stylesheet" href="{{ asset('ckeditor/plugins/codesnippet/lib/highlight/styles/ir_black.css') }}">
    <style>
        .hljs {
            position: relative;
            padding-top: 1.5em;
        }

        .hljs::before {
            content: attr(data-language);
            position: absolute;
            top: 0;
            right: 0;
            padding: 0.5em;
            background: rgba(0, 0, 0, 0.5);
            color: #fff;
            font-size: 0.75em;
            text-transform: uppercase;
        }
    </style>
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
                            <li class="breadcrumb-item"><a href="{{ route('article.index') }}">Articles</a></li>
                            <li class="breadcrumb-item active">{{ $article->title }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ $article->title }}</h3>
                                <div class="card-tools">
                                    <a href="{{ route('article.index') }}" class="btn btn-primary">Back</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <p><strong>Slug:</strong> {{ $article->slug }}</p>
                                <p><strong>Category:</strong> {{ $article->category->name }}</p>
                                <p><strong>Tags:</strong>
                                    @foreach ($article->tags as $tag)
                                        {{ $tag->name }}@if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </p>
                                <p><strong>Status:</strong> {{ ucfirst($article->status) }}</p>
                                <hr>
                                <p>{!! $article->content !!}</p>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
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
            });

            var options = {
                filebrowserImageBrowseUrl: '{{ url('/laravel-filemanager?type=Images') }}',
                filebrowserImageUploadUrl: '{{ url('/laravel-filemanager/upload?type=Images&_token=') }}{{ csrf_token() }}',
                filebrowserBrowseUrl: '{{ url('/laravel-filemanager?type=Files') }}',
                filebrowserUploadUrl: '{{ url('/laravel-filemanager/upload?type=Files&_token=') }}{{ csrf_token() }}',
                clipboard_handleImages: false,
            };

            CKEDITOR.replace('editor', options);
        });
    </script>
    <!-- Highlight JS-->
    <script src="{{ asset('ckeditor/plugins/codesnippet/lib/highlight/highlight.pack.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            hljs.initHighlightingOnLoad();

            // JavaScript untuk menambahkan kelas dan data-language
            const codeBlocks = document.querySelectorAll('pre code');
            console.log(codeBlocks);

            codeBlocks.forEach(block => {
                // Pastikan elemen <code> memiliki kelas bahasa
                if (block.classList.length > 0) {
                    const language = block.classList[
                        0]; // Ambil kelas bahasa pertama (misalnya "language-javascript")
                    if (language.startsWith('language-')) {
                        block.setAttribute('data-language', language.slice(
                            9)); // Potong "language-" untuk mendapatkan nama bahasa
                        console.log("data-language:", block.getAttribute("data-language"));
                    }
                }
            });
        });
    </script>
@endpush
