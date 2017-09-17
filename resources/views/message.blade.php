@extends('profile.master')

@section('content')

    <div class="col-md-12">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="row">
                    <div class="col-md-4"> </div>
                    <div class="panel-heading"><div class="col-md-8"><b>@{{ msg }}</b></div>
                    <div class="col-md-2 pull-right">
                        <a href="{{url('/newMessage')}}">
                            <img src="{{Config::get('app.url')}}/image/logo/compose.png" title="Send New Messages"></a>
                    </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div v-for="privsteMsg in privsteMsgs">
                        <li @click="messages(privsteMsg.id)" v-on:click="seen = true"
                        style="list-style: none; margin-top: 10px;
                            background-color: #F3F3F3" class="row">

                            <div class="col-md-3 pull-left">
                            <img :src="'{{Config::get('app.url')}}/image/avatar/' + privsteMsg.avatar"
                                 style="width:50px; border-radius:100%; margin: 5px">
                            </div>

                            <div class="col-md-9 pull-left" style="margin-top: 5px">
                            <b>@{{ privsteMsg.username }}</b><br>
                                <small>Gender: @{{privsteMsg.gender}}</small>
                            </div>
                        </li>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Messages</strong></div>
                <div class="panel-body">
                    <div v-for="singleMsg in singleMsgs">
                        <div v-if="singleMsg.user_from == <?php echo Auth::user()->id;?>">
                            <div class="col-md-12 " style="margin-top: 10px">
                                <img :src="'{{Config::get('app.url')}}/image/avatar/' + singleMsg.avatar"
                                     style="width:30px; border-radius:100%; margin-left: 5px" class="pull-right">
                                <div style="float: right; background-color: #0084ff; padding:5px 15px 5px 15px;
                             margin-right: 10px; color: #333; border-radius: 10px; color: #fff" >
                                    <b>@{{ singleMsg.msg }}</b>
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <div class="col-md-12 pull-right" style="margin-top: 10px">
                                <img :src="'{{Config::get('app.url')}}/image/avatar/' + singleMsg.avatar"
                                     style="width:30px; border-radius:100%; margin-left: 5px" class="pull-left">
                                <div style="float: left; background-color: #f0f0f0; padding: 5px 15px 5px 15px;
                                     border-radius: 10px; text-align: right; margin-left: 5px" >
                                    <b>@{{ singleMsg.msg }}</b>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div  v-if="seen">
                    <input type="hidden" v-model="conID">
                    <b>
                        <textarea class="col-md-12 form-control" v-model="msgFrom" placeholder="What your message"
                                  style="margin-top: 15px; border: none"></textarea>
                        <input  style="margin-top: 10px; margin-left: 485px" class="btn btn-info" type="button" value="send message" @click="sendMsg()">
                    </b>
                    </div>
                    </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Information your Friend</strong></div>
                <div class="panel-body">
                    <div v-for="privsteMsg in privsteMsgs">
                        <div style="margin-left: 90px; margin-bottom: 10px">
                        <img :src="'{{Config::get('app.url')}}/image/avatar/' + privsteMsg.avatar"
                             style="width:70px; border-radius:100%; margin: 5px">
                        </div>
                        <div class="thumbnail">
                        <p style="margin-left: 40px"><i class="fa fa-user fa-fw" aria-hidden="true"></i> <b>- @{{ privsteMsg.namadepan }} @{{ privsteMsg.namabelakang }}</b></p>
                        <p style="margin-left: 40px"><i class="fa fa-user-secret fa-fw" aria-hidden="true"></i> <b>- @{{ privsteMsg.gender }}</b></p>
                        <p style="margin-left: 40px"><i class="fa fa-gift fa-fw" aria-hidden="true"></i> <b>- @{{ privsteMsg.email }}</b></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
