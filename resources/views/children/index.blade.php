@extends('layouts.dashboard')

@section('title') @lang('Children')
@endsection

@section('content')
    <div class="card">
        <div class="header">
            <button class="btn btn-primary" data-toggle="modal" data-target="#newChild" {{ !count($parents) ? 'disabled' : '' }}>
                <i class="fa fa-plus-circle"></i>
                @lang('Register Child')
            </button>
            @if (!count($parents))
                <p>@lang('A child can not be registered without a parent. Please register parent(s) first before registering your first child.')</p>
            @endif
        </div>
        <hr/>
        <div class="content">
            <table class="table table-responsive table-full-width table-striped" id="table">
                <thead>
                <tr>
                    <th data-orderable="false"></th>
                    <th>@lang('Name')</th>
                    <th>@lang('DOB')</th>
                    <th>@lang('SSN/ID')</th>
                    <th>@lang('Status')</th>
                    <th data-orderable="false"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($children as $child)
                    <tr>
                        <td>
                            @if($child->photo =="")
                                <img style="width:72px;height:72px" src="{{asset('/img/portrait.png')}}" alt="@lang('User Image')"
                                     class=""/>
                            @else
                                <img src="{{asset('storage/' . $child->photo)}}" class=""
                                     style="width:72px;height:72px"
                                     alt="@lang('User Image')"/>
                            @endif
                        </td>
                        <td><a href="{{ route('children.show', $child->id) }}">{{$child->name}}</a></td>
                        <td>{{$child->dob}}</td>
                        <td>{{$child->ssn}}</td>
                        <td>
                            @if($child->status=='Pending Approval')
                                <span class="label label-warning">{{$child->status->name_label}}</span>
                            @elseif($child->status =='Inactive')
                                <span class="label label-danger">{{$child->status->name_label}}</span>
                            @else
                                <span class="label label-info">{{$child->status->name_label}}</span>
                            @endif
                        </td>
                        <td>
                            @if ($child->is_active)
                                @can('updateStatus', $child)
                                    @if($child->status->name =='Active')
                                        <a class="btn btn-danger btn-xs delete" href="{{ route('children.deactivate', $child->id) }}"><i class="fa fa-times-circle-o"></i>@lang('deactivate')</a>
                                    @else
                                        <a class="btn btn-info btn-xs delete" href="{{ route('children.activate', $child->id) }}"><i class="fa fa-times-circle-o"></i>@lang('activate')</a>
                                    @endif
                                @endcan
                            @endif
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            <div class="clearfix"></div>
        </div>
    </div>
@stop

@push('modals')
    @if (count($parents))
        @include('children.register-modal')
    @endif
@endpush
