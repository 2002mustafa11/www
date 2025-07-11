<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeviceReceipt;

class PrintController extends Controller
{
    /**
     * طباعة الإيصال (نص فقط)
     */
    public function printDeviceReceipt($id)
    {
        try {
            // الحصول على بيانات الإيصال
            $deviceReceipt = DeviceReceipt::findOrFail($id);

            // تحديد النص الذي سيتم طباعته
            $receiptText = "شركة الصيانة\n";
            $receiptText .= "--------------------\n";
            $receiptText .= "اسم العميل: " . $deviceReceipt->customer->name . "\n";
            $receiptText .= "رقم الهاتف: " . $deviceReceipt->customer->phone . "\n";
            $receiptText .= "نوع الجهاز: " . $deviceReceipt->device_type . "\n";
            $receiptText .= "المشكلة: " . $deviceReceipt->device_issue . "\n";
            $receiptText .= "الموظف: " . $deviceReceipt->employee_name . "\n";
            $receiptText .= "--------------------\n";
            $receiptText .= "شكراً لاستخدامكم خدماتنا\n";

            // حفظ النص إلى ملف مؤقت
            $filePath = storage_path("app/receipts/receipt_$id.txt");
            file_put_contents($filePath, $receiptText);

            // اسم الطابعة المتصلة (تأكد من تطابق الاسم مع الطابعة في Windows)
            $printerName = "XP80C"; // أو اسم الطابعة الفعلي على جهازك

            // استخدام الأمر `print` في سطر الأوامر للطباعة
            $command = "print /D:\"$printerName\" \"$filePath\"";

            // تنفيذ الأمر عبر SHELL
            exec($command, $output, $resultCode);

            // التحقق من النتيجة
            if ($resultCode === 0) {
                return response()->json(['success' => true, 'message' => 'تمت الطباعة بنجاح!']);
            } else {
                return response()->json(['success' => false, 'message' => 'حدث خطأ أثناء الطباعة.']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'حدث خطأ: ' . $e->getMessage()]);
        }
    }
}
