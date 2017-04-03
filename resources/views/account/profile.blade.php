@extends('layouts.dashboard')

@section('title') Edit profile
@endsection

@section('content')
    <div class="card">
        <div class="header">
            <div class="row">
                <div class="col-sm-6">
                    <p>Update your account information</p>
                </div>
                <div class="col-sm-6">
                    <p><strong>Registered:</strong> {{$user->created_at}}</p>
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
                            <label>First name</label>
                            {{Form::text('first_name')}}
                        </div>
                        <div class="col-md-6">
                            <label>Last name</label>
                            {{Form::text('last_name')}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Email</label>
                            {{Form::input('email','email')}}
                        </div>
                        <div class="col-md-6">
                            <label>Phone</label>
                            {{Form::text('phone')}}
                        </div>
                    </div>
                    <div class="row">
                        {{-- TODO: Replace this address input
                        <div class="col-md-6">
                            <label>Address</label>
                            {{Form::textarea('address',null,['rows'=>3])}}
                        </div>--}}
                        <div class="col-md-6">
                            <label>DOB</label>
                            {{Form::input('date','dob')}}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <br/>
                    <br/>
                    <div class="callout callout-danger">
                        <label>Password: <em>(only if changing)</em></label><br/>
                        {!! Form::input('password','password') !!}

                        <label>Confirm Password:</label>
                        {!! Form::input('password','password_confirmation') !!}
                    </div>
                </div>
            </div>
            <div class="text-right">
                {{Form::submit('Update',['class'=>'btn btn-primary'])}}
            </div>
            {!! Form::close() !!}
        </div>
    </div>

    <div class="card">
        <div class="header">
            <div class="row">
                <div class="col-sm-6">
                    <p>Subscription</p>
                </div>
            </div>
        </div>
        <hr/>
        <div class="content">

            <div class="row">
                <div class="col-md-12">
                    @if ($user->subscribed('main'))
                        @if ($user->subscription('main')->onGracePeriod())
                            <p>Your subscription to the {{ $stripe_subscription->plan->name }} plan will expire in
                                {{ $user->subscription('main')->ends_at->diffForHumans($today, true) }}.
                                <a href="{{ route('subscriptions.resume') }}">Resume now</a> to avoid any service interruptions.
                            </p>
                        @else
                            <p>You are currently subscribed to the {{ $stripe_subscription->plan->name }} plan.</p>
                            {!! Form::open(['route' => 'subscriptions.cancel', 'method' => 'delete']) !!}
                                {!! Form::submit('Cancel Subscription', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
