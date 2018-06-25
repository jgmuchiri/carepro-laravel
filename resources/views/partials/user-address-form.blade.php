<div class="form-group{{ $errors->has('address_line_1') ? ' has-danger' : '' }}">
	{{Form::label(__('Address Line 1'))}}*
	{{Form::input('text','address_line_1',$user->address->address_line_1,['class'=>'form-control','placeholder'=>__('Street and number, P.O. box, c/o.')])}}
	@if ($errors->has('address_line_1'))
		<span class="help-block has-danger">
                    <strong>{{ $errors->first('address_line_1') }}</strong>
                </span>
	@endif
</div>

<div class="form-group{{ $errors->has('address_line_2') ? ' has-danger' : '' }}">
	{{Form::label(__('Address Line 2'))}}
	{{Form::input('text','address_line_2',$user->address_line_2,['class'=>'form-control','placeholder'=>__('Apartment, suite, unit, building, floor, etc.')])}}
	@if ($errors->has('address_line_2'))
		<span class="help-block has-danger">
                    <strong>{{ $errors->first('address_line_2') }}</strong>
                </span>
	@endif
</div>

<div class="form-group{{ $errors->has('city') ? ' has-danger' : '' }}">
	{{Form::label(__('City / Town / Village'))}}
	{{Form::input('text','city',$user->address->city->name,['class'=>'form-control','placeholder'=>__('City / Town / Village')])}}
	@if ($errors->has('city'))
		<span class="help-block has-danger">
                    <strong>{{ $errors->first('city') }}</strong>
                </span>
	@endif
</div>
<div class="row">
	<div class="col-sm-8">
		<div class="form-group{{ $errors->has('state') ? ' has-danger' : '' }}">
			{{Form::label(__('State / Province / Region'))}}
			{{Form::input('text','state',$user->address->state->name,['class'=>'form-control','placeholder'=>__('State / Province / Region')])}}
			@if ($errors->has('state'))
				<span class="help-block has-danger">
                    <strong>{{ $errors->first('state') }}</strong>
                </span>
			@endif
		</div>
	</div>
	<div class="col-sm-4">

		<div class="form-group{{ $errors->has('zip_code') ? ' has-danger' : '' }}">
			{{Form::label(__('ZIP'))}}
			{{Form::input('text','zip_code', $user->address->zipCode->zip_code,['class'=>'form-control','placeholder'=>__('ZIP')])}}
			@if ($errors->has('zip_code'))
				<span class="help-block has-danger">
                    <strong>{{ $errors->first('zip_code') }}</strong>
                </span>
			@endif
		</div>
	</div>
</div>

<div class="form-group{{ $errors->has('country') ? ' has-danger' : '' }}">
	{{Form::label(__('Country'))}}
	{{Form::select('country',[$user->address->country->id=>$user->address->country->name],null,['class'=>'form-control'])}}
	@if ($errors->has('country'))
		<span class="help-block has-danger">
                    <strong>{{ $errors->first('country') }}</strong>
                </span>
	@endif
</div>
