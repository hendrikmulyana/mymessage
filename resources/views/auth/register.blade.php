@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Add Admin</strong></div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('namadepan') ? ' has-error' : '' }}">
                                <label for="namadepan" class="col-md-4 control-label">First Name</label>

                                <div class="col-md-6">
                                    <strong>
                                    <input id="namadepan" type="text" class="form-control" name="namadepan" value="{{ old('namadepan') }}" required autofocus>
                                    </strong>
                                    @if ($errors->has('namadepan'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('namadepan') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('namabelakang') ? ' has-error' : '' }}">
                                <label for="namabelakang" class="col-md-4 control-label">Last Name</label>

                                <div class="col-md-6">
                                    <strong>
                                    <input id="namabelakang" type="text" class="form-control" name="namabelakang" value="{{ old('namabelakang') }}" required autofocus>
                                    </strong>
                                    @if ($errors->has('namabelakang'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('namabelakang') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                <label for="gender" class="col-md-4 control-label">Gender</label>

                                <div class="col-md-6">
                                    <strong>
                                        <select name="gender" class="form-control col-md-4">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </strong>
                                    @if ($errors->has('gender'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <strong>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                    </strong>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('notelp') ? ' has-error' : '' }}">
                                <label for="notelp" class="col-md-4 control-label">No Telepon</label>

                                <div class="col-md-6">
                                    <strong>
                                    <input id="notelp" type="text" class="form-control" name="notelp" value="{{ old('notelp') }}" required autofocus>
                                    </strong>
                                    @if ($errors->has('notelp'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('notelp') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <label for="notelp" class="col-md-4 control-label">Username</label>

                                <div class="col-md-6">
                                    <strong>
                                    <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>
                                    </strong>
                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
