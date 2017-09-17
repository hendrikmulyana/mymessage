

<div class="form-group">
        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        {!! Form::open(['url' => '/admin', 'class' => 'form-horizontal', 'files' => true]) !!}

            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('namadepan') ? ' has-error' : '' }}">
                <label for="namadepan" class="col-md-4 control-label">Nama Depan</label>

                <div class="col-md-6">
                    <strong>
                    <input id="namadepan" type="text" class="form-control" name="namadepan" value="<?php echo $admins->namadepan; ?>" required autofocus>
                    </strong>
                    @if ($errors->has('namadepan'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('namadepan') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('namabelakang') ? ' has-error' : '' }}">
                <label for="namabelakang" class="col-md-4 control-label">Nama Belakang</label>

                <div class="col-md-6">
                    <strong>
                    <input id="namabelakang" type="text" class="form-control" name="namabelakang" value="<?php echo $admins->namabelakang; ?>" required autofocus>
                    </strong>
                    @if ($errors->has('namabelakang'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('namabelakang') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                <div class="col-md-6">
                    <strong>
                    <input id="email" type="email" class="form-control" name="email" value="<?php echo $admins->email; ?>" required>
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
                    <input id="notelp" type="text" class="form-control" name="notelp" value="<?php echo $admins->notelp; ?>" required autofocus>
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
                    <input id="username" type="text" class="form-control" name="username" value="<?php echo $admins->username; ?>" required autofocus>
                    </strong>
                    @if ($errors->has('username'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="col-md-offset-6 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Update', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
</div>


