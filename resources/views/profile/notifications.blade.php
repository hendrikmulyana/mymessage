@extends('profile.master')

@section('content')

    <div class="col-md-12">
        <div class="col-md-3">
            @include('profile.sidebar')
        </div>
            <div class="col-md-9">
                <div class="col-md-10">
                    <div class="panel panel-default">
                        <div class="panel-heading"><strong>Profile Your Friend</strong></div>
                        <div class="panel-body">
                            <div class="col-sm-12 col-md-12">
                                @if(session()->has('msg'))
                                    <p class="alert alert-success">
                                        {{ session()->get('msg') }}
                                    </p>
                                @endif
                                @foreach($notes as $note)
                                    <div class="row" style="border-bottom: 1px solid #ccc; margin-bottom: 15px; padding-bottom: 10px">

                                        <ul>
                                            <li>
                                                <p><a href="{{url('profile')}}/{{$note->slug}}" style="font-weight: bold; color: green">
                                                        {{$note->username}}</a> {{$note->note}}</p>
                                            </li>
                                        </ul>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
