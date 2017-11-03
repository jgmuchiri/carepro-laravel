@extends('layouts.logged-out')

@push('styles')
    <link href="/css/subscriptions.css" rel="stylesheet"/>
@endpush

@section('content')
    <div class="container">
        <div class="row center center-text">
            <div class="col-md-offset-1 col-md-3">
                <p><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></p>
                <p>@lang('Plan')</p>
            </div>
            <div class="col-md-4">
                <p><span class="glyphicon glyphicon-user" aria-hidden="true"></span></p>
                <p>@lang('User Registration')</p>
            </div>
            <div class="col-md-4">
                <p><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span></p>
                <p>@lang('Daycare Registration')</p>
            </div>
        </div>
        <div class="row">
            <div>
                <div class="col-xs-12 col-md-3 col-md-offset-1">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                @lang('STANDARD')</h3>
                        </div>
                        <div class="panel-body">
                            <div class="the-price">
                                <h1>
                                    {{ currency(10.00, 'USD', Laravel\Cashier\Cashier::usesCurrency(), true) }}<span class="subscript">/@lang('mo')</span></h1>
                                <small>14 @lang('days FREE trial')*</small>
                            </div>
                            <table class="table">
                                <tr>
                                    <td>
                                        {{ $plans->where('name', 'Standard')->first()->number_of_children_allowed }} @lang('Children')
                                    </td>
                                </tr>
                                <tr class="active">
                                    <td>
                                        {{ $plans->where('name', 'Standard')->first()->number_of_staff_allowed }} @lang('Staff Members')
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        @if ($plans->where('name', 'Standard')->first()->has_invoice_due_alert_to_parents)
                                            @lang('Invoice due alerts to parents')
                                        @else
                                            <strike>@lang('Invoice due alerts to parents')</strike>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="panel-footer">
                            <a href="{{ route('subscriptions.subscribe-to-trial', 'Standard') }}" class="btn btn-success" role="button">@lang('START YOUR FREE TRIAL')</a>
                            <p>14 @lang('Days Free')*</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4">
                    <div class="panel panel-success">
                        <div class="cnrflash">
                            <div class="cnrflash-inner">
                            <span class="cnrflash-label">@lang('MOST')
                                <br>
                                @lang('POPULAR')</span>
                            </div>
                        </div>
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                @lang('PROFESSIONAL')</h3>
                        </div>
                        <div class="panel-body">
                            <div class="the-price">
                                <h1>
                                    {{ currency(20.00, 'USD', Laravel\Cashier\Cashier::usesCurrency(), true) }}<span class="subscript">/@lang('mo')</span></h1>
                                <small>14 @lang('days FREE trial')*</small>
                            </div>
                            <table class="table">
                                <tr>
                                    <td>
                                        {{ $plans->where('name', 'Professional')->first()->number_of_children_allowed }} @lang('Children')
                                    </td>
                                </tr>
                                <tr class="active">
                                    <td>
                                        {{ $plans->where('name', 'Professional')->first()->number_of_staff_allowed }} @lang('Staff Members')
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        @if ($plans->where('name', 'Professional')->first()->has_invoice_due_alert_to_parents)
                                            @lang('Invoice due alerts to parents')
                                        @else
                                            <strike>@lang('Invoice due alerts to parents')</strike>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="panel-footer">
                            <a href="{{ route('subscriptions.subscribe-to-trial', 'Professional') }}" class="btn btn-success" role="button">@lang('START YOUR FREE TRIAL')</a>
                            <p>14 @lang('Days Free')*</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                @lang('PREMIUM')</h3>
                        </div>
                        <div class="panel-body">
                            <div class="the-price">
                                <h1>
                                    {{ currency(35.00, 'USD', Laravel\Cashier\Cashier::usesCurrency(), true) }}<span class="subscript">/@lang('mo')</span></h1>
                                <small>14 @lang('days FREE trial')*</small>
                            </div>
                            <table class="table">
                                <tr>
                                    <td>
                                        {{ $plans->where('name', 'Premium')->first()->number_of_children_allowed }} @lang('Children')
                                    </td>
                                </tr>
                                <tr class="active">
                                    <td>
                                        {{ $plans->where('name', 'Premium')->first()->number_of_staff_allowed }} @lang('Staff Members')
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        @if ($plans->where('name', 'Premium')->first()->has_invoice_due_alert_to_parents)
                                            @lang('Invoice due alerts to parents')
                                        @else
                                            <strike>@lang('Invoice due alerts to parents')</strike>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="panel-footer">
                            <a href="{{ route('subscriptions.subscribe-to-trial', 'Premium') }}" class="btn btn-success" role="button">@lang('START YOUR FREE TRIAL')</a>
                            <p>14 @lang('Days Free')*</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 text-center">
                    <p class="small">*@lang('During the free trial your account will be limited to 10 staff and children accounts and only be to generate 5 invoices.')</p>
                </div>
            </div>
        </div>
    </div>
@endsection
