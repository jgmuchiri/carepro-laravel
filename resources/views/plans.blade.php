@extends('layouts.logged-out')

@push('styles')
    <link href="/css/subscriptions.css" rel="stylesheet"/>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div>
                <div class="col-xs-12 col-md-3 col-md-offset-1">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                STANDARD</h3>
                        </div>
                        <div class="panel-body">
                            <div class="the-price">
                                <h1>
                                    $10<span class="subscript">/mo</span></h1>
                                <small>14 days FREE trial*</small>
                            </div>
                            <table class="table">
                                <tr>
                                    <td>
                                        5 Children
                                    </td>
                                </tr>
                                <tr class="active">
                                    <td>
                                        1 Staff Member
                                    </td>
                                </tr>
                                <tr>
                                    <td><strike>Invoice due alerts to parents</strike></td>
                                </tr>
                            </table>
                        </div>
                        <div class="panel-footer">
                            <a href="{{ route('subscriptions.subscribe-to-trial', 'Standard') }}" class="btn btn-success" role="button">START YOUR FREE TRIAL</a>
                            <p>14 Days Free*</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4">
                    <div class="panel panel-success">
                        <div class="cnrflash">
                            <div class="cnrflash-inner">
                            <span class="cnrflash-label">MOST
                                <br>
                                POPULAR</span>
                            </div>
                        </div>
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                PROFESSIONAL</h3>
                        </div>
                        <div class="panel-body">
                            <div class="the-price">
                                <h1>
                                    $20<span class="subscript">/mo</span></h1>
                                <small>14 days FREE trial*</small>
                            </div>
                            <table class="table">
                                <tr>
                                    <td>
                                        10 Children
                                    </td>
                                </tr>
                                <tr class="active">
                                    <td>
                                        3 Staff Members
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Invoice due alerts to parents
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="panel-footer">
                            <a href="{{ route('subscriptions.subscribe-to-trial', 'Professional') }}" class="btn btn-success" role="button">START YOUR FREE TRIAL</a>
                            <p>14 Days Free*</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                PREMIUM</h3>
                        </div>
                        <div class="panel-body">
                            <div class="the-price">
                                <h1>
                                    $35<span class="subscript">/mo</span></h1>
                                <small>14 days FREE trial*</small>
                            </div>
                            <table class="table">
                                <tr>
                                    <td>
                                        Unlimited Children
                                    </td>
                                </tr>
                                <tr class="active">
                                    <td>
                                        Unlimited Staff
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Invoice due alerts to parents
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="panel-footer">
                            <a href="{{ route('subscriptions.subscribe-to-trial', 'Premium') }}" class="btn btn-success" role="button">START YOUR FREE TRIAL</a>
                            <p>14 Days Free*</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 text-center">
                    <p class="small">*During the free trial your account will be limited to 10 staff and children accounts and only be
                    to generate 5 invoices.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
