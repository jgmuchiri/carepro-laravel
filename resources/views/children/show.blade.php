@extends('layouts.dashboard')

@section('title') @lang('Children')
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-heading" style="padding-bottom: 6px;">
       <!-- START Language list-->
       <div class="pull-right">
          <div class="btn-group">
             @if ($child->is_active)
                @can('updateStatus', $child)
                    @if($child->status->name =='Active')
                          <a class="mb-sm btn btn-primary btn-quick" href="{{ route('children.deactivate', $child->id) }}">Check-out</a>
                    @else
                          <a class="mb-sm btn btn-success btn-quick" href="{{ route('children.deactivate', $child->id) }}">Check-in</a>
                    @endif
                @endcan
            @endif
          </div>
       </div>
       <div class="row">
            <div class="col-md-4">
              {{ $child->name }} <small class="td-text-success" style="font-size: 12px;">{{ $child->status->name_label }}</small>
            </div>
            <div class="col-md-3">
              {{ $child->dob }}
            </div>
            <div class="col-md-3">
              xxx-xx-{{substr($child->ssn, -4) }}
            </div>
          </div>
    </div>
    <!-- END widgets box-->
    <div class="panel panel-default" id="panelDemo1">
        <div class="panel-wrapper collapse in">
           <div class="panel-body">
                <div class="card card-transparent flex-row">
                    <ul class="nav nav-tabs nav-tabs-simple nav-tabs-left" id="tab-3">
                        <li style="padding-bottom: 15px;">
                            @if($child->photo =="")
                            <img src="{{asset('/img/portrait.png')}}" alt="@lang('User Image')"
                                 class="center-block img-responsive img-thumbnail"/>
                            @else
                                <img class="center-block img-responsive img-thumbnail" src="{{ asset('storage/' . $child->photo) }}" alt="@lang('User Image')">
                            @endif
                        </li>
                        <li class="nav-item active">
                            <a href="#" data-toggle="tab" data-target="#home">
                                <i class="fa fa-home"></i> Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" data-toggle="tab" data-target="#photo">
                                <i class="fa fa-photo"></i> Photos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" data-toggle="tab" data-target="#notes">
                                <i class="fa fa-file-text"></i> Notes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" data-toggle="tab" data-target="#billing">
                                <i class="fa fa-money"></i> Billing
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" data-toggle="tab" data-target="#health">
                                <i class="fa fa-medkit"></i> Health
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" data-toggle="tab" data-target="#attendance">
                                <i class="fa fa-calendar"></i> Attendance
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="home">
                            @include('children.includes.home')
                        </div>
                        <div class="tab-pane" id="photo">
                            @include('children.includes.photo')
                        </div>
                        <div class="tab-pane" id="notes">
                            @include('children.includes.notes')
                        </div>
                        <div class="tab-pane" id="billing">
                            @include('children.includes.billing')
                        </div>
                        <div class="tab-pane" id="attendance">
                            @include('children.includes.attendance')
                        </div>
                        <div class="tab-pane" id="health">
                            @include('children.includes.health')
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </div>


    <!-- end row -->
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
                                        <div class="checkbox c-checkbox">
                                        <label>
                                            <input type="checkbox" value="{{$parent->id}}" name="parents[]" {{ $child->parents->contains($parent) ? 'checked' : ''}}/>                                            
                                            <span class="fa fa-check"></span>
                                        </label>
                                    </div>
                                    </td>
                                    <td>{{$parent->user->name}}</td>
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
    <div class="modal fade" id="attachGroup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">@lang('Assign Groups')</h4>
                </div>

                {!! Form::open(['route' => ['children.assign-groups', $child->id], 'method' => 'post']) !!}

                <div class="modal-body">
                    <table class="table table-striped" id="table">
                        <thead>
                        <tr>
                            <td data-orderable="false"></td>
                            <td>@lang('Name')</td>
                            <td>@lang('Description')</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($groups as $group)
                            <tr>
                                <td style="width:20px;">
                                    <div class="checkbox c-checkbox">
                                        <label>
                                            <input type="checkbox" value="{{$group->id}}" name="groups[]" {{ $child->groups->contains($group) ? 'checked' : ''}}/>                                            
                                            <span class="fa fa-check"></span>
                                        </label>
                                    </div>
                                </td>
                                <td>{{ $group->name }}</td>
                                <td>{{ $group->short_description }}</td>
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
@endpush

@push('scripts')
    <script type="text/javascript">

    $(document).on('click', '#upload_link', function(e) {
        e.preventDefault();
        $("#upload:hidden").trigger('click');
    });

    $("#upload").change(function () {
        var file = $('#upload').val();
        var filename = file.slice(-12);
        if (filename !== null) {
            if ($('.filename').val() !== null) {
                $($('.filename')).empty();
            }
            $('<span>' + filename + '</span>').appendTo('.filename');
        }
    });
    </script>
@endpush


