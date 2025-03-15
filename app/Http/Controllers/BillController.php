<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Bill;
use App\Models\Laboratory;
use App\Models\Medicine;
use App\Models\Room;
use App\Models\Suport;
use App\Models\Tool;
use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Bill::create([
            'bill_category' => $request->category,
            'bill_name' => $request->name,
            'bill_price' => $request->price,
        ]);
        return view('note.create', [
            'category' => $request->category,
            'bills' => Bill::where('bill_category', $request->category)->get(),
            'total' => Bill::where('bill_category', $request->category)->sum(
                'bill_price'
            ),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Bill $bill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bill $bill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bill $bill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bill $bill, Request $request)
    {
        $bill->delete();

        return view('note.create', [
            'category' => $request->category,
            'bills' => Bill::where(
                'bill_category',
                $bill->bill_category
            )->get(),
            'total' => Bill::where('bill_category', $bill->bill_category)->sum(
                'bill_price'
            ),
        ]);
    }
}
