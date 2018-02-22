@extends('layouts.logged-out')

@section('content')
	<div class="wrapper">
		<div class="pricing-4 section section-gray">
			<div class="container">
				<div class="space-top"></div>
				<h3 class="text-center">@lang("Contact us")</h3>
				<hr/>
				<div class="row">
					<div class="col-md-6">
						{!! Form::open(['route'=>'contact.us','method'=>'POST']) !!}
						{!! Form::hidden('fname') //catch bots !!}
						<label>@lang("Name")*</label>
						{!! Form::text('name',null,['required'=>'required','class'=>'form-control']) !!}
						<label>@lang("Email")*</label>
						{!! Form::input('email','email',null,['required'=>'required','class'=>'form-control']) !!}
						<label>@lang("Phone")</label>
						{!! Form::text('phone',null,['required'=>'required','class'=>'form-control']) !!}
						<label>@lang("Message")*</label>
						{!! Form::textarea('message',null,['required'=>'required','class'=>'form-control']) !!}

						<br/>
						<button class="btn btn-default">@lang("Send")</button>
						{!! Form::close() !!}
					</div>
					<div class="col-md-6">
						<h3 style="color: #db61a8;">{{config('app.name')}}</h3>
						<br/>
						<i class="fa fa-phone"></i> {{config('app.phone')}} <br/><br/>
						<i class="fa fa-envelope"></i>
						{{config('app.address.street1')}}<br/>
						<div style="padding-left:24px">
							@if(config('app.address.street2') !=="")
								{{config('app.address.street2')}} <br/>
							@endif
							{{config('app.address.city')}},
							{{config('app.address.state')}}
							{{config('app.address.zipcode')}} <br/>
							{{config('app.address.country')}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
