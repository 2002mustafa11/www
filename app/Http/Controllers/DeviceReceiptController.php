<?php

namespace App\Http\Controllers;

use App\Models\DeviceReceipt;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Technician;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
// use PDF;
class DeviceReceiptController extends Controller
{ 
    public function showDeliveryDate()
    {
        $deviceReceipts = DeviceReceipt::where('status', 'pending')
                        ->where('delivery_date', '<', now())
                        ->with(['customer:id,name,phone', 'technician:id,name'])
                        ->get();
        return view('device_receipts.delivery_date', compact('deviceReceipts'));
    }

    public function viewPDF(DeviceReceipt $deviceReceipt){
        return view('device_receipts.receipt', compact('deviceReceipt'));
    }
    /**
     * Display a listing of the resource (READ).
     */
    public function index(Request $request)
    {
        // $request->input('all', 0)
        $all =  $request->all;
        $status = $request->status;
    // dd($all , $status);
        $query = DeviceReceipt::with(['customer:id,name,phone', 'technician:id,name']);

        if ($all == 1 && $status) {
            $query->where('status', $status);
        } else {
            $query->whereDate('created_at', Carbon::today());
        }

        $deviceReceipts = $query->get();

        return view('device_receipts.index', compact('deviceReceipts'));
    }

    // public function index(Request $request)
    // {

    //     $all = $request->all;
    //     if ($all == 1) {
    //         $deviceReceipts = DeviceReceipt::where('status', $request->status)
    //         ->with(['customer:id,name,phone', 'technician:id,name'])
    //         ->get();
    //     } else {
    //         // dd( $all);
    //         $today = Carbon::today();
    //         $deviceReceipts = DeviceReceipt::whereDate('created_at', $today)
    //            ->with(['customer:id,name,phone', 'technician:id,name'])
    //            ->get();
    //     }

    //     return view('device_receipts.index', compact('deviceReceipts'));
    // }

    /**
     * Show the form for creating a new resource (CREATE FORM).
     */
    public function create()
    {
        $technicians = Technician::get();
        return view('device_receipts.create',compact('technicians'));
    }

    /**
     * Store a newly created resource in storage (CREATE).
     */
    public function store(Request $request)
{
    // إضافة validation لحقول البيانات
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:15',
        'device_type' => 'required|string|max:255',
        'device_issue' => 'required|array|max:255',
        'notes' => 'nullable|string',
        'technician_id' => 'required',
        'delivery_date' => 'nullable|date', // إضافة validation لتاريخ التسليم
        'box_number' => 'nullable|string|max:255', // إضافة validation ل box_number
        'cost' => 'required|numeric|min:0', // إضافة validation للتكلفة
        'serial_number' => 'required|string|max:255', // إضافة validation لرقم التسلسل
        // 'status' => 'required|string|in:received,in_process,completed', // إضافة validation للحالة
    ]);
// dd($validatedData);
    // البحث عن العميل باستخدام رقم الهاتف
    $customer = Customer::where('phone', $validatedData['phone'])->first();

    // إذا لم يكن العميل موجودًا، نقوم بإنشاء عميل جديد
    if (!$customer) {
        $customer = Customer::create([
            'name' => $validatedData['name'],
            'phone' => $validatedData['phone']
        ]);
    }

    // إنشاء سجل استلام الجهاز مع الحقول الجديدة
    $deviceReceipt = DeviceReceipt::create([
        'device_type' => $validatedData['device_type'],
        'device_issue' =>implode(', ',$validatedData['device_issue']) ,
        'customer_id' => $customer->id, // استخدام الـ id للعميل الموجود أو الجديد
        'notes' => $validatedData['notes'],
        'technician_id' => $validatedData['technician_id'],
        'delivery_date' => $validatedData['delivery_date'], // إضافة تاريخ التسليم
        'box_number' =>0, //  $validatedData['box_number']
        'Cost' => $validatedData['cost'], // إضافة التكلفة
        'SN' => $validatedData['serial_number'], // إضافة رقم التسلسل
        // 'status' => $validatedData['status'], // إضافة الحالة
    ]);

    // إعادة التوجيه إلى صفحة عرض PDF أو الصفحة المناسبة مع البيانات
    return redirect()->route('receipts.viewPDF', ['deviceReceipt' => $deviceReceipt->id]);

    // أو إعادة التوجيه مع رسالة نجاح
    // return redirect()->route('device_receipts.index')->with('success', 'تم إنشاء الجهاز والعميل بنجاح');
}




    /**
     * Display the specified resource (READ).
     */
    public function show(DeviceReceipt $deviceReceipt)
    {
        return view('device_receipts.show', compact('deviceReceipt'));
    }

    /**
     * Show the form for editing the specified resource (EDIT FORM).
     */
    public function edit($deviceReceipt)
    {
        $deviceReceipt = DeviceReceipt::with('customer:id,name,phone')->findOrFail($deviceReceipt);
        return view('device_receipts.edit', compact('deviceReceipt'));
    }
    public function updateStatus(Request $request, DeviceReceipt $deviceReceipt)
    {
        // التحقق من صلاحية الـ status المُرسل من الـ request
        $validatedData = $request->validate([
            'status' => 'required|in:pending,completed,rejected', // تحقق من أن القيمة إما pending أو completed أو rejected
        ]);

        // تحديث الـ status في قاعدة البيانات
        $deviceReceipt->update([
            'status' => $validatedData['status'], // تحديث الحالة بالـ status الجديد
        ]);

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->route('device_receipts.index')->with('success', 'تم تحديث حالة الجهاز بنجاح');
    }

    /**
     * Update the specified resource in storage (UPDATE).
     */
    public function update(Request $request, DeviceReceipt $deviceReceipt)
    {
        $validatedData = $request->validate([
            'device_type' => 'required|string|max:255',
            'device_issue' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'employee_name' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'id' => 'required|max:255',
            'delivery_date' => 'nullable|date', // إضافة validation لتاريخ التسليم
            'box_number' => 'nullable|string|max:255', // إضافة validation ل box_number
        ]);
        $customer = Customer::where('id', $validatedData['id'])->first();

        // إذا لم يكن العميل موجودًا، نقوم بإنشاء عميل جديد
        if ($customer) {
            // dd($customer);
            $customer->update([
                'name' => $validatedData['name'],
                'phone' => $validatedData['phone']
            ]);
        }
        // تحديث السجل في قاعدة البيانات مع box_number
        $deviceReceipt->update([
            'device_type' => $validatedData['device_type'],
            'device_issue' => $validatedData['device_issue'],
            'notes' => $validatedData['notes'],
            'employee_name' => $validatedData['employee_name'],
            'delivery_date' => $validatedData['delivery_date'], // إضافة تاريخ التسليم
            'box_number' => $validatedData['box_number'], // إضافة box_number
        ]);

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->route('device_receipts.index')->with('success', 'تم تحديث سجل الجهاز بنجاح');
    }




    /**
     * Remove the specified resource from storage (DELETE).
     */
    public function destroy(DeviceReceipt $deviceReceipt)
    {
        // dd($deviceReceipt);
        $deviceReceipt->delete();

        return redirect()->route('device_receipts.index')->with('success', 'DeviceReceipt deleted successfully');
    }
   }

