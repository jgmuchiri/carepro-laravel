@extends('layouts.dashboard')

@section('title') @lang('Groups')
@endsection

@section('content')
    <div class="card">
        <div class="header">
            <button class="btn btn-primary" data-toggle="modal" data-target="#createGroup"><i
                        class="fa fa-plus-circle"></i>
                @lang('Create Group')
            </button>
        </div>
        <hr/>
        <div class="content">
            <table class="table table-responsive table-full-width table-striped" id="table">
                <thead>
                <tr>
                    <th>@lang('Name')</th>
                    <th>@lang('Description')</th>
                    <th>@lang('# of Children')</th>
                    <th>@lang('# of Staff')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($groups as $group)
                    <tr>
                        <td><a href="{{ route('groups.show', $group->id) }}">{{$group->name}}</a></td>
                        <td>{{$group->short_description}}</td>
                        <td>{{$group->staff->count()}}</td>
                        <td>{{$group->children->count()}}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            <div class="clearfix"></div>
        </div>
    </div>
    @include('partials.datatables',['table'=>'#table'])
@stop

@push('modals')
    @include('groups.create-group-modal')
@endpush
