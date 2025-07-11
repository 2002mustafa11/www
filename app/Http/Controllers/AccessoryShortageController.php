<?php

namespace App\Http\Controllers;

use App\Models\AccessoryShortage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccessoryShortageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accessoryShortage = AccessoryShortage::get();
        return view('AccessoryShortage.index',compact('accessoryShortage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('AccessoryShortage.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->input());
        $accessory = AccessoryShortage::create($request->input());

        return redirect()->route('Shortage.index')->with('success', 'Accessory added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AccessoryShortage $accessoryShortage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AccessoryShortage $accessoryShortage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AccessoryShortage $accessoryShortage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AccessoryShortage $accessoryShortage)
    {
        //
    }
}
