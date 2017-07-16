@extends('layouts.dashboard')

@section('title') @lang('Groups')
@endsection

@section('content')
    <div class="card">
        <div class="content">
            <p><strong>Name: </strong>{{ $group->name }}</p>
            <p><strong>Description: </strong>{{ $group->name }}</p>
            <h3>@lang('Staff')</h3>
            <table class="table table-responsive table-full-width table-striped" id="table">
                <thead>
                <tr>
                    <th>@lang('Name')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($group->staff as $staff_member)
                    <tr>
                        <td>{{ $staff_member->user->name }}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            <div class="clearfix"></div>
            <h3>@lang('Children')</h3>
            <table class="table table-responsive table-full-width table-striped" id="table2">
                <thead>
                <tr>
                    <th>@lang('Name')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($group->children as $child)
                    <tr>
                        <td>{{ $child->name }}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            <div class="clearfix"></div>
        </div>
    </div>
    @include('partials.datatables',['table'=>'#table'])
    @include('partials.datatables',['table'=>'#table2'])
@stop
