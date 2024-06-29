@extends('layouts.master')
@section('content')
    <!-- Page header with logo and tagline-->
    <header class="py-5 bg-light border-bottom mb-4">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder">Welcome to Blog Home!</h1>
                <p class="lead mb-0">A Bootstrap 5 starter layout for your next blog homepage</p>
            </div>
        </div>
    </header>
    <!-- Page content-->
    <div class="container">
        <div class="row">
            <!-- Blog entries-->
            <div class="col-lg-8">
                <!-- Featured blog post-->
                <div class="card mb-4">
                    <a href="{{ route('blog.show', ['slug' => $featured->slug]) }}"><img class="card-img-top feature-img" src="{{asset('storage/'.$featured->image)}}"
                            alt="{{$featured->slug}}" /></a>
                    <div class="card-body">
                        <div class="small text-muted">{{ \Carbon\Carbon::parse($featured->published_date)->translatedFormat('d F, Y') }}</div>
                        <h2 class="card-title">{{ $featured->title }}</h2>
                        <p class="card-text">{!!Str::limit(strip_tags($featured->content), 200)!!}</p>
                        <a class="btn btn-primary" href="{{ route('blog.show', ['slug' => $featured->slug]) }}">{{__('app-front.read_more')}} →</a>
                    </div>
                </div>
                <!-- Nested row for non-featured blog posts-->
                <div class="row">
                    @foreach ($articles as $item)
                        <div class="col-lg-6">
                            <!-- Blog post-->
                            <div class="card mb-4">
                                <a href="{{ route('blog.show', ['slug' => $item->slug]) }}"><img class="card-img-top post-img"
                                        src="{{asset('storage/'.$item->image)}}" alt="{{$item->slug}}" /></a>
                                <div class="card-body card-height">
                                    <div class="small text-muted">{{ \Carbon\Carbon::parse($item->published_date)->translatedFormat('d F, Y') }}</div>
                                    <h2 class="card-title h4">{{ $item->title }}</h2>
                                    <p class="card-text">{!!Str::limit(strip_tags($item->content), 200)!!}</p>
                                    <a class="btn btn-primary" href="{{ route('blog.show', ['slug' => $item->slug]) }}">{{__('app-front.read_more')}} →</a>
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
            @include('layouts.side-widget')
        </div>
    </div>
@endsection
