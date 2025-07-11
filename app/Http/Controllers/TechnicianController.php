<?php

namespace App\Http\Controllers;

use App\Models\DeviceDelivery;
use App\Models\Technician;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TechnicianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technicians = Technician::get();
        return view('technicians.index', compact('technicians'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('technicians.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);

        Technician::create($request->all());

        return redirect()->route('technicians.index')
                         ->with('success', 'Technician created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Technician $technician)
    {
        $technician->load('DeviceDelivery','DeviceReceipt','AccessorySale');
        // dd($technician->DeviceDelivery);
        return view('technicians.show', compact('technician'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technician $technician)
    {
        return view('technicians.edit', compact('technician'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Technician $technician)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);

        $technician->update($request->all());

        return redirect()->route('technicians.index')
                         ->with('success', 'Technician updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technician $technician)
    {
        $technician->delete();

        return redirect()->route('technicians.index')
                ->with('success', 'Technician deleted successfully.');
    }
}