@extends('layouts.dashboard')

@section('title') @lang('Parents')
@endsection

@section('content')
    @if ($user->role->permissions->contains('name', App\Models\Permissions\Permission::MANAGE_CHILDREN))
        <a href="#" class="label label-default" data-toggle="modal" data-target="#attachParent">@lang('Assign new child')</a>
    @endif
@stop

@push('modals')
    @if ($user->role->permissions->contains('name', App\Models\Permissions\Permission::MANAGE_CHILDREN))
        <div class="modal fade" id="attachParent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">@lang('Select Child')</h4>
                    </div>

                    {!! Form::open(['route' => ['parents.assign-children', $parent->id], 'method' => 'post']) !!}

                    <div class="modal-body">
                        <table class="table table-striped" id="table">
                            <thead>
                            <tr>
                                <td data-orderable="false"></td>
                                <td>@lang('Name')</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($children as $child)
                                <tr>
                                    <td style="width:20px;">
                                        <input type="checkbox" value="{{$child->id}}" name="children[]" {{ $child->parents->contains($parent) ? 'checked' : ''}}/>
                                    </td>
                                    <td><a href="#">{{$child->name}}</a></td>
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
