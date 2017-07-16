@extends('layouts.dashboard')

@section('title') @lang('Invoices')
@endsection

@section('content')
    <div class="content">
        <table class="table table-responsive table-full-width table-striped" id="table2">
            <thead>
            <tr>
                <th>@lang('Date')</th>
                <th>@lang('Total')</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($user->invoicesIncludingPending() as $invoice)
                <tr>
                    <td>{{ $invoice->date()->toFormattedDateString() }}</td>
                    <td>{{ $invoice->total() }}</td>
                    <td><a href="{{ route('invoices.download', $invoice->id) }}">@lang('Download')</a></td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <div class="clearfix"></div>
    </div>
@stop
