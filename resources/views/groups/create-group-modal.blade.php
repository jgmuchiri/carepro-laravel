<div class="modal fade" id="createGroup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">@lang('New Group')</h4>
            </div>
            {!! Form::open(['route' => 'groups.non-api-store', 'method' => 'post', 'id' => 'create-group-form']) !!}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <label>@lang('Name')</label>
                            {!! Form::text('name',null,['required'=>'']) !!}
                        </div>
                        <div class="col-sm-6">
                            <label>@lang('Description')</label>
                            {!! Form::textarea('description',null, ['rows' => '4', 'cols' => '30']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <label>@lang('All Staff')</label>
                            <label>@lang('Search')</label>
                            <input type="text" id="staff-search"/>
                            <ul id="all-staff" class="staffSortable" style="background:#DDDDDD; min-height: 50px;">
                                @foreach ($staff as $staff_member)
                                    <li class="ui-state-default" id="staff-{{$staff_member->id}}" data-name="{{ $staff_member->user->name }}">{{ $staff_member->user->name }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="col-sm-5 col-sm-offset-1">
                            <label>@lang('Assigned Staff')</label>
                            <ul id="assigned-staff" class="staffSortable" style="background:#DDDDDD; min-height: 50px;">
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <label>@lang('All Children')</label>
                            <label>@lang('Search')</label>
                            <input type="text" id="children-search"/>
                            <ul id="all-children" class="childrenSortable" style="background:#DDDDDD; min-height: 50px;">
                                @foreach ($children as $child)
                                    <li class="ui-state-default" id="child-{{$child->id}}" data-name="{{ $child->name }}">{{ $child->name }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="col-sm-5 col-sm-offset-1">
                            <label>@lang('Assigned Children')</label>
                            <ul id="assigned-children" class="childrenSortable" style="background:#DDDDDD; min-height: 50px;">
                            </ul>
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

@push('scripts')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function() {
        $("#all-staff, #assigned-staff").sortable({
            connectWith: ".staffSortable"
        }).disableSelection();

        $("#all-children, #assigned-children").sortable({
            connectWith: ".childrenSortable"
        }).disableSelection();

        $('#create-group-form').submit(function(event) {
            $("#assigned-staff li").each(function(key, value) {
                var staff_id = $(value).attr('id').replace('staff-', '');
                $('#create-group-form').append('<input type="hidden" name="staff[]" value="' + staff_id + '"/>');
            });

            $("#assigned-children li").each(function(key, value) {
                var child_id = $(value).attr('id').replace('child-', '');
                $('#create-group-form').append('<input type="hidden" name="children[]" value="' + child_id + '"/>');
            });

            return true;
        });

        $('#staff-search').bind("propertychange change click keyup input paste", function(event) {
            if ($(this).val() == "") {
                $("#all-staff li").each(function (key, value) {
                    $(value).show();
                });
            } else {
                $("#all-staff li").each(function (key, value) {
                    if ($(value).data('name').toLowerCase().indexOf($('#staff-search').val().toLowerCase()) == -1) {
                        $(value).hide();
                    }
                });
            }
        });

        $('#children-search').bind("propertychange change click keyup input paste", function(event) {
            if ($(this).val() == "") {
                $("#all-children li").each(function (key, value) {
                    $(value).show();
                });
            } else {
                $("#all-children li").each(function (key, value) {
                    if ($(value).data('name').toLowerCase().indexOf($('#children-search').val().toLowerCase()) == -1) {
                        $(value).hide();
                    }
                });
            }
        });
    });
</script>
@endpush
