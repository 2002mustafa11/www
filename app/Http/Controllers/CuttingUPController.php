<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CuttingUP;

class CuttingUPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $CuttingUPs = CuttingUP::all(); // Fetch all CuttingUPs
        // dd($CuttingUPs);
        return view('CuttingUP.index', compact('CuttingUPs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('CuttingUP.create'); // Return view for creating a new CuttingUP
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $cuttingUP = $request->validate([
            'company' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'content' => 'required|string',
        ]);

        // Create a new CuttingUP instance
        CuttingUP::create([
            'company' => $cuttingUP['company'] ?? '', // Using null coalescing operator
            'model' => $cuttingUP['model'],
            'content' => $cuttingUP['content'],
        ]);

        return redirect()->back()->with('success', 'CuttingUP created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(CuttingUP $CuttingUP)
    {
        return view('CuttingUP.show', compact('CuttingUP')); // Return view to show a specific CuttingUP
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CuttingUP $CuttingUP)
    {
        // dd($CuttingUP);
        return view('CuttingUP.edit', compact('CuttingUP'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CuttingUP $CuttingUP)
    {
        $request->validate([
            'company' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'content' => 'required|string',
        ]);

        // Update the CuttingUP instance
        $CuttingUP->update($request->all());

        return redirect()->route('CuttingUP.index')->with('success', 'CuttingUP updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CuttingUP $CuttingUP)
    {
        $CuttingUP->delete(); // Delete the CuttingUP instance
        return redirect()->route('CuttingUP.index')->with('success', 'CuttingUP deleted successfully.');
    }
}

