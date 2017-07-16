@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('Subscribe')</div>
                <div class="panel-body">
                    @include('partials.credit-card-form', ['route' => 'subscriptions.subscribe'])
                </div>
            </div>
        </div>
    </div>
@stop
