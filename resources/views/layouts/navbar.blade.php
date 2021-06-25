<nav class="navbar navbar-expand-lg navbar-light bg-white rounded">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

                {{-- Publish Page --}}
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('publish.index') }}">{{ __('Publish') }}</a>
                </li>

                <!-- Vertical Separator -->
                <hr class="line-vertical"/>

                {{-- Connect Page --}}
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('login') }}">{{ __('Connect') }}</a>
                </li>

                <!-- Vertical Separator -->
                <hr class="line-vertical"/>

                {{-- Account Page --}}
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('account.index') }}">{{ __('Account') }}</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @endif

                <!-- Vertical Separator -->
                <hr class="line-vertical"/>

                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                        {{-- User Avatar --}}
                        <img src="/storage/avatars/{{ Auth::user()->avatar }}" width="40" height="40" class="rounded-circle">

                        {{-- User Name --}}
                        {{ strlen(Auth::user()->name) <= 20 ? Auth::user()->name : substr(Auth::user()->name, 0, 19) . "...";  }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        {{-- Dashboard Page --}}
                        <a class="dropdown-item" href="{{ route('account.dashboard') }}">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#settings"/></svg>
                            {{ __('Dashboard') }}
                        </a>

                        <!-- Horizontal Separator -->
                        <div class="dropdown-divider"></div>

                        {{-- My Profile --}}
                        <a class="dropdown-item" href="{{ route('account.profile') }}">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#person"/></svg>
                            {{ __('My Profile') }}
                        </a>

                        <!-- Horizontal Separator -->
                        <div class="dropdown-divider"></div>

                        {{-- My Profile --}}
                        <a class="dropdown-item" href="{{ route('account.security') }}">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#shield"/></svg>
                            {{ __('Security') }}
                        </a>

                        <!-- Horizontal Separator -->
                        <div class="dropdown-divider"></div>

                        {{-- Logout --}}
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#off"/></svg>
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
<br>
