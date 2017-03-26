@extends('layouts.logged-out')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create Daycare</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('daycare.store') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('employee_tax_identifier') ? ' has-error' : '' }}">
                                <label for="employee_tax_identifier" class="col-md-4 control-label">Employee Tax Identifier</label>

                                <div class="col-md-6">
                                    <input id="employee_tax_identifier" type="text" class="form-control" name="employee_tax_identifier" value="{{ old('employee_tax_identifier') }}" required autofocus>

                                    @if ($errors->has('employee_tax_identifier'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('employee_tax_identifier') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            @include('partials.address-form')

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
