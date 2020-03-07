<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="d-flex flex-column flex-md-row align-items-center p-2 px-md-4">
            <h5 class="my-0 mr-md-auto font-weight-bold">{{ __('Laravel Blog') }}</h5>
            <nav class="my-2 my-md-0">
                <a class="p-1 text-dark text-muted" href="{{ route('home1') }}">{{ __('Home') }}</a><span class="text-center shadow-lg">.</span>
                <a class="p-1 text-dark text-muted" href="{{ route('contact') }}">{{ __('Contact') }}</a><span class="text-center shadow-lg">.</span>
                <a class="p-1 text-dark text-muted" href="{{ route('posts.index') }}">{{ __('Blog') }}</a>
                @if (Auth::user())
                    <span class="text-center shadow-lg">.</span>
                    <a class="p-1 text-dark text-muted" href="{{ route('posts.dashboard') }}">{{ __('Dashboard') }}</a><span class="text-center shadow-lg">.</span>
                    <a class="p-1 text-dark text-muted" href="{{ route('posts.create') }}">{{ __('Add Post') }}</a>                 
                @endif
            
                <!-- Right Side Of Navbar -->
                @guest
                    <span class="text-center shadow-lg">|</span>
                    <a class="px-1" href="{{ route('login') }}">{{ __('Login') }}</a>  
                    @if (Route::has('register'))
                        <span class="text-center shadow-lg">.</span>
                        <a class="px-1" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                @else
                    <span class="text-center shadow-lg text-muted px-1 d-inline">|</span>
                    <a class="p-1 text-dark text-muted" href="{{ route('users.show', ['user' => Auth::user()->id]) }}">{{ __('Profile') }}</a>                 
                    <a class="p-1 text-dark text-muted" href="{{ route('users.edit', ['user' => Auth::user()->id]) }}">{{ __('Edit Profile') }}</a>                 

                    <a class="dropdown">
                        <a id="navbarDropdown" class="dropdown-toggle p-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </a>
                @endguest
            </nav>
        </div>

        <hr class="mt-1">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif (session()->has('danger'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session()->get('danger') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif (session()->has('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session()->get('warning') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif (session()->has('info'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {{ session()->get('info') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @yield('content')
    </div>
    {{-- <script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('js/popper.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script> --}}
</body>
</html>