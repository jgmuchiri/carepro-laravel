@extends('frontend.layouts.app')

@section('content')

<div class="section-empty section-item">
    <div class="container content">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 login-box shadow-1 ">
            	<div class="text-center">
            		<h2 style="padding-bottom:20px;">Daycare Registration</h2>
            	</div>
				<form class="form-box" method="POST" action="{{ route('daycare.store') }}" accept-charset="UTF-8" role="form">
					{{ csrf_field() }}
				    <div class="row">
				    	<div class="col-md-6">
				    		<p>Name *</p>
				            <input class="form-control form-value" required="" name="name" type="text" value="{{ old('name') }}">
				            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
				    	</div>
				    	<div class="col-md-6">
				    		<p>Employee Tax Identifier *</p>
				            <input class="form-control" required="" name="employee_tax_identifier" type="text" value="{{ old('employee_tax_identifier') }}">
				            @if ($errors->has('employee_tax_identifier'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('employee_tax_identifier') }}</strong>
                                </span>
                            @endif
				    	</div>
				    </div>
				    <hr class="space xs" />
				    @include('partials.address-form')
			        <button class="btn-sm btn" type="submit">Register</button>
				</form>
            </div>
        </div>
    </div>
</div>
@endsection