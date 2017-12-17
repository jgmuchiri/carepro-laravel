<div class="modal fade" id="newChild" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">@lang('New Child Registration')</h4>
            </div>
            {!! Form::open(['route' => 'children.store', 'method' => 'post', 'files' => true]) !!}
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>@lang('Name')*</label>
                            {!! Form::text('name',null,['required'=>'', 'class' => 'form-control']) !!}
                        </div>
                        <div class="form-group col-sm-6">
                            <label>@lang('Nickname')</label>
                            {!! Form::text('nickname',null,['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>@lang('Birthday')*</label>
                            {!! Form::date('dob',null,['required'=>'', 'class' => 'form-control']) !!}
                        </div>
                        <div class="form-group col-sm-6">
                            <label>@lang('SSN/ID') #*</label>
                            {!! Form::text('ssn',null,['required'=>'', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>@lang('Gender')*</label>
                            {!! Form::select('gender', $genders->pluck('name_label', 'id'), null, ['required' => '', 'class' => 'form-control']) !!}
                        </div>
                        <div class="form-group col-sm-6">
                            <label>@lang('Blood Group')*</label>
                            {!! Form::select(
                                'blood_type',
                                $blood_types->pluck('blood_type_label', 'id'),
                                null,
                                ['required' => '', 'class' => 'form-control']
                            ) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>@lang('Access Pin')*</label>
                            {!! Form::text('pin',rand(1111,9999),['required'=>'', 'class' => 'form-control']) !!}
                        </div>
                        @if(count($parents))
                            <div class="form-group col-sm-6">
                                <label>@lang('Status')*</label>
                                {!! Form::select(
                                    'status',
                                    $statuses->pluck('name_label', 'id'),
                                    null,
                                    ['required' => '', 'class' => 'form-control']
                                ) !!}
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>@lang('Religion')*</label>
                            {!! Form::select(
                                'religion',
                                $religions->pluck('name_label', 'id'),
                                null,
                                ['required'=>'', 'class' => 'form-control']
                            ) !!}
                        </div>
                        <div class="form-group col-sm-6">
                            <label>@lang('Ethnicity')*</label>
                            {!! Form::select(
                                'ethnicity',
                                $ethnicities->pluck('name_label', 'id'),
                                null,
                                ['required' => '', 'class' => 'form-control']
                            ) !!}
                        </div>
                    </div>
                    @if (count($parents))
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label>@lang('Parents')*</label>
                                {!! Form::select(
                                    'parents[]',
                                    $parents->pluck('user.name', 'id'),
                                    null,
                                    ['required'=>'', 'multiple' => '', 'class' => 'form-control']
                                ) !!}
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label>@lang('Photo')*</label>
                            {!! Form::file('photo_uri', ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-center">
                    <button class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times btn-fa"></i> @lang('Cancel')
                    </button>
                    <button class="btn btn-primary"><i class="fa fa-save btn-fa"></i> @lang('Save changes')</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
