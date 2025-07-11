<?php

namespace App\Http\Controllers;

use App\Models\SparePartPurchase;
use App\Models\Supplier;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SparePartPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $all = $request->all;
        if ($all == 1) {
        $purchases = SparePartPurchase::with('supplier')->get();
        }  else {
            $today = Carbon::today();
            $purchases = SparePartPurchase::whereDate('created_at', $today)
                ->with('supplier')
                  ->get();
        }
        $supplier = Supplier::get();
        return view('SparePartPurchase.index', compact('purchases','supplier'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('SparePartPurchase.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        // dd($request->input());
        $request->validate([
            'supplier_id' => 'required',
            'buyer_name' => 'required|string|max:255',
            'spare_parts_type' => 'required|string|max:255',
            'seller_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
        ]);
        // Calculate total cost
        $totalCost = $request->total_price * $request->quantity;

        // Update supplier's debts
        Supplier::where('id', $request->supplier_id)->increment('Debts', $totalCost);

        // Create a new spare part purchase
        SparePartPurchase::create([
            'supplier_id' => $request->supplier_id,
            'buyer_name' => $request->buyer_name,
            'spare_parts_type' => $request->spare_parts_type,
            'seller_name' => $request->seller_name,
            'quantity' => $request->quantity,
            'total_price' => $totalCost,
            'return' => 1,
            'purchase_date' => now(),
        ]);

        return redirect()->route('purchases.index')->with('success', 'تم إضافة عملية الشراء بنجاح!');
    }


    /**
     * Display the specified resource.
     */
    public function show(SparePartPurchase $sparePartPurchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SparePartPurchase $sparePartPurchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SparePartPurchase $purchase)
    {
        // Validate the request
        $validatedData = $request->validate([
            'return' => 'required',
        ]);
        // dd($validatedData);

        // Calculate total cost based on quantity and total price
        $totalCost = $purchase->total_price;

        // Decrement the supplier's debts
        Supplier::where('id', $purchase->supplier_id)->decrement('Debts', $totalCost);

        // Update the purchase record
        $purchase->update($validatedData);

        return redirect()->route('purchases.index')->with('success', 'Accessory updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SparePartPurchase $sparePartPurchase)
    {
        //
    }
}
