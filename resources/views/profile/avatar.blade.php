@extends('profile.master')

@section('content')
    <div class="col-md-12">
        <div class="col-md-3">
            @include('profile.sidebar')
        </div>
            <div class="col-md-9">
                <div class="col-md-10">
                    <div class="panel panel-default">
                        <div class="panel-heading"><strong>{{Auth::user()->slug}}'s</strong></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6 col-md-4">
                                    <div class="thumbnail">
                                        <div style="padding-left: 100px; padding-top: 10px; padding-bottom: 160px">
                                        <img src="/image/avatar/{{$user->avatar}}" style="width:150px; height: 150px; float: left; border-radius: 50%;margin-right: 25px"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-md-4">
                                    <form enctype="multipart/form-data" action="updateavatar" method="POST">
                                        <div style="padding-top: 50px">
                                            <Input type="file" name="avatar">
                                            <Input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <hr>
                                            <button type="submit" class="pull-left btn btn-sm btn-primary">Update Photo</button>
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
