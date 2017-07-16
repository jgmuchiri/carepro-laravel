@extends('layouts.dashboard')

@section('title') @lang('Parents')
@endsection

@section('content')
    <div class="card">
        <div class="header">
            <div class="row">
                <div class="col-sm-6">
                    <p>@lang('Parents')</p>
                </div>
            </div>
        </div>
        <hr/>
        <div class="content">
            @can('create', \App\Models\ChildParent::class)
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('parents.create') }}" class="btn btn-primary">@lang('New Parent')</a>
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
                            @forelse ($parents as $parent)
                                <tr>
                                    <td>{{ $parent->user->name }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="3">@lang('No parents created yet').</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
