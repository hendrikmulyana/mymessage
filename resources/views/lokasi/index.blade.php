@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Data Lokasi</div>
                <div class="panel-body">

                        {!! Form::open(['method' => 'GET', 'url' => '/lokasi', 'class' => 'navbar-form navbar-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        {!! Form::close() !!}

                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Kabupaten/Kota</th>
                                    <th>Kecamtan</th>
                                    <th>Latitude</th>
                                    <th>Longtitude</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>

                                <tbody>
                                @if (count($lokasi)>0)
                                @foreach($lokasi->all() as $item)
                                    <tr>
                                        <td><strong>{{ $item->id }}</strong></td>
                                        <td><strong>{{ $item->kabkot }}</strong></td>
                                        <td><strong>{{ $item->kecamatan }}</strong></td>
                                        <td><strong>{{ $item->lat }}</strong></td>
                                        <td><strong>{{ $item->lng }}</strong></td>
                                        <td>
                                            <a href="{{ url('/admin/'.$item->id.'/edit') }}" title="Edit Data">
                                                <button class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                                            </a>

                                            {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['admin',$item->id],
                                            'style' => 'display:inline'
                                            ]) !!}

                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-xs',
                                            'title' => 'Delete',
                                            'onclick'=>'return confirm("Confirm delete?")'
                                               ))!!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                @endif
                                </tbody>
                            </table>
                            <div class="text-center">
                                {!! $lokasi->links() !!}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
