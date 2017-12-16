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
              {{ $child->ssn }}
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
                    <div class="tab-content ">
                        <div class="tab-pane " id="home">
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
                        <div class="tab-pane active" id="health">
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


