

<div class="form-group">
        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        {!! Form::open(['url' => '/client', 'class' => 'form-horizontal', 'files' => true]) !!}

            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('namadepan') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Name</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="<?php echo $client->name; ?>" required autofocus>

                    @if ($errors->has('namadepan'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('namadepan') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>


            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" value="<?php echo $client->email; ?>" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="col-md-offset-6 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Update', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
</div>


