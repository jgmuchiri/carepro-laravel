@extends('layouts.dashboard')

@section('title') @lang('Children')
@endsection

@section('content')
    @if ($user->role->permissions->contains('name', App\Models\Permissions\Permission::MANAGE_CHILDREN))
        <a href="#" class="label label-default" data-toggle="modal" data-target="#attachParent">@lang('Assign new parent')</a>
    @endif

    <div class="content">
        <h3>@lang('Groups')</h3>
        <table class="table table-responsive table-full-width table-striped" id="table">
            <thead>
            <tr>
                <th>@lang('Name')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($child->groups as $group)
                <tr>
                    <td>{{ $group->name }}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <div class="clearfix"></div>

        <h3>@lang('Assign Groups')</h3>
        {!! Form::open(['route' => ['children.assign-groups', $child->id], 'method' => 'post']) !!}
            @foreach($groups as $group)
                <label>{{ $group->name }}
                        <input type="checkbox" value="{{$group->id}}" name="groups[]" {{ $child->groups->contains($group) ? 'checked' : ''}}/>
                </label><br />
            @endforeach
            <input type="submit" class="btn btn-primary" value="@lang('Assign')"/>
        {!! Form::close() !!}
    </div>
@stop

@push('modals')
    @if ($user->role->permissions->contains('name', App\Models\Permissions\Permission::MANAGE_CHILDREN))
        <div class="modal fade" id="attachParent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">@lang('Select Parent')</h4>
                    </div>

                    {!! Form::open(['route' => ['children.assign-parents', $child->id], 'method' => 'post']) !!}

                    <div class="modal-body">
                        <table class="table table-striped" id="table">
                            <thead>
                            <tr>
                                <td data-orderable="false"></td>
                                <td>@lang('Name')</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($parents as $parent)
                                <tr>
                                    <td style="width:20px;">
                                        <input type="checkbox" value="{{$parent->id}}" name="parents[]" {{ $child->parents->contains($parent) ? 'checked' : ''}}/>
                                    </td>
                                    <td><a href="#">{{$parent->user->name}}</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('Close')</button>
                        <input type="submit" class="btn btn-primary" value="@lang('Assign')"/>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    @endif
@endpush
