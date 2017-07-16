<div class="form-group{{ $errors->has('address_line_1') ? ' has-error' : '' }}">
    {!! Form::label('address_line_1', __('Address Line 1'), ['class' => 'col-md-4 control-label']) !!}

    <div class="col-md-6">
        {!! Form::text('address_line_1', null, ['id' => 'address_line_1', 'class' => 'form-control', 'required' => '', 'placeholder' => 'Street and number, P.O. box, c/o.']) !!}

        @if ($errors->has('address_line_1'))
            <span class="help-block">
                <strong>{{ $errors->first('address_line_1') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('address_line_2') ? ' has-error' : '' }}">
    {!! Form::label('address_line_2', __('Address Line 2'), ['class' => 'col-md-4 control-label']) !!}

    <div class="col-md-6">
        {!! Form::text('address_line_2', null, ['id' => 'address_line_2', 'class' => 'form-control', 'placeholder' => 'Apartment, suite, unit, building, floor, etc.']) !!}

        @if ($errors->has('address_line_2'))
            <span class="help-block">
                <strong>{{ $errors->first('address_line_2') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
    {!! Form::label('city', __('City / Town / Village'), ['class' => 'col-md-4 control-label']) !!}

    <div class="col-md-6">
        {!! Form::text('city', null, ['id' => 'city', 'class' => 'form-control', 'required' => '']) !!}

        @if ($errors->has('city'))
            <span class="help-block">
                <strong>{{ $errors->first('city') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
    {!! Form::label('state', __('State / Province / Region'), ['class' => 'col-md-4 control-label']) !!}

    <div class="col-md-6">
        {!! Form::text('state', null, ['id' => 'state', 'class' => 'form-control', 'required' => '']) !!}

        @if ($errors->has('state'))
            <span class="help-block">
                <strong>{{ $errors->first('state') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('zip_code') ? ' has-error' : '' }}">
    {!! Form::label('zip_code', __('ZIP'), ['class' => 'col-md-4 control-label']) !!}

    <div class="col-md-6">
        {!! Form::text('zip_code', null, ['id' => 'zip_code', 'class' => 'form-control', 'required' => '']) !!}

        @if ($errors->has('zip_code'))
            <span class="help-block">
                <strong>{{ $errors->first('zip_code') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
    {!! Form::label('country', __('Country'), ['class' => 'col-md-4 control-label']) !!}

    <div class="col-md-6">
        {!! Form::select('country', $countries, null, ['id' => 'country', 'class' => 'form-control', 'required' => '']) !!}

        @if ($errors->has('country'))
            <span class="help-block">
                <strong>{{ $errors->first('country') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
    {!! Form::label('phone', __('Phone Number'), ['class' => 'col-md-4 control-label']) !!}

    <div class="col-md-6">
        {!! Form::text('phone', null, ['id' => 'phone', 'class' => 'form-control', 'required' => '']) !!}

        @if ($errors->has('phone'))
            <span class="help-block">
                <strong>{{ $errors->first('phone') }}</strong>
            </span>
        @endif
    </div>
</div>
