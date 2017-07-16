@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            @can('create', \App\Models\ChildParent::class)
                <a href="{{ route('parents.create') }}" class="btn btn-primary">@lang('New Parent')</a>
            @endcan
            @can('create', \App\Models\Child::class)
                <a href="{{ route('children.index') }}" class="btn btn-primary">@lang('Add Child')</a>
            @endcan
            @can('create', \App\Models\Groups\Group::class)
                <button class="btn btn-primary" data-toggle="modal" data-target="#createGroup"><i
                            class="fa fa-plus-circle"></i>
                    @lang('Create Group')
                </button>
            @endcan
            @can('edit', \App\Models\Staff::class)
                <li class="{{ $route_name == 'staff.index' ? "active  bg-warning": ""}}">
                    <a href="{{ route('staff.index') }}">
                        <i class="fa fa-users"></i>
                        <p>@lang('Staff Members')</p>
                    </a>
                </li>
            @endcan
        </div>
    </div>

    @if (count($children_to_activate))
        @can('updateStatus', $children_to_activate->first())
        <div class="row">
            <div class="col-md-8">
                <div class="alert alert-warning" role="alert">
                    @lang('Parent registered a child'). <a href="{{ route('children.index') }}">@lang('Activate Child')</a>
                </div>
            </div>
        </div>
        @endcan
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('Dashboard')</div>

                <div class="panel-body">
                    @lang('You are logged in!')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('modals')
    @include('groups.create-group-modal')
@endpush
