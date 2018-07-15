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
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                <input class="input-sm form-control" type="text" :placeholder="$t('Search')">
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5"></div>
                        <div class="col-lg-3 col-md-3">
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
                                        <a class="btn btn-success btn-xs" v-on:click="viewInvoice(invoice)" title="View"><i class="fa fa-eye"></i></a>
                                        <a class="btn btn-primary btn-xs" v-on:click="editInvoice(invoice.id)" title="Edit"><i class="fa fa-pencil"></i></a>
                                        <a :href="'/children/' + child.id + '/invoice/' + invoice.id" class="btn btn-success btn-xs" target="_blank" title="Download Invoice"><i class="fa fa-download"></i></a>
                                        <a class="btn btn-danger btn-xs" v-on:click="deleteInvoice(invoice.id)" title="Delete"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div v-else class="text-center">
                        <p>We couldn't find any Invoice records</p>
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
                                        <datetime type="date" v-model="invoice.due_date" placeholder="Due date" input-class="form-control input-lg" required></datetime>
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
                                        <input class="form-control input-lg" type="number" v-model="invoice.subtotal" :placeholder="$t('Sub Total')" required disabled>
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
                                        <input class="form-control input-lg" type="number" v-model="invoice.amount" :placeholder="$t('Total')" required disabled>
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

        <div style="display: none;" id="invoice-view">
            <div class="content-heading">
                <!-- START Language list-->
                <div class="pull-right">
                    <div class="btn-group">
                        <button v-on:click.prevent="cancel" class="btn btn-success waves-effect m-b-5"
                                id="back-btn-view">
                            <i class="fa fa-chevron-left m-r-5 btn-fa"></i>
                            <span>{{ $t('Back') }}</span>
                        </button>
                    </div>
                </div>
                <h3 style="margin-top: 0px;">{{ $t('View Invoice') }}</h3>
            </div>
            <hr>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="content-heading">
                        <!-- START Language list-->
                        <div class="pull-right">
                            <div class="btn-group">
                                <button v-if="invoice.invoice_status == 2" class="btn btn-default waves-effect m-b-5" v-on:click.prevent="getInvoiceModal" title="Pay Invoice">
                                    <i class="fa fa-credit-card m-r-5"></i>
                                </button>
                                <button v-if="invoice.invoice_status == 2" data-toggle="modal" data-target="#manual-payment-modal" data-backdrop="false" class="btn btn-default waves-effect m-b-5"  title="Manual Payment">
                                    <i class="fa fa-money"></i>
                                </button>
                                <button  class="btn btn-default waves-effect m-b-5" data-toggle="modal" data-target="#emailNote" data-backdrop="false" >
                                    <i class="fa fa-envelope m-r-5"></i>
                                </button>
                                <button :href="'/children/' + child.id + '/invoice/' + invoice.id" class="btn btn-default waves-effect m-b-5" target="_blank" title="Download Invoice">
                                    <i class="fa fa-download"></i>
                                </button>
                            </div>
                        </div>
                        <h3 style="margin-top: 0px;">Invoice#: {{ invoice.id }}</h3>
                    </div>
                    <hr style="margin-bottom:5px;">
                    <div class="row" style="padding-bottom:10px;">
                        <div class="col-md-4">
                            <h4>Date: {{ invoice.created_at | moment("DD MMMM YYYY") }}</h4>
                        </div>
                        <div class="col-md-4">
                            <h4>Due: {{ invoice.due_date | moment("DD MMMM YYYY") }}</h4>
                        </div>
                        <div class="col-md-4">
                            <h4>Status: {{ invoice.invoicestatus.name }}</h4>
                        </div>
                    </div>
                    <form method="POST" v-on:submit.prevent="edit ? updateInvoice(invoice.id) : saveInvoice()">
                        <fieldset disabled="disabled">
                        <div v-for="(input, index) in invoice.invoiceitems" class="row">
                            <div class="form-group col-md-2" style="padding-right:0px;">
                                <input id="name" class="form-control input-lg" v-model="input.name" :placeholder="$t('Name')" name="name" type="text" required>
                            </div>
                            <div class="form-group col-md-5" style="padding-right:0px;padding-left:7px;">
                                <input id="description" class="form-control input-lg" v-model="input.description" :placeholder="$t('Description')" name="description" type="text" required>
                            </div>
                            <div class="form-group col-md-1" style="padding-right:0px;padding-left:7px;">
                                <input id="qty" class="form-control input-lg" v-on:keyup="updateItemtotal(index)" :placeholder="$t('qty')"v-model="input.quantity" name="qty" type="number" style="padding-left: 15px;" required>
                            </div>
                            <div class="form-group col-md-2" style="padding-right:0px;padding-left:7px;">
                                <input id="ammount" class="form-control input-lg" v-on:keyup="updateItemtotal(index)" :placeholder="$t('Amount')" v-model="input.amount" name="ammount" type="number" required>
                            </div>
                            <div class="form-group col-md-2" style="padding-left:7px;">
                                <input id="total" class="form-control input-lg" :placeholder="$t('Total')" v-model="input.total" name="total" type="number" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6" style="padding-right:0px;">
                                <div class="form-group row">
                                    <label for="" class="col-sm-3 col-form-label">{{ $t('Due date') }}:</label>
                                    <div class="col-sm-9">
                                        <datetime type="date" v-model="invoice.due_date" placeholder="Due date" input-class="form-control input-lg" required></datetime>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Textarea">{{ $t('Comments/Instructions') }}</label>
                                    <textarea name="text" rows="3" class="form-control" v-model="invoice.invoice_terms" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-4" style="padding-left:7px;">
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
                      </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="stripe-modal" tabindex="-1" role="dialog" aria-labelledby="stripe-modal">
            <div class="modal-dialog" role="document" style="padding-top:150px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="cancelPayment()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">{{ $t('Pay Invoice') }}</h4>
                    </div>

                    <form >
                        <div class="modal-body" v-bind:class="{ 'whirl duo' : modal_loading}">
                            <div v-if="error_message" class="alert alert-warning alert-dismissible fade in" role="alert">
                               <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                               </button>
                               <strong>{{ error_message }}</strong>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="/charge" method="post" id="payment-form">
                                      <div class="form-row">
                                        <label for="card-element">
                                          Credit or debit card
                                        </label>
                                        <div id="card-element">
                                          <!-- A Stripe Element will be inserted here. -->
                                        </div>

                                        <!-- Used to display form errors. -->
                                        <div id="card-errors" role="alert"></div>
                                      </div>

                                      <button class="btn-Stripe">Submit Payment</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" v-on:click="cancelPayment()" data-dismiss="modal" v-bind:class="{ 'disabled' : modal_loading}">
                                {{ $t('Cancel') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="manual-payment-modal" tabindex="-1" role="dialog" aria-labelledby="manual-payment-modal">
            <div class="modal-dialog" role="document" style="padding-top:150px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="cancelPayment()">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">{{ $t('Manual Invoice Payment') }}</h4>
                    </div>

                    <form v-on:submit.prevent="manualpayInvoice()" method="POST" action="">
                        <div class="modal-body">
                            <div v-if="error_message" class="alert alert-warning alert-dismissible fade in" role="alert">
                               <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">×</span>
                               </button>
                               <strong>{{ error_message }}</strong>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="title">Amount</label>
                                    <input id="title" class="form-control input-lg" v-model="manual_payment.amount" type="number" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="title">Payment Method</label>
                                    <select class="form-control input-lg" v-model="manual_payment.transaction_types_id" required>
                                        <option v-for="type in transaction_types" v-if="types(type.id)" v-bind:value="type.id">{{ type.name }}</option>
                                    </select>
                                </div>
                                <div v-if="manual_payment.transaction_types_id == 4 || manual_payment.transaction_types_id == 7" class="form-group col-md-4">
                                    <label v-if="manual_payment.transaction_types_id == 4" for="transactionID">Cheque Number</label>
                                    <label v-else-if="manual_payment.transaction_types_id == 7">Money Order Number</label>
                                    <input id="transactionID" class="form-control input-lg" type="text" v-model="manual_payment.transaction_id" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" v-on:click="cancelPayment()" data-dismiss="modal">
                                {{ $t('Cancel') }}
                            </button>
                            <button class="btn btn-primary">{{ $t('Pay Invoice') }}</button>
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
                invoicestatuses: [],
                modal_loading: true,
                error_message: '',
                transaction_types: [],
                manual_payment: this.manualPayData()
            }
        },

        created() {
            this.getInvoices()
            this.getStatuses()
            this.getTransactionTypes()
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
            $('#back-btn-view').on('click', function() {
                $('#invoice-view').hide();
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
                    id: '',
                    invoicestatus: {}
                }
            },

            manualPayData: function() {
                return {
                    transaction_types_id: '',
                    amount: '',
                    transaction_id: ''
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

            getTransactionTypes: function() {
                axios.get('/api/children/invoice/transactions/types')
                .then(response => {
                    this.transaction_types = response.data
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
                    this.getInvoices()
                    this.invoice = this.invoiceData()
                    $('#invoice-create').hide();
                    $('#billing-index').show();
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
                    this.getInvoices()
                    this.$noty.success(response.data.message);
                })
                .catch(function (error) {
                    this.$noty.error(error.response.data.message);
                });
            },

            getInvoiceModal: function() {
                let self = this
                $('#stripe-modal').modal({
                  backdrop: false
                })
                // Create a Stripe client.
                var stripe = Stripe('pk_test_if37UhzdK0YACcMn7a9hA2b2');

                // Create an instance of Elements.
                var elements = stripe.elements();

                // Custom styling can be passed to options when creating an Element.
                // (Note that this demo uses a wider set of styles than the guide below.)
                var style = {
                  base: {
                    color: '#32325d',
                    lineHeight: '18px',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                      color: '#aab7c4'
                    }
                  },
                  invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                  }
                };

                // Create an instance of the card Element.
                var card = elements.create('card', {style: style});

                // Add an instance of the card Element into the `card-element` <div>.
                card.mount('#card-element');

                // Handle real-time validation errors from the card Element.
                card.addEventListener('change', function(event) {
                  var displayError = document.getElementById('card-errors');
                  if (event.error) {
                    displayError.textContent = event.error.message;
                  } else {
                    displayError.textContent = '';
                  }
                });
                this.modal_loading = false
                // Handle form submission.
                var form = document.getElementById('payment-form');
                form.addEventListener('submit', function(event) {
                    self.error_message = ''
                    self.modal_loading = true
                    event.preventDefault();

                  stripe.createToken(card).then(function(result) {
                    if (result.error) {
                      // Inform the user if there was an error.
                        var errorElement = document.getElementById('card-errors');
                        self.modal_loading = false
                        errorElement.textContent = result.error.message;
                    } else {
                        // Send the token to your server.
                        self.payInvoice(result.token, card);
                    }
                  });
                });
            },

            payInvoice: function(token, card) {
                let self = this
                self.error_message = ''
                axios.post('/api/children/' + this.child.id + '/invoice/' + this.invoice.id + '/pay', token)
                .then(response => {
                    this.modal_loading = false
                    self.$swal(
                        'Success!',
                        response.data.message,
                        'success'
                    );
                    this.invoice = response.data.invoice
                    $('#stripe-modal').hide()
                    this.getInvoices()
                })
                .catch(function (error) {
                    console.log(error)
                    self.modal_loading = false
                    self.error_message = error.response.data.message
                });
            },

            manualpayInvoice: function() {
                let self = this
                self.error_message = ''
                axios.post('/api/children/' + this.child.id + '/invoice/' + this.invoice.id + '/manual-pay', this.manual_payment)
                .then(response => {
                    self.$swal(
                        'Success!',
                        response.data.message,
                        'success'
                    );
                    this.invoice = response.data.invoice
                    $('#manual-payment-modal').hide()
                    this.manual_payment = this.manualPayData()
                    this.getInvoices()
                })
                .catch(function (error) {
                    self.error_message = error.response.data.message
                });
            },

            editInvoice: function(id) {
                axios.get('/api/children/' + this.child.id + '/invoice/' + id)
                .then(response => {
                    this.invoice = response.data
                    this.edit = true
                    $('#billing-index').hide();
                    $('#invoice-create').show();
                    this.updateTotal()
                })
                .catch(function (error) {
                    this.$noty.error(error.response.data.message);
                });
            },

            viewInvoice: function(invoice) {
                this.invoice = invoice
                $('#billing-index').hide();
                $('#invoice-view').show();
                this.updateTotal()
            },

            updateItemtotal: function(index) {
                let self = this
                this.invoice.invoiceitems[index].total = this.invoice.invoiceitems[index].quantity * this.invoice.invoiceitems[index].amount
                // for(var index = 0; index < self.invoice.invoiceitems.length; index++) {
                //     self.invoice.subtotal = parseFloat(self.invoice.subtotal) + parseFloat(self.invoice.invoiceitems[index].total)
                //     console.log(self.invoice.subtotal)
                // }
                self.updateTotal()
            },

            updateTotal: function() {
                let self = this
                self.invoice.subtotal = '0'
                for(var index = 0; index < self.invoice.invoiceitems.length; index++) {
                    self.invoice.subtotal = parseFloat(self.invoice.subtotal) + parseFloat(self.invoice.invoiceitems[index].total)
                    self.invoice.amount = self.invoice.subtotal
                }
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

            cancelPayment: function() {
                this.manual_payment = this.manualPayData()
                self.error_message = ''
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

            types: function(id) {
                return id != 1 && id != 2
            }
        },

        props: ['child']
    }
</script>
