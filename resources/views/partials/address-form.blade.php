<div class="row">
    <div class="col-md-6">
       <div class="form-group{{ $errors->has('address_line_1') ? ' has-error' : '' }}">
            <p>Address Line 1 *</p>
            <input id="address_line_1" class="form-control" required="" placeholder="Street and number, P.O. box, c/o." name="address_line_1" type="text" value="{{ old('address_line_1') }}">
            @if ($errors->has('address_line_1'))
                <span class="help-block has-error">
                    <strong>{{ $errors->first('address_line_1') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6 {{ $errors->has('address_line_2') ? ' has-error' : '' }}">
            <p>Address Line 2</p>
            <input id="address_line_2" class="form-control" placeholder="Apartment, suite, unit, building, floor, etc." name="address_line_2" type="text" value="{{ old('address_line_2') }}">
            @if ($errors->has('address_line_2'))
                <span class="help-block has-error">
                    <strong>{{ $errors->first('address_line_2') }}</strong>
                </span>
            @endif
    </div>
</div>
<div class="row">
    <div class="col-md-5">
       <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
            <p>City / Town / Village *</p>
            <input id="city" class="form-control" required="" name="city" type="text" value="{{ old('city') }}">
            @if ($errors->has('city'))
                <span class="help-block has-error">
                    <strong>{{ $errors->first('city') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-5">
       <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
            <p>State / Province / Region *</p>
            <input id="state" class="form-control" required="" name="state" type="text" value="{{ old('state') }}">
            @if ($errors->has('state'))
                <span class="help-block has-error">
                    <strong>{{ $errors->first('state') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-2">
       <div class="form-group{{ $errors->has('zip_code') ? ' has-error' : '' }}">
            <p>ZIP *</p>
            <input id="zip_code" class="form-control" required="" name="zip_code" type="text" value="{{ old('zip_code') }}">
            @if ($errors->has('zip_code'))
                <span class="help-block has-error">
                    <strong>{{ $errors->first('zip_code') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
       <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
            <p for="country">Country *</p>
            <select id="country" class="form-control" required="" name="country"><option value="1">United States</option></select>
            @if ($errors->has('country'))
                <span class="help-block has-error">
                    <strong>{{ $errors->first('country') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-6">
       <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
            <p for="phone">Phone Number *</p>
            <input id="phone" class="form-control" required="" name="phone" type="text" value="{{ old('phone') }}">
            @if ($errors->has('phone'))
                <span class="help-block has-error">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
