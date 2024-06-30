@extends('layouts.master')
@push('css')
    <!-- IR-Black Theme -->
    <link rel="stylesheet" href="{{ asset('ckeditor/plugins/codesnippet/lib/highlight/styles/ir_black.css') }}">
@endpush
@section('content')
    <!-- Page content-->
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8">
                <!-- Post content-->
                <article>
                    <!-- Post header-->
                    <header class="mb-4">
                        <!-- Post title-->
                        <h1 class="fw-bolder mb-1">{{ $article->title }}</h1>
                        <!-- Post meta content-->
                        <div class="text-muted fst-italic mb-2">{{ __('app-front.posted_on') }}
                            {{ \Carbon\Carbon::parse($article->published_date)->translatedFormat('d F, Y') }}
                            {{ __('app-front.by') }} {{ $article->Author->name }}</div>
                        <!-- Post categories-->
                        @foreach ($tag as $item)
                            <a class="badge bg-secondary text-decoration-none link-light"
                                href="{{ route('blog.tag', ['id' => $item->tag_id]) }}">{{ $item->tag->name }}</a>
                        @endforeach
                    </header>
                    <!-- Preview image figure-->
                    <figure class="mb-4"><img class="img-fluid rounded detail-img"
                            src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->slug }}" /></figure>
                    <!-- Post content-->
                    <section class="mb-5">
                        {!! $article->content !!}
                    </section>
                </article>
                <!-- Comments section-->
                <section class="mb-5">
                    <div class="card bg-light">
                        <div class="card-body">
                            <!-- Comment form-->
                            <form class="mb-4">
                                <textarea class="form-control" rows="3" placeholder="Join the discussion and leave a comment!"></textarea>
                            </form>
                            <!-- Comment with nested comments-->
                            <div class="d-flex mb-4">
                                <!-- Parent comment-->
                                <div class="flex-shrink-0"><img class="rounded-circle"
                                        src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                <div class="ms-3">
                                    <div class="fw-bold">Commenter Name</div>
                                    If you're going to lead a space frontier, it has to be government; it'll never be
                                    private enterprise. Because the space frontier is dangerous, and it's expensive, and it
                                    has unquantified risks.
                                    <!-- Child comment 1-->
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0"><img class="rounded-circle"
                                                src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                        <div class="ms-3">
                                            <div class="fw-bold">Commenter Name</div>
                                            And under those conditions, you cannot establish a capital-market evaluation of
                                            that enterprise. You can't get investors.
                                        </div>
                                    </div>
                                    <!-- Child comment 2-->
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0"><img class="rounded-circle"
                                                src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                        <div class="ms-3">
                                            <div class="fw-bold">Commenter Name</div>
                                            When you put money directly to a problem, it makes a good headline.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single comment-->
                            <div class="d-flex">
                                <div class="flex-shrink-0"><img class="rounded-circle"
                                        src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                <div class="ms-3">
                                    <div class="fw-bold">Commenter Name</div>
                                    When I look at the universe and all the ways the universe wants to kill us, I find it
                                    hard to reconcile that with statements of beneficence.
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            @include('layouts.side-widget')
        </div>
    </div>
@endsection
@push('js')
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
