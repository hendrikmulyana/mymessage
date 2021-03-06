@extends('profile.master')

@section('content')

    <div class="col-md-12">
        <div class="col-md-3">
            @include('profile.sidebar')
        </div>
            <div class="col-md-9">
                <div class="col-md-10">
                    <div class="panel panel-default">
                        <div class="panel-heading"><strong>List Request Friends</strong></div>
                        <div class="panel-body">
                            <div class="col-sm-12 col-md-12">
                                @if(session()->has('msg'))
                                    <p class="alert alert-success">
                                        {{ session()->get('msg') }}
                                    </p>
                                @endif
                                @foreach($FriendRequests as $uList)
                                        <div class="row" style="border-bottom: 1px solid #ccc; margin-bottom: 15px; padding-bottom: 10px">
                                            <div class="col-md-2 pull-left">
                                                <img src="/image/avatar/{{$uList->avatar}}" class="img-thumbnail" style="width:80px; height: 80px"/>
                                            </div>

                                            <div class="col-md-6 pull-left">
                                                <h4 style="margin: 0px"><a href=""><b>{{ucwords($uList->username)}}</b></a></h4>
                                                <p>Gender : {{$uList->gender}}</p>
                                                <p><b>{{$uList->email}}</b></p>
                                            </div>
                                            <div class="col-md-4 pull-right">
                                                <p>
                                                    <a href="{{url('accept')}}/{{$uList->username}}/{{$uList->id}}"
                                                       class="btn btn-primary">Confrim</a>
                                                    <a href="{{url('requestRemove')}}/{{$uList->id}}"
                                                       class="btn btn-default">Remove</a>
                                                </p>
                                            </div>

                                        </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
