@extends('profile.master')

@section('content')
<div class="col-md-12">
    <div class="col-md-3">
        @include('profile.sidebar')
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading"><strong>Chat Messeger</strong></div>
            <div class="panel-body">
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading"><strong>Your Friends Chat</strong></div>
            <div class="panel-body">
            </div>
        </div>
    </div>
</div>
@endsection
