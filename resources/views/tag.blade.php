@extends('layouts.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('aos-master/dist/aos.css') }}">
@endpush
@section('content')
    <!-- Page header with logo and tagline-->
    <header class="py-5 bg-light border-bottom mb-4">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder">Tag {{$tag->name}}</h1>
            </div>
        </div>
    </header>
    <!-- Page content-->
    <div class="container">
        <div class="row">
            <div class="mb-4">
                <div class="card-body">
                    <form action="{{ route('blog.article') }}" method="get">
                        <div class="input-group">
                            <input class="form-control" type="text" name="q"
                                placeholder="{{ __('app-front.enter_search_term') }}"
                                aria-label="{{ __('app-front.enter_search_term') }}" aria-describedby="button-search" />
                            <button class="btn btn-primary" id="button-search" type="submit">{!!__('app-front.go')!!}</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Blog entries-->
            <div class="col-lg-8">
                <!-- Nested row for non-featured blog posts-->
                <div class="row">
                    @foreach ($articles as $item)
                        <div class="col-lg-6" data-aos="flip-up">
                            <!-- Blog post-->
                            <div class="card mb-4">
                                <a href="{{ route('blog.show', ['slug' => $item->article->slug]) }}"><img
                                        class="card-img-top post-img" src="{{asset('storage/'.$item->article->image)}}"
                                        alt="{{$item->article->slug}}" /></a>
                                <div class="card-body card-height">
                                    <div class="small text-muted">
                                        {{ \Carbon\Carbon::parse($item->article->published_date)->translatedFormat('d F, Y') }}
                                    </div>
                                    <h2 class="card-title h4">{{ $item->article->title }}</h2>
                                    <p class="card-text">{!!Str::limit(strip_tags($item->article->content), 200)!!}</p>
                                    <a class="btn btn-primary"
                                        href="{{ route('blog.show', ['slug' => $item->article->slug]) }}">{{__('app-front.read_more')}} →</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Pagination-->
                @if ($articles->hasPages())
                    <nav aria-label="Pagination">
                        <hr class="my-0" />
                        <ul class="pagination justify-content-center my-4">
                            {{ $articles->links() }}
                        </ul>
                    </nav>
                @endif
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('aos-master/dist/aos.js') }}"></script>
    <script>
        AOS.init();
    </script>
@endpush
