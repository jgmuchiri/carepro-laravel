@extends('layouts.dashboard')

@section('title') Roles
@endsection

@section('content')
    <div class="card">
        <div class="header">
            <div class="row">
                <div class="col-sm-6">
                    <p>Roles</p>
                </div>
            </div>
        </div>
        <hr/>
        <div class="content">
            @can('create', \App\Models\Permissions\Role::class)
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('roles.create') }}" class="btn btn-primary">New Role</a>
                    </div>
                </div>
            @endcan
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th colspan="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $role)
                                <tr>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        @can('update', $role)<a href="{{ route('roles.edit', $role->id) }}">Edit</a>@endcan
                                        @can('delete', $role)
                                            {!! Form::open(['route' => ['roles.destroy', $role->id], 'method' => 'delete']) !!}
                                                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                                            {!! Form::close() !!}
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="3">No roles created yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
