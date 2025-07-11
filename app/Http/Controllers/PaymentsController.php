<?php
namespace App\Http\Controllers;

use App\Models\Payment; // Make sure to import the Payment model
use App\Models\Supplier; // Import the Supplier model if needed
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function index(Request $request)
    {
        // Fetch all payments, optionally with pagination
        $payments = Payment::with('supplier')->paginate(10);
        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        // Get suppliers to pass to the create view
        $suppliers = Supplier::all();
        return view('payments.create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'payment' => 'required|numeric|min:0',
            'from' => 'required|string|max:255',
            'to' => 'required|string|max:255',
        ]);

        // Create the payment record
        $payment = Payment::create($request->all());

        // Decrement the supplier's debts
        Supplier::where('id', $request->supplier_id)->decrement('Debts', (int)$payment->payment);

        return redirect()->route('payments.index')->with('success', 'Payment created successfully.');
    }

    public function edit($id)
    {
        // Fetch the payment and suppliers for the edit form
        $payment = Payment::findOrFail($id);
        $suppliers = Supplier::all();
        return view('payments.edit', compact('payment', 'suppliers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'payment' => 'required|numeric|min:0',
            'from' => 'required|string|max:255',
            'to' => 'required|string|max:255',
        ]);

        $payment = Payment::findOrFail($id);
        $payment->update($request->all());

        return redirect()->route('payments.index')->with('success', 'Payment updated successfully.');
    }

    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        Supplier::where('id', $payment->supplier_id)->increment('Debts', (int)$payment->payment);
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'Payment deleted successfully.');
    }
}
