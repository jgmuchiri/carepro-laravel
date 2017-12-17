@extends('layouts.logged-out')

@section('content')
<div class="wrapper">
    <div class="pricing-4 section section-gray">
        <div class="container">
            <div class="row">
                <div class="col-md-6 ml-auto mr-auto text-center">
                    <h2 class="title">Pick the best plan for you</h2>
                    <h5 class="description">You have Free Unlimited Updates and Premium Support on each package.</h5>
                </div>
            </div>
            <div class="space-top"></div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-pricing">
                        <div class="card-body">
                            <h6 class="card-category text-primary">@lang('STANDARD')</h6>
                            <small>14 @lang('days FREE trial')*</small>
                            <h1 class="card-title">{{ currency(10.00, 'USD', Laravel\Cashier\Cashier::usesCurrency(), true) }}<small>/@lang('mo')</small></h1>
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
                            <a href="{{ route('subscriptions.subscribe-to-trial', 'Standard') }}" class="btn btn-primary btn-round">@lang('START YOUR FREE TRIAL')</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-pricing" data-color="orange">
                        <div class="card-body">
                            <h6 class="card-category text-success">@lang('PROFESSIONAL')</h6>
                            <small>14 @lang('days FREE trial')*</small>
                            <h1 class="card-title">{{ currency(20.00, 'USD', Laravel\Cashier\Cashier::usesCurrency(), true) }}<small>/@lang('mo')</small></h1>
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
                            <a href="{{ route('subscriptions.subscribe-to-trial', 'Professional') }}" class="btn btn-neutral btn-round">@lang('START YOUR FREE TRIAL')</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-pricing">
                        <div class="card-body">
                            <h6 class="card-category text-primary">@lang('PREMIUM')</h6>
                            <small>14 @lang('days FREE trial')*</small>
                            <h1 class="card-title">{{ currency(35.00, 'USD', Laravel\Cashier\Cashier::usesCurrency(), true) }}<small>/@lang('mo')</small></h1>
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
                            <a href="{{ route('subscriptions.subscribe-to-trial', 'Premium') }}" class="btn btn-primary btn-round">@lang('START YOUR FREE TRIAL')</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 text-center">
                    <p class="small">*@lang('During the free trial your account will be limited to 10 staff and children accounts and only be to generate 5 invoices.')</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
