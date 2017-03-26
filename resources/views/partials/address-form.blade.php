<div class="form-group{{ $errors->has('address_line_1') ? ' has-error' : '' }}">
    <label for="address_line_1" class="col-md-4 control-label">Address Line 1</label>

    <div class="col-md-6">
        <input id="address_line_1" type="text" class="form-control" name="address_line_1" value="{{ old('address_line_1') }}" required placeholder="Street and number, P.O. box, c/o.">

        @if ($errors->has('address_line_1'))
            <span class="help-block">
                <strong>{{ $errors->first('address_line_1') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('address_line_2') ? ' has-error' : '' }}">
    <label for="address_line_2" class="col-md-4 control-label">Address Line 2</label>

    <div class="col-md-6">
        <input id="address_line_2" type="text" class="form-control" name="address_line_2" value="{{ old('address_line_2') }}" placeholder="Apartment, suite, unit, building, floor, etc.">

        @if ($errors->has('address_line_2'))
            <span class="help-block">
                <strong>{{ $errors->first('address_line_2') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
    <label for="city" class="col-md-4 control-label">City / Town / Village</label>

    <div class="col-md-6">
        <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}" required>

        @if ($errors->has('city'))
            <span class="help-block">
                <strong>{{ $errors->first('city') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
    <label for="state" class="col-md-4 control-label">State / Province / Region</label>

    <div class="col-md-6">
        <input id="state" type="text" class="form-control" name="state" value="{{ old('state') }}" required>

        @if ($errors->has('state'))
            <span class="help-block">
                <strong>{{ $errors->first('state') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('zip_code') ? ' has-error' : '' }}">
    <label for="zip_code" class="col-md-4 control-label">ZIP</label>

    <div class="col-md-6">
        <input id="zip_code" type="text" class="form-control" name="zip_code" value="{{ old('zip_code') }}" required>

        @if ($errors->has('zip_code'))
            <span class="help-block">
                <strong>{{ $errors->first('zip_code') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
    <label for="country" class="col-md-4 control-label">Country</label>

    <div class="col-md-6">
        <input id="country" type="text" class="form-control" name="country" value="{{ old('country') }}" required>

        @if ($errors->has('country'))
            <span class="help-block">
                <strong>{{ $errors->first('country') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
    <label for="phone" class="col-md-4 control-label">Phone Number</label>

    <div class="col-md-6">
        <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required>

        @if ($errors->has('phone'))
            <span class="help-block">
                <strong>{{ $errors->first('phone') }}</strong>
            </span>
        @endif
    </div>
</div>
