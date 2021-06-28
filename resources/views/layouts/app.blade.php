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
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
    <div id="app">
        
        @php
            use App\Http\Controllers\AccountData;
            use App\Http\Controllers\Permission;

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
                            @if(Permission::check('mod_panel') == true)
                                @if (Route::has('moderator'))
                                    <li class="nav-item">
                                        <a class="nav-link text-warning" href="{{ route('moderator') }}">{{ __('MOD') }}</a>
                                    </li>
                                @endif
                            @endif
                            @if(Permission::check('mod_supp_panel') == true)
                                @if (Route::has('support_admin'))
                                    <li class="nav-item">
                                        <a class="nav-link text-warning" href="{{ route('support_admin') }}">{{ __('Support MOD') }}</a>
                                    </li>
                                @endif
                            @endif
                            @if(Permission::check('admin_panel') == true)
                                @if (Route::has('admin_panell_view_main'))
                                    <li class="nav-item">
                                        <a class="nav-link text-danger" href="{{ route('admin_panell_view_main') }}">{{ __('ACP') }}</a>
                                    </li>
                                @endif
                            @endif
                            @if (Route::has('chat'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('chat') }}">{{ __('Live chat') }}</a>
                                </li>
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

        <main class="py-4">
            
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @if(!empty(Auth::user()->rank) && Auth::user()->rank >=3)
                        <div class="card mb-3 border border-danger bg-dark text-primary">
                    @elseif(!empty(Auth::user()->rank) && Auth::user()->rank == 2)
                        <div class="card mb-3 border border-warning bg-dark text-primary">
                    @else
                        <div class="card mb-3 border border-info bg-dark text-primary">
                    @endif
                    
                        
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                              <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                            </ol>
                            <div class="carousel-inner">
                              <div class="carousel-item active">
                                <img class="d-block w-100 h-50" src="{{ url('images/banner.jpg') }}" alt="First slide">
                              </div>
                              <div class="carousel-item">
                                <img class="d-block w-100 h-50" src="{{ url('images/banner2.jpg') }}" alt="Second slide">
                              </div>
                              <div class="carousel-item">
                                <img class="d-block w-100 h-50" src="{{ url('images/banner3.jpg') }}" alt="Third slide">
                              </div>
                              <div class="carousel-item">
                                <img class="d-block w-100 h-50" src="{{ url('images/banner4.jpg') }}" alt="Fourth slide">
                              </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="sr-only">Next</span>
                            </a>
                          </div>

                        <div class="card-body">
                          <h5 class="card-title">@yield('title')
                            @auth
                                @if(Auth::user()->rank >= 2)
                                    @yield('new_post_button')
                                @endif
                            @endauth
                                </h5>
                                    @if ($errors->any())

                                    <div class="alert alert-success" role="alert">
                                    <h4 class="alert-heading">Error!</h4>
                                    <p>
                                        @foreach ($errors->all() as $error)
                                            {{ $error }}
                                        @endforeach
                                    </p>
                                    <hr>
                                    <p class="mb-0">Please try again.</p>
                                </div>
                                    
                                @endif
                            @yield('content')
                            <br><br>
                        </div>
                    </div>
                </div>
            </div>
            @auth
            <div class="fixed-bottom float-left mb-4">
            <!-- guild chat cnavas -->
            <example-component></example-component>
            <div class="float-left container justify-content-center">
                <div class="row mb-2">
                    <div class="col-sm-2">
                        @if(Auth::user()->guild_rank > 0 && Permission::check('guild_chat') == true)
                @php
                    $g_count = 0;
                    foreach (Permission::get_guild_online() as $g_online) {
                        if(Cache::has('user-is-online-' . $g_online['go_id'])) $g_count = $g_count + 1;
                    }
                @endphp
                <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                    <small>Guild ({{ $g_count }})</small>
                </button>

                <div class="offcanvas offcanvas-end bg-info" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel" >
                    <div class="offcanvas-header">
                        <h5 id="offcanvasRightLabel">Guild chat</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body" id="gchat">
                            <div class="frames-container h-auto w-100 px-1" id="chat_box_guild">
                                
                                        <div class="clearfix" v-for="message in messages.slice().reverse()">

                                            <div class="card mt-1 border border-primary p-1" id="message_card">
                                                <div class="row g-0" id="outer_row">
                                                  <div class="col-md-4">
                                                    <img class="rounded-circle mt-4 ml-2 border border-primary" src="{{ url('images/no_user.jpg') }}" style="height: 30px; width: 30px;" alt="...">
                                                    <h6 class="pt-2">
                                                        @{{ message.user.name }}
                                                    </h6>
                                                  </div>
                                                  <div class="col-md-8">
                                                    <div class="card-body">
                                                      <p class="card-text">
                                                        @{{ message.message }}
                                                        </p>
                                                      
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>

                                  </div>
                            </div>
                            
                        </div>
                    <div class="offcanvas-footer mb-4 px-2">
                        <div class="input-group">
                            <input
                                type="text"
                                name="message"
                                class="form-control"
                                placeholder="Type your message here..."
                                v-model="newMessage"
                                @keyup.enter="sendMessage"
                            >
            
                            <button
                                class="btn btn-primary"
                                @click="sendMessage"
                            >
                                Send
                            </button>
                        </div>
                        </div>
                    </div>
                </div>
            
            @endif
                    </div>
                <div class="row">
                    <div class="col-sm-2">
                        @if(Permission::check('support_chat') == true)
                        @php
                            $count = 0;
                            foreach (Permission::get_support_online() as $user) {
                                if(Cache::has('user-is-online-' . $user['id'])) $count = $count + 1;
                            }
                        @endphp
                        <button class="btn btn-danger btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#support_chat" aria-controls="support_chat">
                            <small>Staff({{ $count }})</small>
                        </button>
                        
                        <div class="offcanvas offcanvas-end bg-info" tabindex="-1" id="support_chat" aria-labelledby="offcanvasRightLabel">
                            
                            <div class="offcanvas-header">
                                <h5 id="offcanvasRightLabel">Support Chat</h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                            <div class="offcanvas-body">
                                <div class="frames-container h-auto w-100 bg-light" id="chat_box">
                                    <div class="row px-4" id="message">
        
                                        <div class="card mt-1 border border-danger" id="message_card">
                                            <div class="row g-0" id="outer_row">
                                              <div class="col-md-4">
                                                <img class="rounded-circle mt-4 ml-2 border border-primary" src="{{ url("images/no_user.jpg") }}" style="height: 50px; width: 50px;" alt="...">
                                                <h6 class="pt-2">Admin</h6>
                                              </div>
                                              <div class="col-md-8">
                                                <div class="card-body">
                                                  <p class="card-text">
                                                    There is admin online.  
                                                    </p>
                                                  <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
        
                                    </div>
                                </div>
                                
                            </div>
                            <div class="offcanvas-footer mb-4 px-2">
                                <input type="text" class='form-text w-100'>
                                <button class="btn btn-outline-primary w-100 mt-3">Send</button>
                            </div>
                        </div>
                    
                    @endif
                    </div>
                </div>
            </div>
        
        </div>
            @endauth
            <div class="footer fixed-bottom float-center bg-dark text-primary">
                Powered by &#174; Brannik 2021
            </div>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <script src="{{ asset('js/support_chat.js') }}" defer></script>
</body>
</html>
