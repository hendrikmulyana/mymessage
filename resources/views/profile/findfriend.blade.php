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
                            <div class="col-sm-12 col-md-12">
                           @foreach($allUsers as $uList)
                               <div class="col-md-4">
                               <div class="thumbnail">
                                   <h2 align="center">{{$uList->username}}</h2>
                                   <div style="padding-left: 60px; padding-top: 10px; padding-bottom: 2px">
                                       <img src="/image/avatar/{{$uList->avatar}}" style="width:80px; height: 80px;" class="img-circle"/>
                                   </div>
                                   <div class="caption" align="center">
                                       <p><i class="fa fa-globe"></i> {{$uList->city}} - {{$uList->country}}</p>
                                       <?php
                                           $check = DB::table('friendships')
                                           ->where('user_requested', '=', $uList->id)
                                           ->where('requester', '=', Auth::user()->id)
                                           ->first();

                                           if ($check ==''){
                                           ?>
                                       <p>
                                           <a href="{{url('/')}}/addFriend/{{$uList->id}}"
                                             class="btn btn-info">Add to Friend</a>
                                       </p>
                                       <?php } else {
                                       echo"<p><a class='btn btn-default disabled'>Request Already Sent</a></p>";
                                       } ?>
                                   </div>
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
