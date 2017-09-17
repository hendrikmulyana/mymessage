<html lang="en" xmlns:v-on="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MyMessage</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://use.fontawesome.com/595a5020bd.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

    <!-- Styles -->
    <style>
        html, body {
            background-color: #ddd;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            margin: 0;
        }
        .full-height {
            margin-top:50px
        }
        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }
        .position-ref {
            position: relative;
        }
        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }
        .content {
            text-align: center;
        }
        .title {
            font-size: 84px;
        }
        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
        .m-b-md {
            margin-bottom: 30px;
        }
        .head_har{
            background-color: #f6f7f9;
            border-bottom: 1px solid #dddfe2;
            border-radius: 2px 2px 0 0;
            font-weight: bold;
            padding: 8px 6px;
        }
        .left-sidebar, .right-sidebar{
            background-color:#fff;
            min-height:100%
        }
        .posts_div{margin-bottom:10px !important}
        .posts_div h3{
            margin-top:4px !important;
        }
        #postText{
            border:none;
            height:100px
        }
        .likeBtn{
            color: #4b4f56; font-weight:bold; cursor: pointer;
        }
        .left-sidebar li { padding:10px;
            border-bottom:1px solid #ddd;
            list-style:none; margin-left:-20px}
        .dropdown-menu{min-width:120px; left:-30px}
        .dropdown-menu a{ cursor: pointer;}
        .dropdown-divider {
            height: 1px;
            margin: .5rem 0;
            overflow: hidden;
            background-color: #eceeef;}
        .user_name{font-size:18px;
            font-weight:bold; text-transform:capitalize; margin:3px}
        .all_posts{background-color:#fff; padding:15px;
            margin-bottom:15px; border-radius:5px;
            -webkit-box-shadow: 0 8px 6px -6px #666;
            -moz-box-shadow: 0 8px 6px -6px #666;
            box-shadow: 0 8px 6px -6px #666;}
        #commentBox{
            background-color:#ddd;
            padding:10px;
            width:99%; margin:0 auto;
            background-color:#F6F7F9;
            padding:10px;
            margin-bottom:10px
        }
        #commentBox li { list-style:none; padding:10px; border-bottom:1px solid #ddd}
        .commet_form{ padding:10px; margin-bottom:10px}
    </style>

</head>
<body>
@if (Route::has('login'))
    <div class="top-right links">
        @if (Auth::check())
            <a href="{{url('jobs')}}" style="background-color:#283E4A;
              color:#fff; padding:5px 15px 5px 15px; border-radius:5px">Find Job</a>
            <a href="{{ url('/home') }}">Dashboard
                (<span style="text-transform:capitalize;
                color:green">{{ucwords(Auth::user()->name)}}</span>)</a>
            <a href="{{ url('/logout') }}">Logout</a>
        @else
            <a href="{{ url('/login') }}">Login</a>
            <a href="{{ url('/register') }}">Register</a>
        @endif
    </div>
@endif
<div class="flex-center position-ref full-height">

    <div class="col-md-12"  id="app">
        <div class="col-md-3 left-sidebar hidden-xs hidden-sm">
            @if(Auth::check())
                <ul>
                    <li>
                        <a href="{{ url('home') }}">
                            <img src="{{Config::get('app.url')}}/image/avatar/{{Auth::user()->avatar}}"
                                 width="32" style="margin:5px" class="img-rounded"  />
                            <span style=" color: #000"><b>{{Auth::user()->username}}</b> (Home)</span></a>
                    </li>
                    <li>
                        <a href="{{url('friends')}}/{{Auth::user()->slug}}"> <img src="{{Config::get('app.url')}}/image/logo/grup.png"
                                                                                  width="32" style="margin:5px"  />
                            <span style=" color: #000"><b>Friends</b></span></a>
                    </li>
                    <li>
                        <a href="{{url('message')}}"> <img src="{{Config::get('app.url')}}/image/logo/message.png"
                                                           width="32" style="margin:5px"  />
                            <span style=" color: #000"><b>Messages</b></span></a>
                    </li>
                    <li>
                        <a href="{{url('findFriend')}}/{{Auth::user()->slug}}"> <img src="{{Config::get('app.url')}}/image/logo/find.png"
                                                                                     width="32" style="margin:5px"  />
                            <span style=" color: #000"><b>Find Friends</b></span></a>
                    </li>

                    <li>
                        <a href="{{url('#')}}"> <img src="{{Config::get('app.url')}}/image/logo/job.png"
                                                     width="32" style="margin:5px"  />
                            <span style=" color: #000"><b>Find Jobs</b></span></a>
                    </li>
                </ul>
            @endif

        </div>

        <div class="col-md-6 col-sm-12 col-xs-12 center-con">
            @if(Auth::check())
                <div class="posts_div">
                    <div class="head_har">
                        @{{msg}}
                    </div>
                    <div style="background-color:#fff">
                        <div class="row">
                            <div class="col-md-1 pull-left">
                                <img src="{{url('../')}}/image/avatar/{{Auth::user()->avatar}}"
                                     style="width:50px; margin:5px; padding:5px" class="img-rounded">
                            </div>
                            <div class="col-md-11 pull-right">
                                <form method="post" enctype="multipart/form-data" v-on:submit.prevent="addPost">
                <b><textarea v-model="content" id="postText" class="form-control"
                          placeholder="what's on your mind ?"></textarea></b>
                                    <button type="submit" class="btn btn-sm btn-info pull-right" style="margin:10px" id="postBtn">
                                        <i class="fa fa-paper-plane" aria-hidden="true"></i> Post</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="">

                <div v-for="post in posts">

                </div>
            </div>
        </div>

        <div class="col-md-3 right-sidebar hidden-sm hidden-xs" >
            <h3 align="center"></h3>
        </div>


    </div>

</div>

<script src="{{asset('js/app.js')}}"></script>
<script>
    $(document).ready(function(){
        $('#postBtn').hide();
        $("#postText").hover(function() {
            $('#postBtn').show();
        });
    });
</script>
</body>
</html>
