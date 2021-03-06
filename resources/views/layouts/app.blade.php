<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ elixir('css/all.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ route('index') }}">
                    Movie-Rental
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    {{--<li><a href="{{ url('/home') }}">Home</a></li>--}}
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown" id="cart" @if(count(Auth::User()->basketRentals) == 0) style="display: none;" @endif>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> 
                                <span class="glyphicon glyphicon-shopping-cart"></span>

                                <span id="rent-count" class="badge">{{count(Auth::User()->basketRentals)}}</span>
                                
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-cart" role="menu">
                                @foreach(Auth::User()->basketRentals as $rental)
                                    <li id="cart{{$rental->id}}">
                                        <span class="item">
                                            <span class="item-left">
                                                <span class="item-info">
                                                    <span>{{$rental->getMovie()->getTitle()}}</span>
                                                </span>
                                            </span>
                                            <span class="item-right">
                                                <a class="btn btn-xs btn-danger pull-right" onclick="removeRent({{$rental->id}})">x</a>
                                            </span>
                                        </span>
                                    </li>
                                @endforeach
                                <li class="divider"></li>
                                <li><a class="text-center" href="/profile#basket">View Cart</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" claInboxss="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>


                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('profile::index') }}"><i class="fa fa-btn fa-user"></i>Profile</a></li>
                                @role('admin')
                                <li><a href="{{ route('admin::index') }}"><i class="fa fa-btn fa-user"></i>Admin</a></li>
                                @endrole
                                <li><a href="{{ url('logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
                <form class="navbar-form" id="search" role="search" action="/search" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" class="form-control" name="query" placeholder="Search" value="{{ old('query') }}">
                        </div>
                </form>
            </div>
        </div>
    </nav>
    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="{{ elixir('js/removeRent.js') }}"></script>
</body>
</html>
