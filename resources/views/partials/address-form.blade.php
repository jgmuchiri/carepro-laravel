<div class="row">
    <div class="col-sm-6">
       <div class="form-group{{ $errors->has('address_line_1') ? ' has-danger' : '' }}">
            <label for="address_line_1" class="control-label">Address Line 1 *</label>
            <input id="address_line_1" class="form-control" required="" placeholder="Street and number, P.O. box, c/o." name="address_line_1" type="text" value="{{ old('address_line_1') }}">
            @if ($errors->has('address_line_1'))
                <span class="help-block has-danger">
                    <strong>{{ $errors->first('address_line_1') }}</strong>
                </span>
            @endif
        </div> 
    </div>
    <div class="col-sm-6{{ $errors->has('address_line_2') ? ' has-danger' : '' }}">
       <div class="form-group">
            <label for="address_line_2" class="control-label">Address Line 2</label>
            <input id="address_line_2" class="form-control" placeholder="Apartment, suite, unit, building, floor, etc." name="address_line_2" type="text" value="{{ old('address_line_2') }}">
            @if ($errors->has('address_line_2'))
                <span class="help-block has-danger">
                    <strong>{{ $errors->first('address_line_2') }}</strong>
                </span>
            @endif
        </div> 
    </div>
</div>
<div class="row">
    <div class="col-sm-5">
       <div class="form-group{{ $errors->has('city') ? ' has-danger' : '' }}">
            <label for="city" class="control-label">City / Town / Village *</label>
            <input id="city" class="form-control" required="" name="city" type="text" value="{{ old('city') }}">
            @if ($errors->has('city'))
                <span class="help-block has-danger">
                    <strong>{{ $errors->first('city') }}</strong>
                </span>
            @endif
        </div> 
    </div>
    <div class="col-sm-5">
       <div class="form-group{{ $errors->has('state') ? ' has-danger' : '' }}">
            <label for="state" class="control-label">State / Province / Region *</label>
            <input id="state" class="form-control" required="" name="state" type="text" value="{{ old('state') }}">
            @if ($errors->has('state'))
                <span class="help-block has-danger">
                    <strong>{{ $errors->first('state') }}</strong>
                </span>
            @endif
        </div> 
    </div>
    <div class="col-sm-2">
       <div class="form-group{{ $errors->has('zip_code') ? ' has-danger' : '' }}">
            <label for="zip_code" class="control-label">ZIP *</label>
            <input id="zip_code" class="form-control" required="" name="zip_code" type="text" value="{{ old('zip_code') }}">
            @if ($errors->has('zip_code'))
                <span class="help-block has-danger">
                    <strong>{{ $errors->first('zip_code') }}</strong>
                </span>
            @endif
        </div> 
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
       <div class="form-group{{ $errors->has('country') ? ' has-danger' : '' }}">
            <label for="country" class="control-label">Country *</label>
            <select id="country" class="form-control" required="" name="country"><option value="1">United States</option></select>
            @if ($errors->has('country'))
                <span class="help-block has-danger">
                    <strong>{{ $errors->first('country') }}</strong>
                </span>
            @endif
        </div> 
    </div>
    <div class="col-sm-6">
       <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
            <label for="phone" class="control-label">Phone Number *</label>
            <input id="phone" class="form-control" required="" name="phone" type="text" value="{{ old('phone') }}">
            @if ($errors->has('phone'))
                <span class="help-block has-danger">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
            @endif
        </div> 
    </div>
</div>
