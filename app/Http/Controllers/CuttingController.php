<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cutting;

class CuttingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cuttings = Cutting::all(); // Fetch all cuttings
        // dd($cuttings);
        return view('Cutting.index', compact('cuttings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Cutting.create'); // Return view for creating a new cutting
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'company' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Create a new Cutting instance
        Cutting::create($request->all());

        return redirect()->back()->with('success', 'Cutting created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cutting $cutting)
    {
        return view('Cutting.show', compact('cutting')); // Return view to show a specific cutting
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cutting $Cutting)
    {
        // dd($Cutting);
        return view('Cutting.edit', compact('Cutting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cutting $Cutting)
    {
        // Validate the request data
        // dd();
        $request->validate([
            'company' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);

        // Update the cutting instance
        $Cutting->update($request->all());

        return redirect()->route('Cutting.index')->with('success', 'Cutting updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cutting $cutting)
    {
        $cutting->delete(); // Delete the cutting instance
        return redirect()->route('Cutting.index')->with('success', 'Cutting deleted successfully.');
    }
}
