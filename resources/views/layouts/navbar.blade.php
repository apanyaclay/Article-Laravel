<!-- Responsive navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{route('blog.index')}}">ApanyaClay</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('blog.index') ? 'active' : '' }}" href="{{route('blog.index')}}">{{__('app-front.home')}}</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('blog.about') ? 'active' : '' }}" href="{{route('blog.about')}}">{{__('app-front.about')}}</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('blog.contact') ? 'active' : '' }}" href="{{route('blog.contact')}}">{{__('app-front.contact')}}</a></li>
                <li class="nav-item dropdown">
                    @php
                        $locale = session('locale', config('app.locale'));
                        $language = [
                            'en' => 'English',
                            'id' => 'Bahasa Indonesia',
                            'de' => 'German',
                            'fr' => 'French',
                            'es' => 'Spanish',
                        ];
                        $currentLanguage = $language[$locale] ?? 'English';
                    @endphp
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ $currentLanguage }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item {{ $locale == 'en' ? 'active' : '' }}" href="{{ url('lang/en') }}">English</a></li>
                        <li><a class="dropdown-item {{ $locale == 'id' ? 'active' : '' }}" href="{{ url('lang/id') }}">Bahasa Indonesia</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
