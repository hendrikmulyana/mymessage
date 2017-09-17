@extends('profile.master')

@section('content')
    <div class="col-md-12">
        <div class="col-md-3">
            @include('profile.sidebar')
        </div>
            @foreach($userData as $uData)
            <div class="col-md-9">
                <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">Profile <strong>{{$uData->slug}}</strong>'s</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6 col-md-4">
                            <div class="thumbnail">
                                <div style="padding-left: 100px; padding-top: 10px; padding-bottom: 130px">
                                <img src="/image/avatar/{{$uData->avatar}}" style="width:150px; height: 150px; float: left; border-radius: 50%;margin-right: 25px"/>
                                </div>
                                <div class="caption">
                                    <h3 align="center"><strong>{{ucwords($uData->username)}}</strong></h3>
                                    <p align="center"><strong><i class="fa fa-globe"></i> {{$uData->city}} - {{$uData->country}}</strong></p>
                                    @if ($uData->admin_id == Auth::user()->id)
                                    <p align="center"><a href="{{url('editProfile')}}/{{Auth::user()->slug}}"
                                                         class="btn btn-primary" role="button">Edit Profile</a></p>
                                        @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <h4><span class="label label-default">About</span></h4>
                            <p><strong>{{$uData->about}}</strong></p>
                        </div>
                    </div>

                </div>
            </div>
                </div>
            </div>
                @endforeach
        </div>
@endsection
