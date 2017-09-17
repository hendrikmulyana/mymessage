@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="col-md-6">
                    <div class="panel panel-default" style="width: 1050px">
                        <div class="panel-heading">
                            <div class="panel-body">
                            <img src="/image/avatar/{{$user->avatar}}" style="width:150px; height: 150px; float: left; border-radius: 50%;margin-right: 25px"/>
                            <h2><strong>{{ $user->username }}'s Profile</strong></h2>
                            <form enctype="multipart/form-data" action="profile" method="POST">
                                <label>Update Profile Image</label>
                                <Input type="file" name="avatar">
                                <Input type="hidden" name="_token" value="{{csrf_token()}}">
                                <Input type="submit" class="pull-right btn btn-sm btn-primary">
                            </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
