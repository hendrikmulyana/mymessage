@extends('profile.master')

@section('content')

    <div class="col-md-12">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="row" style="padding-bottom: 5px">
                    <div class="col-md-4"> </div>
                    <div class="panel-heading"><div class="col-md-7"><b>@{{ msg }}</b></div>
                     <div class="col-md-5 pull-right">
                    <a href="{{url('message')}}" class="btn btn-sm btn-info">All messages</a>
                </div>
                     </div>
                </div>

            @foreach($friends as $friend)
                    <div class="panel-body" style="padding: 5px">
                        <div class="col-md-12">
                        <li @click="friendID({{$friend->id}})" v-on:click="seen = true" style="list-style:none;
                            background-color:#F3F3F3" class="row">

                        <div class="col-md-3 pull-left">
                        <img src="{{Config::get('app.url')}}/image/avatar/{{$friend->avatar}}"
                         style="width:50px; border-radius:100%; margin:5px">
                        </div>

                        <div class="col-md-9 pull-left" style="margin-top: 5px">
                            <b> {{$friend->username}}</b><br>
                            <small>Gender: {{$friend->gender}}</small>
                        </div>
                        </li>
                        </div>
                    </div>
            @endforeach
            </div>
        </div>



            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Messages</strong></div>
                    <div class="panel-body">
                        <p class="alert alert-info"><b>Message your friend</b></p>

                    <div  v-if="seen">
                    <input type="hidden" v-model="friend_id">
                        <b><textarea class="col-md-12 form-control" v-model="newMsgFrom" placeholder="What your message"></textarea></b>
                    <input  style="margin-top: 10px; margin-left: 485px" class="btn btn-info" type="button" value="send message" @click="sendNewMsg()">
                    </div>
                    </div>
                </div>
             </div>

            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Information your Friend</strong></div>
                    <div class="panel-body">
                    </div>
                </div>
            </div>
    </div>


@endsection