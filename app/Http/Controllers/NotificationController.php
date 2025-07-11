<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\DeviceReceipt;

class NotificationController extends Controller
{
    public function index()
{
    // dd('');
    $user = User::find(1); // الحصول على المستخدم (يمكنك تغييره حسب الحاجة)

    $notifications = $user->notifications;

    // إرجاع عدد التنبيهات بالإضافة إلى البيانات
    return response()->json([
        'count' => $notifications->count(),
        'notifications' => $notifications
    ]);
}

    public function ReviewDeliveryDate()
{
    $user = User::find(1);

    $deviceReceipts = DeviceReceipt::where('status', 'pending')
        ->where('delivery_date', '<', now())
        ->with('customer')
        ->get();

    foreach ($deviceReceipts as $deviceReceipt) {
        // تحقق من وجود التنبيه باستخدام device_receipt_id كمفتاح فريد
        $existingNotification = $user->notifications()
            ->where('data->device_receipt_id', $deviceReceipt->id) // تحقق من وجود التنبيه بناءً على الـ ID الخاص بالجهاز
            ->first();

        if (!$existingNotification) {
            // إذا لم يكن التنبيه موجودًا، أرسل التنبيه
            $user->notify(new \App\Notifications\Deliverydate($deviceReceipt));
        }
    }

    return response()->json($deviceReceipts);
}


    
}
