<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.tittle', 'MyMessage') }}</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

</head>
<body style="background-color: #eceff1">
<div id="app">
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
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="fa fa-spinner" aria-hidden="true"></i>
                    <strong>
                        {{ config('app.tittle', 'MyMessage') }}
                    </strong>
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    @if (Auth::guest())
                    @else
                        <li><a href="{{ url('findFriend') }}/{{Auth::user()->slug}}"><i class="fa fa-search fa-lg" aria-hidden="true"></i><strong> Find Friends</strong></a></li>
                        <li><a href="{{ url('request') }}/{{Auth::user()->slug}}"><i class="fa fa-gift fa-lg" aria-hidden="true"></i>
                                <strong> My Request<span style="color: red">({{App\Friendship::where('status',0)
                                ->where('user_requested',Auth::user()->id)
                                ->count()}})</span></strong></a></li>
                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}"></a></li>
                    @else
                        <li><a href="{{ url('friends') }}/{{Auth::user()->slug}}"><i class="fa fa-users fa-lg" aria-hidden="true"></i></a></li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <i class="fa fa-globe fa-lg" aria-hidden="true"></i>
                                <span class="badge badge-secondary" style="background:red; position: relative; top: -10px; left: -10px">
                                    {{App\notifications::where('status',1)
                                    ->where('user_hero',Auth::user()->id)
                                    ->count()}}
                                </span>
                            </a>

                            <?php
                            $notes = DB::table('admin')
                                ->leftJoin('notifications','admin.id','notifications.user_logged')
                                ->where('user_hero',Auth::user()->id)
                                ->where('status',1)
                                ->orderBy('notifications.created_at','desc')
                                ->get();
                            ?>

                            <ul class="dropdown-menu" role="menu" style="min-width: 300px">
                                @foreach($notes as $note)
                                    <a href="{{url('notifications')}}/{{$note->id}}">
                                        @if($note->status==1)
                                            <li style="background: #E4E9F2; padding: 2px">
                                        @else
                                            <li style="padding: 2px">
                                                @endif
                                                <div class="row">
                                                    <div class="col-md-2 pull-left">
                                                        <img src="/image/avatar/{{$note->avatar}}"
                                                             style="width:45px; margin:5px; padding: 5px; background: #fff; border: 1px solid #eee" class="img-rounded"/>
                                                    </div>

                                                    <div class="col-md-10">
                                                        <b style="color: green; font-size:90%">{{ucwords($note->username)}}</b>
                                                        <span style="color: #000; font-size: 90%">{{$note->note}}</span>
                                                        <br>
                                                        <small style="color: #90949c"><i aria-hidden="true" class="fa fa-users"></i>
                                                            {{date('F j, Y',strtotime($note->created_at))}}
                                                            at {{date('H: i', strtotime($note->created_at))}}</small>
                                                    </div>
                                                </div>
                                            </li>
                                    </a>
                                @endforeach
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="position: relative; padding-left: 50px">
                                <img src="/image/avatar/{{Auth::user()->avatar}}" style="width: 32px; height: 32px; position: absolute; top: 10px;left: 10px; border-radius: 50%">
                                <strong>{{ucwords(Auth::user()->username)}}</strong>
                                <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('profile') }}/{{Auth::user()->slug}}"><i class="fa fa-user-secret fa-lg" aria-hidden="true"></i>Profile</a></li>
                                <li><a href="{{ url('client') }}"><i class="fa fa-users fa-fw" aria-hidden="true"></i> Employee Data</a></li>
                                <li><a href="{{ url('admin') }}"><i class="fa fa-users fa-fw" aria-hidden="true"></i> Manager Data</a></li>
                                <li><a href="{{ route('register') }}"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i> Add Manager</a></li>
                                <li><a href="{{ url('editProfile') }}/{{Auth::user()->slug}}"><i class="fa fa-pencil-square fa-fw" aria-hidden="true"></i> Sunting Profile</a></li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa fa-power-off" aria-hidden="true"></i>&nbsp;
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
