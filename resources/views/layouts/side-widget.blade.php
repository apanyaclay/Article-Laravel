<!-- Side widgets-->
<div class="col-lg-4" data-aos="fade-left">
    <!-- Search widget-->
    <div class="card mb-4">
        <div class="card-header">{{ __('app-front.search') }}</div>
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
    <!-- Categories widget-->
    <div class="card mb-4">
        <div class="card-header">{{ __('app-front.categories') }}</div>
        <div class="card-body">
            <div>
                @foreach ($categories as $item)
                    <span>
                        <a href="{{ route('blog.category', ['id' => $item->id]) }}"
                            class="bg-primary badge text-white categories">{{ $item->name }} ({{$item->articles_count}})</a>
                    </span>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Popular Post-->
    <div class="card mb-4">
        <div class="card-header">Popular Post</div>
        <div class="card-body">
            <ul class="list-group">
                @foreach ($populars as $item)
                <li class="list-group-item d-flex align-items-center">
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover; margin-right: 10px;">
                    <div>
                        <a href="{{ route('blog.article', ['id' => $item->id]) }}">{{ $item->title }}</a>
                        <br>
                        <small>{!! Str::limit(strip_tags($item->content), 100) !!}</small>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
