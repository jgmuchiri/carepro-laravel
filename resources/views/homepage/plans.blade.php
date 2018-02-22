@extends('layouts.logged-out')

@section('content'){{config('app.description')}}
<div class="wrapper">
	<div class="pricing-4 section section-gray">
		<div class="container">
			<h3 class="text-center">Plans & Pricing</h3>
			<div class="row bs-wizard hidden-xs" style="border-bottom:0;">

				<div class="col-4 bs-wizard-step active">
					<div class="text-center bs-wizard-stepnum">
						<img src="{{ url('assets/vendor/icon-pack-1/svg/admin.png') }}" width="36" height="36">
					</div>
					<div class="progress">
						<div class="progress-bar"></div>
					</div>
					<a href="#" class="bs-wizard-dot"></a>
					<div class="bs-wizard-info text-center">Plan</div>
				</div>

				<div class="col-4 bs-wizard-step disabled"><!-- complete -->
					<div class="text-center bs-wizard-stepnum">
						<img src="{{ url('assets/vendor/icon-pack-1/svg/child.svg') }}" width="36" height="36">
					</div>
					<div class="progress">
						<div class="progress-bar"></div>
					</div>
					<a href="#" class="bs-wizard-dot"></a>
					<div class="bs-wizard-info text-center">User Registration</div>
				</div>

				<div class="col-4 bs-wizard-step disabled">
					<div class="text-center bs-wizard-stepnum">
						<img src="{{ url('assets/vendor/icon-pack-1/svg/group.png') }}" width="36" height="36"/>
					</div>
					<div class="progress">
						<div class="progress-bar"></div>
					</div>
					<a href="#" class="bs-wizard-dot"></a>
					<div class="bs-wizard-info text-center">Daycare Registration</div>
				</div>
			</div>
			<div class="space-top"></div>
			<div class="row">
				<div class="col-md-4">
					<div class="card card-pricing">
						<div class="card-body">
							<h6 class="card-category text-primary">@lang('STANDARD')</h6>
							<small>14 @lang('days FREE trial')*</small>
							<h1 class="card-title">{{ currency(10.00, 'USD', Laravel\Cashier\Cashier::usesCurrency(), true) }}
								<small>/@lang('mo')</small>
							</h1>
							<ul>
								<li>
									<b>
										{{ $plans->where('name', 'Standard')->first()->number_of_children_allowed }}
									</b>
									@lang('Children')
								</li>
								<li>
									<b>
										{{ $plans->where('name', 'Standard')->first()->number_of_staff_allowed }}
									</b>
									@lang('Staff Members')
								</li>
								<li>
									@if ($plans->where('name', 'Standard')->first()->has_invoice_due_alert_to_parents)
										@lang('Invoice due alerts to parents')
									@else
										<strike>@lang('Invoice due alerts to parents')</strike>
									@endif
								</li>
							</ul>
							<a href="{{ route('subscriptions.subscribe-to-trial', 'Standard') }}"
							   class="btn btn-primary btn-round">@lang('START YOUR FREE TRIAL')</a>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card card-pricing" data-color="orange">
						<div class="card-body">
							<h6 class="card-category text-success">@lang('PROFESSIONAL')</h6>
							<small>14 @lang('days FREE trial')*</small>
							<h1 class="card-title">{{ currency(20.00, 'USD', Laravel\Cashier\Cashier::usesCurrency(), true) }}
								<small>/@lang('mo')</small>
							</h1>
							<ul>
								<li>
									<b>
										{{ $plans->where('name', 'Professional')->first()->number_of_children_allowed }}
									</b>
									@lang('Children')
								</li>
								<li>
									<b>
										{{ $plans->where('name', 'Professional')->first()->number_of_staff_allowed }}
									</b>
									@lang('Staff Members')
								</li>
								<li>
									@if ($plans->where('name', 'Professional')->first()->has_invoice_due_alert_to_parents)
										@lang('Invoice due alerts to parents')
									@else
										<strike>@lang('Invoice due alerts to parents')</strike>
									@endif
								</li>
							</ul>
							<a href="{{ route('subscriptions.subscribe-to-trial', 'Professional') }}"
							   class="btn btn-neutral btn-round">@lang('START YOUR FREE TRIAL')</a>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card card-pricing">
						<div class="card-body">
							<h6 class="card-category text-primary">@lang('PREMIUM')</h6>
							<small>14 @lang('days FREE trial')*</small>
							<h1 class="card-title">{{ currency(35.00, 'USD', Laravel\Cashier\Cashier::usesCurrency(), true) }}
								<small>/@lang('mo')</small>
							</h1>
							<ul>
								<li>
									<b>
										{{ $plans->where('name', 'Premium')->first()->number_of_children_allowed }}
									</b>
									@lang('Children')
								</li>
								<li>
									<b>
										{{ $plans->where('name', 'Premium')->first()->number_of_staff_allowed }}
									</b>
									@lang('Staff Members')
								</li>
								<li>
									@if ($plans->where('name', 'Premium')->first()->has_invoice_due_alert_to_parents)
										@lang('Invoice due alerts to parents')
									@else
										<strike>@lang('Invoice due alerts to parents')</strike>
									@endif
								</li>
							</ul>
							<a href="{{ route('subscriptions.subscribe-to-trial', 'Premium') }}"
							   class="btn btn-primary btn-round">@lang('START YOUR FREE TRIAL')</a>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-12 text-center">
					<p class="small">
						*@lang('During the free trial your account will be limited to 10 staff and children accounts and only be to generate 5 invoices.')</p>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
