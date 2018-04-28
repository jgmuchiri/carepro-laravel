<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice\InvoiceStatus;
use App\Models\Invoice\Invoice;
use App\Models\Invoice\InvoiceItem;
use App\Models\Child;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $invoices = Invoice::where('child_id', $id)->with('invoiceitems', 'invoicestatus')->get();

        return $invoices;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $child = Child::findOrFail($id);
        $this->authorize('update', $child);

        $this->validate($request, [
            'invoiceitems.*.name' => 'required|max:255',
            'invoiceitems.*.description' => 'required',
            'invoiceitems.*.quantity' => 'required',
            'invoiceitems.*.amount' => 'required|integer',
            'invoiceitems.*.total' => 'required|integer',
            'due_date' => 'required|date',
            'invoice_terms' => 'required',
            'tax' => 'required|integer',
            'invoice_status' => 'required|integer',
            'amount' => 'required|integer',
        ]);

        $invoice = new Invoice;
        $invoice->due_date = $request->due_date;
        $invoice->invoice_terms = $request->invoice_terms;
        $invoice->amount = $request->amount;
        $invoice->tax = $request->tax;
        $invoice->invoice_status = $request->invoice_status;
        $invoice->child_id = $id;
        $invoice->save();

        foreach ($request->invoiceitems as $key => $value) {
            $invoiceItem = new InvoiceItem;
            $invoiceItem->name = $value['name'];
            $invoiceItem->description = $value['description'];
            $invoiceItem->quantity = $value['quantity'];
            $invoiceItem->amount = $value['amount'];
            $invoiceItem->total = $value['total'];
            $invoiceItem->invoice_id = $invoice->id;
            $invoiceItem->save();
        }

        return response()->json([
            'status' => 'okay',
            'status_code' => '200',
            'message' => 'Invoice record has been created',
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $child_id, $id)
    {
        $child = Child::findOrFail($child_id);
        $this->authorize('update', $child);

        $this->validate($request, [
            'invoiceitems.*.name' => 'required|max:255',
            'invoiceitems.*.description' => 'required',
            'invoiceitems.*.quantity' => 'required',
            'invoiceitems.*.amount' => 'required|integer',
            'invoiceitems.*.total' => 'required|integer',
            'due_date' => 'required|date',
            'invoice_terms' => 'required',
            'tax' => 'required|integer',
            'invoice_status' => 'required|integer',
            'amount' => 'required|integer',
        ]);

        $invoice = Invoice::find($id);
        $invoiceitems = collect(InvoiceItem::where('invoice_id', $id)->pluck('id'));
        // if (array_has($invoiceitems, '4')) {
        //     return 'true';
        // } else {
        //     return 'false';
        // }
        //return $invoiceitems->search(5);
        $invoice->due_date = $request->due_date;
        $invoice->invoice_terms = $request->invoice_terms;
        $invoice->amount = $request->amount;
        $invoice->tax = $request->tax;
        $invoice->invoice_status = $request->invoice_status;
        $invoice->child_id = $child_id;
        $invoice->save();

        foreach ($request->invoiceitems as $key => $value) {
            if (is_null($value['id'])) {
                $invoiceItem = new InvoiceItem;
                $invoiceItem->name = $value['name'];
                $invoiceItem->description = $value['description'];
                $invoiceItem->quantity = $value['quantity'];
                $invoiceItem->amount = $value['amount'];
                $invoiceItem->total = $value['total'];
                $invoiceItem->invoice_id = $invoice->id;
                $invoiceItem->save();
            } else {
                $invoiceItem = InvoiceItem::find($value['id']);
                $invoiceItem->name = $value['name'];
                $invoiceItem->description = $value['description'];
                $invoiceItem->quantity = $value['quantity'];
                $invoiceItem->amount = $value['amount'];
                $invoiceItem->total = $value['total'];
                $invoiceItem->invoice_id = $invoice->id;
                $invoiceItem->save();
                $index = $invoiceitems->search($value['id']);
                $invoiceitems->pull($index);
            }
        }
        foreach ($invoiceitems as $key => $value) {
            $invoiceItem = InvoiceItem::find($value);
            $invoiceItem->delete();
        }

        return response()->json([
            'status' => 'okay',
            'status_code' => '200',
            'message' => 'Invoice record has been updated',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($child_id, $id)
    {
        $child = Child::findOrFail($child_id);
        $this->authorize('update', $child);

        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return response()->json(['message' => __('Successfully deleted Invoice record.')]);
    }

    public function status()
    {
        $status = InvoiceStatus::all();

        return $status;
    }
}
