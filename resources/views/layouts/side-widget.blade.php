<!-- Side widgets-->
<div class="col-lg-4">
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
                            class="bg-primary badge text-white categories">{{ $item->name }}</a>
                    </span>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Side widget-->
    <div class="card mb-4">
        <div class="card-header">Side Widget</div>
        <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and
            feature the Bootstrap 5 card component!</div>
    </div>
</div>
