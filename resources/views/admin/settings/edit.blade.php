@extends('layouts.dashboard')

@section('title') @lang('Application Settings')
@endsection

@section('content')
    <div class="card">
        <div class="header">
            <div class="row">
                <div class="col-sm-6">
                    <p>@lang('Plan Settings')</p>
                </div>
            </div>
        </div>
        <hr/>
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    @foreach ($plans as $plan)
                        <p><strong>{{ $plan->name }}</strong></p>
                        {!! Form::model($plan, ['route' => ['admin.settings.update', $plan->id]]) !!}
                            {!! Form::label('number_of_children_allowed', __('Number of children allowed') .': ') !!}
                            {!! Form::text('number_of_children_allowed') !!}
                            {!! Form::label('number_of_staff_allowed', __('Number of staff allowed') . ': ') !!}
                            {!! Form::text('number_of_staff_allowed') !!}
                            {!! Form::label('has_invoice_due_alerts_to_parents', __('Has invoice due alerts to parents') . ': ') !!}
                            {!! Form::checkbox('has_invoice_due_alert_to_parents') !!}
                            <br />
                            {!! Form::submit(__('Save'), ['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop
