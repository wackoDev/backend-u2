<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::all()->load('items');

        return response()->json($invoices, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'number' => 'required|string',
            'date' => 'required|date',
            'emitter_identification' => 'required|string',
            'emitter_name' => 'required|string',
            'receiver_identification' => 'required|string',
            'receiver_name' => 'required|string',
            'total_value' => 'required|numeric',
            'iva' => 'required|numeric',
            'total_value_iva' => 'required|numeric',
            'items' => 'required|array',
            'items.*.description' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.value' => 'required|numeric',
            'items.*.total_value' => 'required|numeric',
        ]);
    
        $invoice = Invoice::create($validatedData);
        $invoice->items()->createMany($validatedData['items']);
    
        return response()->json($invoice->load('items'), 201);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        return response()->json($invoice->load('items'), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        $validatedData = $request->validate([
            'number' => 'required|string',
            'date' => 'required|date',
            'emitter_identification' => 'required|string',
            'emitter_name' => 'required|string',
            'receiver_identification' => 'required|string',
            'receiver_name' => 'required|string',
            'total_value' => 'required|numeric',
            'iva' => 'required|numeric',
            'total_value_iva' => 'required|numeric',
            'items' => 'required|array',
            'items.*.description' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.value' => 'required|numeric',
            'items.*.total_value' => 'required|numeric',
        ]);
    
        $invoice->update($validatedData);
    
        $invoice->items()->delete(); 
        $invoice->items()->createMany($validatedData['items']); 
    
        return response()->json($invoice->load('items'), 200); 
    }
    


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return response()->json($invoice, 200); 

    }
}
