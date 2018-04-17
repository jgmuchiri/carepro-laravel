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
                <div class="panel-body">
                    <!-- START table-responsive-->
                    <div v-if="invoices.length" class="table-responsive">
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
                                <tr v-for="invoice in invoices">
                                    <td>
                                        <div class="checkbox c-checkbox">
                                            <label>
                                                <input type="checkbox">
                                                <span class="fa fa-check"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>{{invoice.created_at | moment("DD-MMM-YYYY") }}</td>
                                    <td>{{invoice.invoice_terms }}</td>
                                    <td>${{invoice.amount }}</td>
                                    <td>{{invoice.invoicestatus.name }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-success btn-xs" title="Edit"><i class="fa fa-credit-card"></i></a>
                                        <a class="btn btn-primary btn-xs" v-on:click="editInvoice(invoice)" title="Edit"><i class="fa fa-pencil"></i></a>
                                        <a class="btn btn-danger btn-xs" v-on:click="deleteInvoice(invoice.id)" title="Delete"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div v-else class="text-center">
                        <p>There are no Invoice records</p>
                    </div>
                </div>
            </div>
        </div>

        <div style="display: none;" id="invoice-create">
            <div class="content-heading">
                <!-- START Language list-->
                <div class="pull-right">
                    <div class="btn-group">
                        <button v-on:click.prevent="cancel" class="btn btn-success waves-effect m-b-5"
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
                <div v-if="edit" class="panel-heading" style="color: #515253;">
                    <div class="row">
                        <div class="col-lg-4">
                            <h4>Date: {{ invoice.created_at | moment("DD MMMM YYYY") }}</h4>
                            <h4>Due: {{ invoice.due_date | moment("DD MMMM YYYY") }}</h4>
                        </div>
                        <div class="col-lg-5 text-center">
                            <div class="form-group" style="padding-top:10px;">
                                <select v-model="invoice.invoice_status" class="form-control input-lg">
                                    <option v-for="status in invoicestatuses" v-bind:value="status.id">{{ status.name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="input-group pull-right">
                                <h4>Invoice#: {{ invoice.id }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form method="POST" v-on:submit.prevent="edit ? updateInvoice(invoice.id) : saveInvoice()">
                        <div v-for="(input, index) in invoice.invoiceitems" class="row">
                            <div class="form-group col-md-2" style="padding-right:0px;">
                                <input id="name" class="form-control input-lg" v-model="input.name" :placeholder="$t('Name')" name="name" type="text" required>
                            </div>
                            <div class="form-group col-md-4" style="padding-right:0px;padding-left:7px;">
                                <input id="description" class="form-control input-lg" v-model="input.description" :placeholder="$t('Description')" name="description" type="text" required>
                            </div>
                            <div class="form-group col-md-1" style="padding-right:0px;padding-left:7px;">
                                <input id="qty" class="form-control input-lg" v-on:keyup="updateItemtotal(index)" :placeholder="$t('qty')"v-model="input.quantity" name="qty" type="number" style="padding-left: 15px;" required>
                            </div>
                            <div class="form-group col-md-2" style="padding-right:0px;padding-left:7px;">
                                <input id="ammount" class="form-control input-lg" v-on:keyup="updateItemtotal(index)" :placeholder="$t('Amount')" v-model="input.amount" name="ammount" type="number" required>
                            </div>
                            <div class="form-group col-md-2" style="padding-right:0px;padding-left:7px;">
                                <input id="total" class="form-control input-lg" :placeholder="$t('Total')" v-model="input.total" name="total" type="number" required>
                            </div>
                            <div class="form-group col-md-1" style="padding-left:14px;">
                                <a v-if="invoice.invoiceitems.length <= 1 && index <= 1 || ( ok(index) )" v-on:click="addRow(index)"><i class="fa fa-plus billing-btn-fa"></i></a>
                                <a v-else v-on:click="deleteRow(index)"><i class="fa fa-trash-o billing-btn-fa"></i></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6" style="padding-right:0px;">
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">{{ $t('Due date') }}:</label>
                                    <div class="col-sm-9">
                                        <input type="date" name="due_date" class="form-control input-lg" v-model="invoice.due_date" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Textarea">{{ $t('Comments/Instructions') }}</label>
                                    <textarea name="text" rows="3" class="form-control" v-model="invoice.invoice_terms" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-4" style="padding-right:0px;padding-left:7px;">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">{{ $t('Sub Total') }}:</label>
                                    <div class="col-sm-8">
                                        <input class="form-control input-lg" type="number" v-model="invoice.subtotal" :placeholder="$t('Sub Total')" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">{{ $t('Tax') }}:</label>
                                    <div class="col-sm-8">
                                        <input class="form-control input-lg" type="number" v-model="invoice.tax" :placeholder="$t('Tax')" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-4 col-form-label">{{ $t('Total') }}:</label>
                                    <div class="col-sm-8">
                                        <input class="form-control input-lg" type="number" v-model="invoice.amount" :placeholder="$t('Total')" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <button v-on:click.prevent="cancel" class="btn btn-danger waves-effect m-b-5"><span>{{ $t('Cancel') }}</span></button>
                            </div>
                            <div v-if="!edit" class="col-md-5 pull-right row">
                                <div class="col-sm-6">
                                    <button type="submit" v-on:click="invoice.invoice_status = 1" class="btn btn-success waves-effect m-b-5"><span>{{ $t('Save as Draft') }}</span></button>
                                </div>
                                <div class="col-sm-6">
                                    <button type="submit" v-on:click="invoice.invoice_status = 2" class="btn btn-success waves-effect m-b-5"><span>{{ $t('Save and Send') }}</span></button>
                                </div>
                            </div>
                            <div v-else class="col-md-5 text-center row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-success waves-effect m-b-5"><span>{{ $t('Save') }}</span></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                invoice: this.invoiceData(),
                invoices: [],
                edit: false,
                invoicestatuses: []
            }
        },

        created() {
            this.getInvoices()
            this.getStatuses()
        },

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
        },

        methods: {
            invoiceData: function() {
                return {
                    invoiceitems: [
                        {
                            name: '',
                            description: '',
                            quantity: '',
                            amount: '',
                            total: '',
                            id: ''
                        }
                    ],
                    subtotal: '',
                    tax: '',
                    amount: '',
                    invoice_status: '',
                    invoice_terms: '',
                    id: ''
                }
            },

            getInvoices: function() {
                axios.get('/api/children/' + this.child.id + '/invoice')
                .then(response => {
                    this.invoices = response.data
                })
                .catch(function (error) {
                    this.$noty.error(error.response.data.message);
                });
            },

            getStatuses: function() {
                axios.get('/api/children/invoice/status')
                .then(response => {
                    this.invoicestatuses = response.data
                })
                .catch(function (error) {
                    this.$noty.error(error.response.data.message);
                });
            },

            saveInvoice: function() {
                axios.post('/api/children/' + this.child.id + '/invoice', this.invoice)
                .then(response => {
                    this.invoice = this.invoiceData()
                    this.getInvoices()
                    this.$noty.success(response.data.message);
                })
                .catch(function (error) {
                    this.$noty.error(error.response.data.message);
                });
            },

            updateInvoice: function(id) {
                axios.patch('/api/children/' + this.child.id + '/invoice/' + id, this.invoice)
                .then(response => {
                    this.invoice = this.invoiceData()
                    this.edit = false
                    this.getInvoices()
                    $('#invoice-create').hide();
                    $('#billing-index').show();
                    this.$noty.success(response.data.message);
                })
                .catch(function (error) {
                    this.$noty.error(error.response.data.message);
                });
            },

            editInvoice: function(invoice) {
                this.invoice = invoice
                this.edit = true
                $('#billing-index').hide();
                $('#invoice-create').show();

            },

            updateItemtotal: function(index) {
                let self = this
                this.invoice.invoiceitems[index].total = this.invoice.invoiceitems[index].quantity * this.invoice.invoiceitems[index].amount
                // for(var index = 0; index < self.invoice.invoiceitems.length; index++) {
                //     self.invoice.subtotal = parseFloat(self.invoice.subtotal) + parseFloat(self.invoice.invoiceitems[index].total)
                //     console.log(self.invoice.subtotal)
                // }
            },

            addRow() {
              this.invoice.invoiceitems.push({
                name: '',
                description: '',
                quantity: '',
                amount: '',
                total: '',
                id: ''
              })
            },

            deleteRow(index) {
              this.invoice.invoiceitems.splice(index,1)
            },

            ok(index) {
                var pos = index + 1
                if(pos == this.invoice.invoiceitems.length) {
                    return true
                } else {
                    return false
                }
            },

            cancel: function() {
                this.invoice = this.invoiceData()
                this.edit = false
                $('#invoice-create').hide();
                $('#billing-index').show();
            },

            deleteInvoice: function (id) {
                let self = this
                this.$swal({

                    title: 'Are you sure?',
                    text: 'You will not be able to recover this Invoice record!',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, keep it'
                })

                .then(function(result) {
                    axios.delete('/api/children/' + self.child.id + '/invoice/' + id)
                    .then(response => {
                        self.child.food_preferences = self.child.food_preferences.filter(x => x.id != id);
                         self.$swal(
                            'Deleted!',
                            response.data.message,
                            'success'
                          );
                    })
                    .catch(function (error) {
                        self.$swal(
                            'Something went Wrong',
                            'Invoice record could not be deleted! :)',
                            'error'
                        );
                    });

                    }, function(dismiss) {
                        if (dismiss === 'cancel') {
                          self.$swal(
                            'Cancelled',
                            'Your Invoice record is safe :)',
                            'error'
                          );
                        }
                    }
                );
            },
        },

        props: ['child']
    }
</script>
