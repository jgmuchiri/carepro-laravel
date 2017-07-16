@extends('layouts.dashboard')

@section('title') @lang('Staff Members')
@endsection

@section('content')
    <div class="card">
        <div class="header">
            <div class="row">
                <div class="col-sm-6">
                    <p>@lang('Staff Members')</p>
                </div>
            </div>
        </div>
        <hr/>
        <div class="content">
            @can('create', \App\Models\Staff::class)
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('staff.create') }}" class="btn btn-primary">@lang('New Staff Member')</a>
                    </div>
                </div>
            @endcan
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>@lang('Name')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($staff as $staff_member)
                                <tr>
                                    <td>{{ $staff_member->user->name }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="3">@lang('No staff created yet').</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
