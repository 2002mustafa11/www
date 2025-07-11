<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <title>فاتورة</title>
    <style>
        body {
            font-family: 'Cairo', sans-serif; /* استخدام خط "Cairo" */
            direction: rtl; /* لجعل النص يظهر من اليمين لليسار */
            margin: 20px; /* إضافة بعض الهوامش */
        }
    </style>
</head>
<body>
    <h1>فاتورة جهاز</h1>
    <p>نوع الجهاز: {{ $deviceReceipt->device_type }}</p>
    <p>مشكلة الجهاز: {{ $deviceReceipt->device_issue }}</p>
    <p>اسم العميل: {{ $deviceReceipt->customer->name }}</p>
    <p>رقم الهاتف: {{ $deviceReceipt->customer->phone }}</p>
    <p>ملاحظات: {{ $deviceReceipt->notes }}</p>
    <p>اسم الموظف: {{ $deviceReceipt->employee_name }}</p>
    <p>تاريخ الإنشاء: {{ $deviceReceipt->created_at->format('d-m-Y H:i') }}</p>
    <script>
        $(document).ready(function() {
            $('#accessorysTable').DataTable({
                // الإعدادات الأخرى
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/ar.json" // لتحميل النصوص باللغة العربية
                }
            });
        });
        </script>

</body>
</html>
