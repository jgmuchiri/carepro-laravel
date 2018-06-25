<div class="row">
	<div class="col-sm-6">
		<div class="form-group{{ $errors->has('address_line_1') ? ' has-danger' : '' }}">
			{{Form::label(__('Address Line 1'))}}*
			{{Form::input('text','address_line_1',old('address_line_1'),['class'=>'form-control','id'=>'address_line_1','placeholder'=>'Street and number, P.O. box, c/o.'])}}
			@if ($errors->has('address_line_1'))
				<span class="help-block has-danger">
                    <strong>{{ $errors->first('address_line_1') }}</strong>
                </span>
			@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6{{ $errors->has('address_line_2') ? ' has-danger' : '' }}">
		<div class="form-group">
			{{Form::label(__('Address Line 2'))}}
			{{Form::input('text','address_line_2',old('address_line_2'),['class'=>'form-control','id'=>'address_line_2','placeholder'=>__('Apartment, suite, unit, building, floor, etc')])}}
			@if ($errors->has('address_line_2'))
				<span class="help-block has-danger">
                    <strong>{{ $errors->first('address_line_2') }}</strong>
                </span>
			@endif
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6">
		<div class="form-group{{ $errors->has('city') ? ' has-danger' : '' }}">
			{{Form::label(__('City / Town / Village'))}}*
			{{Form::input('text','city',old('city'),['class'=>'form-control','id'=>'city'])}}
			@if ($errors->has('city'))
				<span class="help-block has-danger">
                    <strong>{{ $errors->first('city') }}</strong>
                </span>
			@endif
		</div>
	</div>
	<div class="col-sm-4">
		<div class="form-group{{ $errors->has('state') ? ' has-danger' : '' }}">
			{{Form::label(__('State / Province / Region'))}}*
			{{Form::input('text','state',old('state'),['class'=>'form-control', 'id'=>'state'])}}
			@if ($errors->has('state'))
				<span class="help-block has-danger">
                    <strong>{{ $errors->first('state') }}</strong>
                </span>
			@endif
		</div>
	</div>
	<div class="col-sm-2">
		<div class="form-group{{ $errors->has('zip_code') ? ' has-danger' : '' }}">
			{{Form::label(__('ZIP'))}}*
			{{Form::input('text','zip_code',old('zip_code'),['class'=>'form-control', 'id'=>'zip_code'])}}
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
			{{Form::label(__('Country'))}}*
			<select id="country" class="form-control" required="" name="country">
				<option value="1">United States</option>
			</select>
			@if ($errors->has('country'))
				<span class="help-block has-danger">
                    <strong>{{ $errors->first('country') }}</strong>
                </span>
			@endif
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
			{{Form::label(__('Phone Number'))}}*
			{{Form::input('text','phone',old('phone'),['class'=>'form-control', 'id'=>'phone'])}}
			@if ($errors->has('phone'))
				<span class="help-block has-danger">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
			@endif
		</div>
	</div>
</div>
