@extends('layouts.dashboard')

@section('title') @lang('Roles')
@endsection

@section('content')
    <div class="card">
        <div class="header">
            <div class="row">
                <div class="col-sm-6">
                    <p>{{ !empty($role->id) ? __('Edit') : __('Create')  }} @lang('Role')</p>
                </div>
            </div>
        </div>
        <hr/>
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('roles.index') }}">@lang('Back to all roles')</a>
                    {!! Form::model($role, ['route' => [$route, $role], 'method' => empty($role->id) ? 'post' : 'put']) !!}
                        {!! Form::label('name', __('Name') . ':') !!}
                        {!! Form::text('name') !!}
                        <br />
                        @foreach ($permissions as $permission)
                            <div class="form-group">
                                {!! Form::label('permissions[]', $permission->name_label) !!}
                                {!! Form::checkbox(
                                    'permissions[]',
                                    $permission->id,
                                    $role->permissions->contains('name', $permission->name_label)
                                ) !!}
                            </div>
                        @endforeach
                        {!! Form::submit(__('Save'), ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop
