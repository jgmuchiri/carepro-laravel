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
                        <div class="col-sm-6">
                            <label>@lang('Name')</label>
                            {!! Form::text('name',null,['required'=>'']) !!}
                        </div>
                        <div class="col-sm-6">
                            <label>@lang('Nickname')</label>
                            {!! Form::text('nickname',null) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label>@lang('Birthday')</label>
                            {!! Form::date('dob',null,['required'=>'']) !!}
                        </div>
                        <div class="col-sm-6">
                            <label>@lang('SSN/ID') #</label>
                            {!! Form::text('ssn',null,['required'=>'']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label>@lang('Gender')</label>
                            {!! Form::select('gender', $genders->pluck('name_label', 'id'), null, ['required' => '']) !!}
                        </div>
                        <div class="col-sm-6">
                            <label>@lang('Blood Group')</label>
                            {!! Form::select(
                                'blood_type',
                                $blood_types->pluck('blood_type_label', 'id'),
                                null,
                                ['required' => '']
                            ) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label>@lang('Access Pin')</label>
                            {!! Form::text('pin',rand(1111,9999),['required'=>'']) !!}
                        </div>
                        @if(count($parents))
                            <div class="col-sm-6">
                                <label>@lang('Status')</label>
                                {!! Form::select(
                                    'status',
                                    $statuses->pluck('name_label', 'id'),
                                    null,
                                    ['required' => '']
                                ) !!}
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label>@lang('Religion')</label>
                            {!! Form::select(
                                'religion',
                                $religions->pluck('name_label', 'id'),
                                null,
                                ['required'=>'']
                            ) !!}
                        </div>
                        <div class="col-sm-6">
                            <label>@lang('Ethnicity')</label>
                            {!! Form::select(
                                'ethnicity',
                                $ethnicities->pluck('name_label', 'id'),
                                null,
                                ['required' => '']
                            ) !!}
                        </div>
                    </div>
                    @if (count($parents))
                        <div class="row">
                            <div class="col-sm-6">
                                <label>@lang('Parents')</label>
                                {!! Form::select(
                                    'parents[]',
                                    $parents->pluck('user.name', 'id'),
                                    null,
                                    ['required'=>'', 'multiple' => '']
                                ) !!}
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-sm-6">
                            <label>@lang('Photo')</label>
                            {!! Form::file('photo_uri') !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> @lang('Cancel')
                    </button>
                    <button class="btn btn-primary"><i class="fa fa-save"></i> @lang('Save changes')</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
