<?php

namespace App\Http\Controllers;

use App\Models\DeviceDelivery;
use App\Http\Controllers\Controller;
use App\Models\DeviceReceipt;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Technician;

class DeviceDeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $all = $request->all;
        if ($all == 1) {
            $deviceDelivery = DeviceDelivery::with('technician','customer','device_receipt')->get();
        } else {

            $today = Carbon::today();
            $deviceDelivery = DeviceDelivery::whereDate('created_at', $today)
                ->with('technician','customer','device_receipt')
                ->get();
        }
        return view('device_deliverys.index', compact('deviceDelivery'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $technicians = Technician::get(); 
        return view('device_deliverys.create', compact('request','technicians'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_id' => 'required',
            'device_receipt_id' => 'required',
            'repair_cost' => 'required|numeric|min:0',
            'technician_id' => 'required',
            'status' => 'required'
        ]);
        // dd( $validatedData['customer_id']);

        DeviceDelivery::create([
            'customer_id' => $validatedData['customer_id'],
            'device_receipt_id' => $validatedData['device_receipt_id'],
            'technician_id' => $validatedData['technician_id'],
            'repair_cost' => $validatedData['repair_cost'],
            'status' => $validatedData['status']
        ]);
        DeviceReceipt::find($validatedData['device_receipt_id'])->update([
            'status' => $validatedData['status'],
        ]);

        return redirect()->route('delivery')->with('success', 'تم تسليم الجهاز بنجاح!');
    }


    /**
     * Display the specified resource.
     */
    public function show(DeviceDelivery $deviceDelivery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DeviceDelivery $deviceDelivery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DeviceDelivery $deviceDelivery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeviceDelivery $deviceDelivery)
    {
        //
    }
}
