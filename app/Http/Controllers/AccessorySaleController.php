<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccessorySale;
use App\Models\Accessory;
use Carbon\Carbon;
use App\Notifications\toPhpDesktop;
use Illuminate\Support\Facades\Notification;

class AccessorySaleController extends Controller
{

    public function index(Request $request)
    {
        // dd('');
        $all = $request->all;
        if ($all == 1) {
            // $deviceReceipts = DeviceReceipt::where('status', 'pending')->with('customer')->get();
            $AccessorySales = AccessorySale::with('accessory','technician')->get();
        } else {
            $today = Carbon::today();
            $AccessorySales = AccessorySale::with('accessory','technician')->whereDate('created_at', $today)->get();
        }

        // dd($AccessorySales);
        return view('Accessory.indexSale',compact('AccessorySales'));
    }


    public function create()
    {
        $accessorys = Accessory::get();
        return view('Accessory.createSale',compact('accessorys'));

    }


    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'accessory_id' => 'required|exists:accessories,id',
            'technician_id' => 'required',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
        ]);
       $accessory = Accessory::find($validatedData['accessory_id']);
        if ($accessory->stock <= 0) {
            return redirect()->route('accessorys')->with('success', 'تم انتهاء المخزون');
        }else{
            AccessorySale::create([ 
                'accessory_id' => $validatedData['accessory_id'],
                'technician_id' => $validatedData['technician_id'],
                'quantity' => $validatedData['quantity'],
                'total_price' => $validatedData['quantity'] *  $validatedData['total_price'],
            ]);
            $accessory->stock -= $validatedData['quantity'];
            $accessory->save();
        }
        // $user = auth()->user(); // إذا كنت تستخدم المصادقة
    
        // // إرسال الإشعار للمستخدم
        // if ($user) {
        //     $user->notify(new toPhpDesktop($accessory));
        // }
        // return redirect()->back()->with('success', 'Accessory sale created successfully.'); 
        return redirect()->back()->with('success', 'تم بيع الملحق بنجاح.');
    }
    



    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


public function destroy(string $id)
{
    // Find the AccessorySale record by ID
    $accessorySale = AccessorySale::findOrFail($id);

    // Update the stock of the accessory
    $accessory = Accessory::findOrFail($accessorySale->accessory_id);
    $accessory->stock += $accessorySale->quantity; // Restoring the stock
    $accessory->save();

    // Delete the AccessorySale record
    $accessorySale->delete();

    return redirect()->route('accessorySale.index',['all'=>0])->with('success', 'Accessory sale deleted successfully and stock updated.');
}

}

?>


