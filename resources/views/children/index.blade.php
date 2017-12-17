@extends('layouts.dashboard')

@section('title') @lang('Children')
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-heading">
       <!-- START Language list-->
       <div class="pull-right">
          <div class="btn-group">
             <button class="btn btn-primary waves-effect m-b-5" data-toggle="modal" data-target="#newChild" data-backdrop="false"> <i class="fa fa-plus m-r-5 btn-fa"></i> <span> @lang('Register Child')</span></button>
          </div>
       </div>
       <!-- END Language list-->Children
       <small data-localize="dashboard.WELCOME"></small>
    </div>
    <!-- END widgets box-->
    <div class="row">
       <!-- START dashboard main content-->
       @foreach($children as $child)
       <div class="col-lg-4">
             <!-- START widget-->
          <div class="panel panel-primary" id="panelDemo8">
             <div class="panel-heading pnl-child-hd"><a href="{{ route('children.show', $child->id) }}">{{ $child->name }}</a></div>
             <div class="panel-body">
                <div class="row row-table">
                   <div class="col-xs-6 text-center">
                        @if($child->photo =="")
                            <img src="{{asset('/img/portrait.png')}}" alt="@lang('User Image')"
                                 class=""/>
                        @else
                            <img class="" src="{{ asset('storage/' . $child->photo) }}" alt="@lang('User Image')">
                        @endif
                   </div>
                   <div class="col-xs-6">
                      <h3 class="mt0">{{ $child->dob }}</h3>
                      <h3 class="mt0">{{ $child->ssn }}</h3>
                      @if($child->status=='Pending Approval')
                        <h3 class="mt0 text-warning">{{$child->status->name_label}}</h3>
                      @elseif($child->status =='Inactive')
                        <h3 class="mt0 text-danger">{{$child->status->name_label}}</h3>
                      @else
                        <h3 class="mt0 text-success">{{$child->status->name_label}}</h3>
                      @endif
                   </div>
                </div>
             </div>
             <div class="panel-footer">
                <div class="row row-table text-center">
                   <div class="col-xs-6">
                      <a class="mb-sm btn btn-success btn-quick" href="{{ route('children.show', $child->id) }}" >View</a>
                   </div>
                   @if ($child->is_active)
                        @can('updateStatus', $child)
                            @if($child->status->name =='Active')
                                <div class="col-xs-6">
                                  <a class="mb-sm btn btn-primary btn-quick" href="{{ route('children.deactivate', $child->id) }}">Check-out</a>
                                </div>
                            @else
                                <div class="col-xs-6">
                                  <a class="mb-sm btn btn-success btn-quick" href="{{ route('children.deactivate', $child->id) }}">Check-in</a>
                                </div>
                            @endif
                        @endcan
                    @endif
                </div>
             </div>
          </div>
          <!-- END widget-->
       </div>
       @endforeach
    </div>
 </div>
@stop

@push('modals')
    @if (count($parents))
        @include('children.register-modal')
    @endif
@endpush
