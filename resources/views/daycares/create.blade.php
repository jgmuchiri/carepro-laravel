@extends('layouts.logged-out')

@section('content')
<div class="wrapper">
    <div class="pricing-4 section ">
        <div class="container">
            <div class="row">
                <div class="col-md-6 ml-auto mr-auto text-center">
                    <h2 class="title">@lang('Create Daycare')</h2>
                </div>
            </div>
            <div class="space-top"></div>
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form method="POST" action="{{ route('daycare.store') }}" accept-charset="UTF-8" role="form">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-6">
                               <div class="form-group">
                                    <label for="name" class="control-label">Name *</label>
                                    <input id="name" class="form-control" required="" autofocus="" name="name" type="text" value="{{ old('name') }}">
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div> 
                            </div>
                            <div class="col-sm-6">
                               <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label for="employee_tax_identifier" class="control-label">Employee Tax Identifier *</label>
                                    <input id="employee_tax_identifier" class="form-control" required="" name="employee_tax_identifier" type="text" value="{{ old('employee_tax_identifier') }}">
                                    @if ($errors->has('employee_tax_identifier'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('employee_tax_identifier') }}</strong>
                                        </span>
                                    @endif
                                </div> 
                            </div>
                        </div>

                        @include('partials.address-form')
                        
                        <div class="form-group text-center">
                            <div class="12">
                                <input class="btn btn-primary" type="submit" value="Register">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
