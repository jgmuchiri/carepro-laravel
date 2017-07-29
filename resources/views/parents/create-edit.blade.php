@extends('layouts.dashboard')

@section('title') @lang('Parents')
@endsection

@section('content')
    <div class="card">
        <div class="header">
            <div class="row">
                <div class="col-sm-6">
                    <p>{{ !empty($role->id) ? __('Edit') : __('Create')  }} @lang('Parent')</p>
                </div>
            </div>
        </div>
        <hr/>
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('parents.index') }}">@lang('Back to all parents')</a>
                    {!! Form::model($parent, ['route' => [$route, $parent], 'method' => empty($parent->id) ? 'post' : 'put', 'files' => true]) !!}
                        <div class="row{{ $errors->has('name') ? ' has-error' : '' }}">
                            {!! Form::label('name', __('Name'), ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                {!! Form::text('name', null, ['id' => 'name', 'class' => 'form-control', 'required' => '', 'autofocus' => '']) !!}

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row{{ $errors->has('email') ? ' has-error' : '' }}">
                            {!! Form::label('email', __('E-Mail Address'), ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                {!! Form::email('email', null, ['id' => 'email', 'class' => 'form-control', 'required' => '']) !!}

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row{{ $errors->has('password') ? ' has-error' : '' }}">
                            {!! Form::label('password', __('Password'), ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                {!! Form::password('password', ['class' => 'form-control', 'id' => 'password', 'required' => '']) !!}

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            {!! Form::label('password-confim', __('Confirm Password'), ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                {!! Form::password('password_confirmation', ['id' => 'password-confirm', 'class' => 'form-control', 'required' => '']) !!}
                            </div>
                        </div>

                        <div class="row{{ $errors->has('photo_uri') ? ' has-error' : '' }}">
                            {!! Form::label('photo_uri', __('Photo'), ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                {!! Form::file('photo_uri') !!}

                                @if ($errors->has('photo_uri'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('photo_uri') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row{{ $errors->has('dob') ? ' has-error' : '' }}">
                            {!! Form::label('dob', __('DOB'), ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                {!! Form::date('dob', null, ['id' => 'dob', 'class' => 'form-control', 'required' => '']) !!}

                                @if ($errors->has('dob'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row{{ $errors->has('pin') ? ' has-error' : '' }}">
                            {!! Form::label('pin', __('PIN'), ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                {!! Form::text('pin', null, ['id' => 'pin', 'class' => 'form-control', 'required' => '']) !!}

                                @if ($errors->has('pin'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pin') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row{{ $errors->has('is_primary') ? ' has-error' : '' }}">
                            {!! Form::label('is_primary', __('Is Primary Parent?'), ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                {!! Form::checkbox('is_primary', null, null, ['id' => 'is_primary', 'class' => 'form-control']) !!}

                                @if ($errors->has('is_primary'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('is_primary') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            @include('partials.address-form')
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::submit(__('Save'), ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop
