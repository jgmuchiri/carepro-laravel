<template>
    <div>
        <div id="billing-index">
            <div class="content-heading">
                <!-- START Language list-->
                <div class="pull-right">
                    <div class="btn-group">
                        <button class="btn btn-success waves-effect m-b-5"
                                id="btn-invoice">
                            <i class="fa fa-plus m-r-5 btn-fa"></i>
                            <span>{{ $t('New Invoice') }}</span>
                        </button>
                    </div>
                </div>
                <h3 style="margin-top: 0px;">{{ $t('Billing') }}</h3>
            </div>
            <hr>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="input-group">
                                <input class="input-sm form-control" type="text" :placeholder="$t('Search')">
                                <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" type="button">{{ $t('Search') }}</button>
                     </span>
                            </div>
                        </div>
                        <div class="col-lg-5"></div>
                        <div class="col-lg-3">
                            <div class="input-group pull-right">
                                <select class="input-sm form-control">
                                    <option value="0">{{ $t('Bulk action') }}</option>
                                    <option value="1">{{ $t('Email') }}</option>
                                    <option value="2">{{ $t('Download') }}</option>
                                    <option value="3">{{ $t('Pay') }}</option>
                                    <option value="3">{{ $t('Delete') }}</option>
                                </select>
                                <span class="input-group-btn">
                        <button class="btn btn-sm btn-default">{{ $t('Apply') }}</button>
                     </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- START table-responsive-->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" >
                        <thead>
                            <tr>
                                <th data-check-all width="3">
                                    <div class="checkbox c-checkbox" data-toggle="tooltip" data-title="Check All">
                                        <label>
                                            <input type="checkbox">
                                            <span class="fa fa-check"></span>
                                        </label>
                                    </div>
                                </th>
                                <th>{{ $t('Date') }}</th>
                                <th>{{ $t('Description') }}</th>
                                <th>{{ $t('Amount') }}</th>
                                <th>{{ $t('Status') }}</th>
                                <th class="text-center">{{ $t('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="checkbox c-checkbox">
                                        <label>
                                            <input type="checkbox">
                                            <span class="fa fa-check"></span>
                                        </label>
                                    </div>
                                </td>
                                <td>10-Oct-17</td>
                                <td>DayCare fees</td>
                                <td>$500.00</td>
                                <td>Due</td>
                                <td class="text-center">
                                    <a class="btn btn-primary btn-xs" href="" title="Edit"><i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-danger btn-xs" href="" title="Delete"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="checkbox c-checkbox">
                                        <label>
                                            <input type="checkbox">
                                            <span class="fa fa-check"></span>
                                        </label>
                                    </div>
                                </td>
                                <td>9-Oct-17</td>
                                <td>Supplies</td>
                                <td>$45.00</td>
                                <td>Paid</td>
                                <td class="text-center">
                                    <a class="btn btn-primary btn-xs" href="" title="Edit"><i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-danger btn-xs" href="" title="Delete"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="checkbox c-checkbox">
                                        <label>
                                            <input type="checkbox">
                                            <span class="fa fa-check"></span>
                                        </label>
                                    </div>
                                </td>
                                <td>5-Oct-17</td>
                                <td>Late Pick Up fees</td>
                                <td>$60.00</td>
                                <td>Paid</td>
                                <td class="text-center">
                                    <a class="btn btn-primary btn-xs" href="" title="Edit"><i class="fa fa-pencil"></i></a>
                                    <a class="btn btn-danger btn-xs" href="" title="Delete"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div style="display: none;" id="invoice-create">
            <div class="content-heading">
                <!-- START Language list-->
                <div class="pull-right">
                    <div class="btn-group">
                        <button class="btn btn-success waves-effect m-b-5"
                                id="back-btn">
                            <i class="fa fa-chevron-left m-r-5 btn-fa"></i>
                            <span>{{ $t('Back') }}</span>
                        </button>
                    </div>
                </div>
                <h3 style="margin-top: 0px;">{{ $t('New Invoice') }}</h3>
            </div>
            <hr>
            <div class="panel panel-default">
                <div class="panel-heading" style="color: #515253;">
                    <div class="row">
                        <div class="col-lg-4">
                            <h4>Date: 10 October 2017</h4>
                            <h4>Date: 10 December 2017</h4>
                        </div>
                        <div class="col-lg-5"></div>
                        <div class="col-lg-3">
                            <div class="input-group pull-right">
                                <h4>Invoice#: 00001</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group col-md-2" style="padding-right:0px;">
                            <input id="name" class="form-control input-lg" :placeholder="$t('Name')" name="name" type="text">
                        </div>
                        <div class="form-group col-md-4" style="padding-right:0px;padding-left:7px;">
                            <input id="description" class="form-control input-lg" :placeholder="$t('Description')" name="description" type="text">
                        </div>
                        <div class="form-group col-md-1" style="padding-right:0px;padding-left:7px;">
                            <input id="description" class="form-control input-lg" :placeholder="$t('qty')" name="description" type="text" style="padding-left: 15px;">
                        </div>
                        <div class="form-group col-md-2" style="padding-right:0px;padding-left:7px;">
                            <input id="description" class="form-control input-lg" :placeholder="$t('Amount')" name="description" type="text">
                        </div>
                        <div class="form-group col-md-2" style="padding-right:0px;padding-left:7px;">
                            <input id="description" class="form-control input-lg" :placeholder="$t('Total')" name="description" type="text">
                        </div>
                        <div class="form-group col-md-1" style="padding-left:14px;">
                            <a><i class="fa fa-trash-o billing-btn-fa"></i></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-2" style="padding-right:0px;">
                            <input id="name" class="form-control input-lg" placeholder="Name" name="name" type="text">
                        </div>
                        <div class="form-group col-md-4" style="padding-right:0px;padding-left:7px;">
                            <input id="description" class="form-control input-lg" placeholder="Description" name="description" type="text">
                        </div>
                        <div class="form-group col-md-1" style="padding-right:0px;padding-left:7px;">
                            <input id="description" class="form-control input-lg" placeholder="qty" name="description" type="text" style="padding-left: 15px;">
                        </div>
                        <div class="form-group col-md-2" style="padding-right:0px;padding-left:7px;">
                            <input id="description" class="form-control input-lg" placeholder="Amount" name="description" type="text">
                        </div>
                        <div class="form-group col-md-2" style="padding-right:0px;padding-left:7px;">
                            <input id="description" class="form-control input-lg" placeholder="Total" name="description" type="text">
                        </div>
                        <div class="form-group col-md-1" style="padding-left:14px;">
                            <a href="" title=""><i class="fa fa-plus billing-btn-fa"></i></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="padding-right:0px;">
                            <div class="form-group">
                                <label for="Textarea">{{ $t('Comments/Instructions') }}</label>
                                <textarea name="text" rows="6" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-4" style="padding-right:0px;padding-left:7px;">
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-4 col-form-label">{{ $t('Sub Total') }}:</label>
                                <div class="col-sm-8">
                                    <input class="form-control input-lg" type="text" :placeholder="$t('Sub Total')">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-4 col-form-label">{{ $t('Tax') }}s:</label>
                                <div class="col-sm-8">
                                    <input class="form-control input-lg" type="text" :placeholder="$t('Tax')">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-4 col-form-label">{{ $t('Total') }}:</label>
                                <div class="col-sm-8">
                                    <input class="form-control input-lg" type="text" :placeholder="$t('Total')">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-danger waves-effect m-b-5"><span>{{ $t('Cancel') }}</span></button>
                        </div>
                        <div class="col-md-5 pull-right row">
                            <div class="col-sm-6">
                                <button class="btn btn-success waves-effect m-b-5"><span>{{ $t('Save as Draft') }}</span></button>
                            </div>
                            <div class="col-sm-6">
                                <button class="btn btn-success waves-effect m-b-5"><span>{{ $t('Save and Send') }}</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted()
        {
            $('#btn-invoice').on('click', function() {
                $('#billing-index').hide();
                $('#invoice-create').show();
            });
            $('#back-btn').on('click', function() {
                $('#invoice-create').hide();
                $('#billing-index').show();
            });
        }
    }
</script>
