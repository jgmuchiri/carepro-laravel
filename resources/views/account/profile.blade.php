@extends('layouts.dashboard')

@section('title') @lang('Edit Profile')
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-heading">
       <!-- START Language list-->
       <!-- END Language list-->Profile
       <small></small>
    </div>
    <!-- END widgets box-->
    <div class="panel panel-default" id="panelDemo1">
        <div class="panel-heading">@lang('Update your account information')
           <p class="pull-right"><strong>@lang('Registered')</strong> {{$user->created_at}}</p>
        </div>
        <div class="panel-wrapper">
           <div class="panel-body">
              <form method="POST" action="http://127.0.0.1:8080/profile" accept-charset="UTF-8">     
                <div class="row">
                    <div class="col-md-8">

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>First Name</label>
                                <input name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input name="email" type="email" value="{{ old('email', $user->email) }}" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Phone</label>
                                <input name="phone" type="text" class="form-control" value="{{ old('phone', $user->address->phone) }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>DOB</label>
                                <input name="dob" type="date" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="">
                            <div class="form-group">
                                <label>Password: <em>(only if changing)</em></label><br/>
                                <input name="password" type="password" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Confirm Password:</label>
                                <input name="password_confirmation" type="password" class="form-control">
                            </div>

                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <input class="btn btn-primary" type="submit" value="Update">
                </div>
            </form>
           </div>
        </div>
    </div>
    <div class="panel panel-default" >
        <div class="panel-heading">@lang('Subscription')
        </div>
        <div class="panel-wrapper ">
           <div class="panel-body">
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
                    <div class="text-center">
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
                                    @if ($current_plan_name !== 'Standard')
                                        <a href="{{ route('subscriptions.change-plan', 'Standard') }}" class="btn btn-success" role="button">@lang('Change Plan')</a>
                                    @else
                                        <a href="{{ route('subscriptions.change-plan', 'Standard') }}" class="btn btn-default" role="button" disabled>@lang('Current Plan')</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="panel panel-success">
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
                                    @if ($current_plan_name !== 'Professional')
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
                                    @if ($current_plan_name !== 'Premium')
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
    </div>
   </div>

    <div class="panel panel-default">
        <div class="panel-heading">@lang('Payment Information')
        </div>
        <div class="panel-wrapper collapse in">
           <div class="panel-body">
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
    </div>

 </div>
@stop
