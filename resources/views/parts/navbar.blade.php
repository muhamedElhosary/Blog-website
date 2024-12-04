<nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('home') }}">BlogSite</a>

        <!-- Hamburger Menu for Small Screens -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Search Icon -->
                <form action="{{route('post.search')}}" method="GET" class="d-flex mb-4">
                    <input type="text" name="query" class="form-control me-2" placeholder="{{__('msgs.Search Holder')}}" value="{{ request('query') }}">
                    <button type="submit" class="btn btn-primary">{{__('msgs.Search')}}</button>
                </form>
                

                <!-- Contact Us Link -->
                @if(!Auth::guard('admin')->check())
                <li class="nav-item">
                    <a class="nav-link" href="{{route('contact.create') }}">{{ __('msgs.Contact Us') }}</a>
                </li>
                @endif

                <!-- Blogs Dropdown -->
                @if(Auth::check()||Auth::guard('admin')->check())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="blogsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Blogs
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="blogsDropdown">
                        <li><a class="dropdown-item" href="{{ route('post.user', Auth::user()->id?? "admin") }}">My Blogs</a></li>
                        <li><a class="dropdown-item" href="{{ route('post.create') }}">Add Blog+</a></li>
                        @auth('admin')
                        <li><a class="dropdown-item" href="{{ route('post.requests') }}">Blog Requests ({{$request}})</a></li>
                        @endauth
                    </ul>
                </li>
                @endif

                <!-- Admin View Users Link -->
                @if(Auth::guard('admin')->check())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.users') }}">{{ __('View Users') }}</a>
                </li>
                @endif

                <!-- Authentication Links -->
                @if(!Auth::check() && !Auth::guard('admin')->check())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('msgs.Register') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('msgs.Login') }}</a>
                </li>
                @endif

                <!-- Profile and Logout Dropdown -->
                @if(Auth::check() || Auth::guard('admin')->check())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @auth('web') {{ Auth::user()->name }} @endauth
                        @auth('admin') {{ Auth::guard('admin')->user()->name }} @endauth
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            @auth('web')
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('msgs.Profile') }}</a>
                            @endauth
                            @auth('admin')
                            <a class="dropdown-item" href="{{ route('admin.profile.edit', Auth::guard('admin')->user()->id) }}">{{ __('msgs.Profile') }}</a>
                            
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('contact.index') }}">{{ __('msgs.Messages') }}</a>
                        </li>
                           @endauth
                        <li>
                            <form method="POST" action="{{ Auth::guard('admin')->check() ? route('admin.logout') : route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">{{ __('msgs.Log Out') }}</button>
                            </form>
                        </li>
                    </ul>
                </li>
                @endif

                <!-- Language Switcher -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ LaravelLocalization::getCurrentLocaleName() }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <li>
                            <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ $properties['native'] }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
