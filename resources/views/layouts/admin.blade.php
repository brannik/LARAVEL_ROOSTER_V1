<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
    <div id="app">

        @php
            use App\Http\Controllers\AccountData;
        @endphp
        <nav class="navbar sticky-top navbar-expand-sm navbar-dark bg-dark shadow-sm">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <img src="{{ url('images/') }}" width="30" height="30" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @guest
                        
                        @else
                            @if (Route::has('rooster'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('rooster') }}">{{ __('Guild Rooster') }}</a>
                                </li>
                            @endif   
                            @if (Route::has('events'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('events') }}">{{ __('Guild Events') }}</a>
                                </li>
                            @endif  
                            @if (Route::has('forum'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('forum') }}">{{ __('Forum') }}</a>
                                </li>
                            @endif 
                            @if (Route::has('support'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('support') }}">{{ __('Support') }}</a>
                                </li>
                            @endif  

                            <!-- get reqruiter guild rank !!!!important -->
                            @if(Auth::user()->guild_rank > 5 || Auth::user()->rank >=4)
                                @if (Route::has('guild_controll'))
                                @if(Auth::user()->guild_id > 0)
                                    @if(AccountData::is_rqruiter(Auth::user()->guild_id) == 1 || Auth::user()->rank >= 3 )
                                    <li class="nav-item">
                                        <a class="nav-link text-primary" href="{{ route('guild_controll') }}">{{ __('Guild Controll') }}</a>
                                    </li>
                                    @endif
                                @else 
                                    @if(AccountData::is_rqruiter(Auth::user()->guild_id) == 1 || Auth::user()->rank >= 3 )
                                    <li class="nav-item">
                                        <a class="nav-link text-primary" href="{{ route('create_guild') }}">{{ __('Create Guild') }}</a>
                                    </li>
                                    @endif
                                @endif
                                    
                                @endif
                            @endif
                            @if(Auth::user()->rank >= 3)
                                @if (Route::has('moderator'))
                                    <li class="nav-item">
                                        <a class="nav-link text-warning" href="{{ route('moderator') }}">{{ __('MOD') }}</a>
                                    </li>
                                @endif
                            @endif
                            @if(Auth::user()->rank >= 2)
                                @if (Route::has('support_admin'))
                                    <li class="nav-item">
                                        <a class="nav-link text-warning" href="{{ route('support_admin') }}">{{ __('Support MOD') }}</a>
                                    </li>
                                @endif
                            @endif
                            @if(Auth::user()->rank >= 3)
                                @if (Route::has('admin_panell_view_main'))
                                    <li class="nav-item">
                                        <a class="nav-link text-danger" href="{{ route('admin_panell_view_main') }}">{{ __('ACP') }}</a>
                                    </li>
                                @endif
                            @endif
                            
                        @endguest
                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('my_account') }}">Account</a>
                                    <a class="dropdown-item" href="{{ route('notifications') }}">Notifications</a>
                                    <a class="dropdown-item" href="{{ route('mailbox') }}">Mailbox</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
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
        </nav>

        <div class="row">
            <div class="col">
                @if ($errors->any())
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <h4 class="alert-heading">Ops!!</h4>
                    <p>Here is some errors.</p>
                    <hr>
                    <p class="mb-0">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif        
            
        </div>
        </div>

        <main class="py-4">
            
            @yield('content')

            

            <div class="footer fixed-bottom float-center bg-dark text-primary">
                Powered by Brannik 2021
            </div>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

</body>
</html>
