@extends('layouts.logged-out')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create Daycare</div>
                    <div class="panel-body">
                        {!! Form::open(['route' => 'daycare.store', 'method' => 'post', 'role' => 'form', 'class' => 'form-horizontal']) !!}
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                {!! Form::label('name', 'Name', ['class' => 'col-md-4 control-label']) !!}

                                <div class="col-md-6">
                                    {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control', 'required' => '', 'autofocus' => ''] !!}

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('employee_tax_identifier') ? ' has-error' : '' }}">
                                {!! Form::label('employee_tax_identifier', 'Employee Tax Identifier', ['class' => 'col-md-4 control-label']) !!}

                                <div class="col-md-6">
                                    {!! Form::text('employee_tax_identifier', null, ['id' => 'employee_tax_identifier', 'class' => 'form-control', 'required' => '']) !!}

                                    @if ($errors->has('employee_tax_identifier'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('employee_tax_identifier') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            @include('partials.address-form')

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
