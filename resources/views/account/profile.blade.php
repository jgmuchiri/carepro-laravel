@extends('layouts.dashboard')

@section('title') @lang('Edit Profile')
@endsection

@push('styles')
    <link href="/css/subscriptions.css" rel="stylesheet"/>
@endpush

@section('content')
    <div class="card">
        <div class="header">
            <div class="row">
                <div class="col-sm-6">
                    <p>@lang('Update your account information')</p>
                </div>
                <div class="col-sm-6">
                    <p><strong>@lang('Registered')</strong> {{$user->created_at}}</p>
                </div>
            </div>

        </div>
        <hr/>
        <div class="content">
            {{-- TODO: Make this form work --}}
            <p>TODO: Make form work</p>
            {!! Form::model($user,['url'=>'profile']) !!}
            <div class="row">
                <div class="col-md-8">

                    <div class="row">
                        <div class="col-md-6">
                            <label>@lang('First Name')</label>
                            {{Form::text('first_name')}}
                        </div>
                        <div class="col-md-6">
                            <label>@lang('Last Name')</label>
                            {{Form::text('last_name')}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>@lang('Email')</label>
                            {{Form::input('email','email')}}
                        </div>
                        <div class="col-md-6">
                            <label>@lang('Phone')</label>
                            {{Form::text('phone')}}
                        </div>
                    </div>
                    <div class="row">
                        {{-- TODO: Replace this address input
                        <div class="col-md-6">
                            <label>@lang('Address')</label>
                            {{Form::textarea('address',null,['rows'=>3])}}
                        </div>--}}
                        <div class="col-md-6">
                            <label>@lang('DOB')</label>
                            {{Form::input('date','dob')}}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <br/>
                    <br/>
                    <div class="callout callout-danger">
                        <label>@lang('Password'): <em>(@lang('only if changing'))</em></label><br/>
                        {!! Form::input('password','password') !!}

                        <label>@lang('Confirm Password'):</label>
                        {!! Form::input('password','password_confirmation') !!}
                    </div>
                </div>
            </div>
            <div class="text-right">
                {{Form::submit(__('Update'),['class'=>'btn btn-primary'])}}
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    @if ($user->role->name == \App\Models\Permissions\Role::TENANT_ROLE)
        <div class="card">
            <div class="header">
                <div class="row">
                    <div class="col-sm-6">
                        <p>@lang('Subscription')</p>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        @if ($user->subscribed('main'))
                            @if ($user->subscription('main')->onGracePeriod())
                                <p>@lang('billing.plan_expiring', ['plan_name' => $stripe_subscription->plan->name, 'date_diff' => $user->subscription('main')->ends_at->diffForHumans($today, true) ]).
                                    <a href="{{ route('subscriptions.resume') }}">@lang('Resume now')</a> @lang('to avoid any service interruptions').
                                </p>
                            @else
                                <p>@lang('billing.subscribed_to', ['plan_name' => $stripe_subscription->plan->name])</p>
                                {!! Form::open(['route' => 'subscriptions.cancel', 'method' => 'delete']) !!}
                                    {!! Form::submit(__('Cancel Subscription'), ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            @endif
                        @endif
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
                                    @if ($subscription->stripe_plan !== 'Standard')
                                        <a href="{{ route('subscriptions.change-plan', 'Standard') }}" class="btn btn-success" role="button">@lang('Change Plan')</a>
                                    @else
                                        <a href="{{ route('subscriptions.change-plan', 'Standard') }}" class="btn btn-default" role="button" disabled>@lang('Current Plan')</a>
                                    @endif
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
                                    @if ($subscription->stripe_plan !== 'Professional')
                                        <a href="{{ route('subscriptions.change-plan', 'Professional') }}" class="btn btn-success" role="button">@lang('Change Plan')</a>
                                    @else
                                        <a href="{{ route('subscriptions.change-plan', 'Professional') }}" class="btn btn-default" role="button" disabled>@lang('Current Plan')</a>
                                    @endif
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
                                    @if ($subscription->stripe_plan !== 'Premium')
                                        <a href="{{ route('subscriptions.change-plan', 'Premium') }}" class="btn btn-success" role="button">@lang('Change Plan')</a>
                                    @else
                                        <a href="{{ route('subscriptions.change-plan', 'Premium') }}" class="btn btn-default" role="button" disabled>@lang('Current Plan')</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="header">
                <div class="row">
                    <div class="col-sm-6">
                        <p>@lang('Payment Information')</p>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        @if (!empty($user->card_last_four))
                            <p>@lang('billing.subscribed_using_card', ['card_last_four' => $user->card_last_four])</p>
                            <p>@lang('Enter a new credit card below to update your payment method.')</p>

                            @include('partials.credit-card-form', ['route' => 'subscriptions.update-credit-card'])
                        @else
                            <p>@lang('billing.trial_subscribe_with_card')</p>

                            @include('partials.credit-card-form', ['route' => 'subscriptions.subscribe'])
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
@stop
