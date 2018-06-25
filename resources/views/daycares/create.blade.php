@extends('layouts.logged-out')

@section('content')
	<div class="wrapper">
		<div class="pricing-4 section ">
			<div class="container">
				<div class="row bs-wizard hidden-xs" style="border-bottom:0;">

					<div class="col-4 bs-wizard-step complete">
						<div class="text-center bs-wizard-stepnum">
							<img src="{{ url('assets/vendor/icon-pack-1/svg/admin.png') }}" width="36" height="36">
						</div>
						<div class="progress">
							<div class="progress-bar"></div>
						</div>
						<a href="#" class="bs-wizard-dot"></a>
						<div class="bs-wizard-info text-center">@lang('Plan')</div>
					</div>

					<div class="col-4 bs-wizard-step complete"><!-- complete -->
						<div class="text-center bs-wizard-stepnum">
							<img src="{{ url('assets/vendor/icon-pack-1/svg/child.svg') }}" width="36" height="36">
						</div>
						<div class="progress">
							<div class="progress-bar"></div>
						</div>
						<a href="#" class="bs-wizard-dot"></a>
						<div class="bs-wizard-info text-center">@lang('User Registration')</div>
					</div>

					<div class="col-4 bs-wizard-step active">
						<div class="text-center bs-wizard-stepnum">
							<img src="{{ url('assets/vendor/icon-pack-1/svg/group.png') }}" width="36" height="36"/>
						</div>
						<div class="progress">
							<div class="progress-bar"></div>
						</div>
						<a href="#" class="bs-wizard-dot"></a>
						<div class="bs-wizard-info text-center">@lang('Daycare Registration')</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 ml-auto mr-auto text-center">
						<h2 class="title">@lang('Register your daycare')</h2>
					</div>
				</div>
				<div class="space-top"></div>
				<div class="row">
					<div class="col-md-8 offset-md-2">
						<form method="POST" action="{{ route('daycare.store') }}" accept-charset="UTF-8" role="form">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label for="name" class="control-label">@lang('Name') *</label>
										<input id="name" class="form-control" required="" autofocus="" name="name"
											   type="text" value="{{ old('name') }}">
										@if ($errors->has('name'))
											<span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
										@endif
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
										<label for="employee_tax_identifier"
											   class="control-label">@lang('Employee Tax Identifier') *</label>
										<input id="employee_tax_identifier" class="form-control" required=""
											   name="employee_tax_identifier" type="text"
											   value="{{ old('employee_tax_identifier') }}">
										@if ($errors->has('employee_tax_identifier'))
											<span class="help-block">
                                            <strong>{{ $errors->first('employee_tax_identifier') }}</strong>
                                        </span>
										@endif
									</div>
								</div>
							</div>

							@include('partials.address-form')

							<h3>@lang('Legal Representative')</h3>
							<div class="row">
								<div class="col-sm-6">
									<h4>{{$user->name}}</h4> <br/>
									<div class="form-group{{ $errors->has('date_of_birth')? ' has-danger': '' }}">
										{{Form::label('Date of birth')}}
										{{Form::input('date','date_of_birth',null,['required'=>'','class'=>'form-control','id'=>'date_of_birth'])}}
									</div>
									<div class="form-group{{ $errors->has('ssn_last_4')? ' has-danger': '' }}">
										{{Form::label('SSN Last 4')}}
										{{Form::input('text','ssn_last_four',null,['required'=>'','class'=>'form-control','id'=>'ssn_last_four'])}}
									</div>
								</div>
							</div>

							<div class="form-group text-center">
								<div class="12">
									<input class="btn btn-primary" type="submit" value="Register">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
