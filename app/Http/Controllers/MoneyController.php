<?php

namespace App\Http\Controllers;

use App\Models\Money;
use Illuminate\Http\Request;

class MoneyController extends Controller
{
    // عرض جميع البيانات 
    public function index()
    {
        $monies = Money::all();
        return view('money.index', compact('monies'));
    }

    // عرض النموذج لإضافة بيانات جديدة
    public function create()
    {
        return view('money.create');
    }

    // حفظ البيانات الجديدة في قاعدة البيانات
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'money' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        Money::create([
            'name' => $request->name,
            'money' => $request->money,
            'notes' => $request->notes,
        ]);

        return redirect()->route('money.index')->with('success', 'تم إضافة البيانات بنجاح');
    }

    // عرض نموذج تعديل البيانات
    public function edit($id)
    {
        $money = Money::findOrFail($id);
        return view('money.edit', compact('money'));
    }

    // تحديث البيانات في قاعدة البيانات
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'money' => 'required|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $money = Money::findOrFail($id);
        $money->update([
            'name' => $request->name,
            'money' => $request->money,
            'notes' => $request->notes,
        ]);

        return redirect()->route('money.index')->with('success', 'تم تحديث البيانات بنجاح');
    }

    // حذف البيانات من قاعدة البيانات
    public function destroy($id)
    {
        $money = Money::findOrFail($id);
        $money->delete();

        return redirect()->route('money.index')->with('success', 'تم حذف البيانات بنجاح');
    }
}
