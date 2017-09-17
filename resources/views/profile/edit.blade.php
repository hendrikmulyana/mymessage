@extends('profile.master')

@section('content')

    <div class="col-md-12">
        <div class="col-md-3">
           @include('profile.sidebar')
        </div>
            <div class="col-md-9">
                <div class="col-md-10">
                    <div class="panel panel-default">
                        <div class="panel-heading">Edit Profile <strong>{{Auth::user()->slug}}'s</strong></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="thumbnail">
                                        <div style="padding-left: 290px; padding-top: 10px; padding-bottom: 155px">
                                            <img src="/image/avatar/{{Auth::user()->avatar}}" style="width:150px; height: 150px; float: left; border-radius: 50%;margin-right: 25px"/>
                                        </div>
                                        <div class="caption">
                                            <p align="center"><strong>{{$data->city}} - {{$data->country}}</strong></p>
                                            <p align="center"><a href="{{url('changePhoto')}}" class="btn btn-primary" role="button">Change Photo</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-12">
                                    <h4><span class="label label-default">Update Profile</span></h4>
                                    <form action="{{url('updateProfile')}}" method="POST">
                                    <Input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <div class="col-md-7">
                                        <div class="input-group">
                                            <span><strong>About</strong></span>
                                            <strong><textarea type="text" class="form-control" rows="6" cols="40" name="about"></textarea></strong>
                                        </div>
                                    </div>
                                   <div class="col-md-5">
                                    <div class="input-group">
                                        <span><strong>City Name</strong></span>
                                        <strong><input type="text" class="form-control" placeholder="Your City" name="city"></strong>
                                    </div>
                                    <div class="input-group">
                                        <span><strong>Country Name</strong></span>
                                        <strong><input type="text" class="form-control" placeholder="Your Country" name="country"></strong>
                                    </div>
                                       <br>
                                       <div class="input-group">
                                           <button type="submit" class="btn btn-success right">Save</button>
                                       </div>
                                   </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
