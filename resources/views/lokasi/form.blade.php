

<div class="form-group">
        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        {!! Form::open(['url' => '/lokasi', 'class' => 'form-horizontal', 'files' => true]) !!}

            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('kabkot') ? ' has-error' : '' }}">
                <label for="kabkot" class="col-md-4 control-label">Kabupaten/Kota</label>

                <div class="col-md-6">
                    <strong>
                    <input id="kabkot" type="text" class="form-control" name="kabkot" value="<?php echo $lokasi->kabkot; ?>" required autofocus>
                    </strong>
                    @if ($errors->has('kabkot'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('kabkot') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('kecamat') ? ' has-error' : '' }}">
                <label for="kecamat" class="col-md-4 control-label">Kecamatan</label>

                <div class="col-md-6">
                    <strong>
                    <input id="kecamat" type="text" class="form-control" name="kecamat" value="<?php echo $lokasi->kecamatan; ?>" required autofocus>
                    </strong>
                    @if ($errors->has('kecamat'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('kecamat') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('lat') ? ' has-error' : '' }}">
                <label for="lat" class="col-md-4 control-label">Latitude</label>

                <div class="col-md-6">
                    <strong>
                    <input id="lat" type="text" class="form-control" name="lat" value="<?php echo $lokasi->lat; ?>" required>
                    </strong>
                    @if ($errors->has('lat'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('lat') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('long') ? ' has-error' : '' }}">
                <label for="long" class="col-md-4 control-label">Longtitude</label>

                <div class="col-md-6">
                    <strong>
                    <input id="long" type="text" class="form-control" name="long" value="<?php echo $lokasi->lng; ?>" required autofocus>
                    </strong>
                    @if ($errors->has('long'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('long') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="col-md-offset-6 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Update', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
</div>


