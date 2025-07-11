<!DOCTYPE html>
<html dir="rtl">
<head>
    <title>استلام الجهاز</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        * {
            font-family: 'DejaVu Sans', sans-serif !important;
            box-sizing: border-box;
        }
        body {
            font-size: 14px;
            padding: 20px;
            margin: 0;
            color: #555;
            text-align: right;
            background-color: #f8f9fa;
        }
        @page {
            size: A6;
            margin: 0;
        }
        .invoice-box {
            width: 100%;
            max-width: 600px; /* عرض مناسب */
            margin: 0 auto; /* توسيط الصفحة */
            border: 1px solid #ddd;
            padding: 20px;
            background-color: white;
        }
        .invoice-box h2, .invoice-box h1,  .invoice-box h3 {
            text-align: center;
            color: #333;
            margin: 0;
            line-height: 1.2;

        }
        .invoice-box p {
            margin:  0;
            font-size: 16px;
            line-height: 1.5;
        }
        .invoice-box p strong {
            color: #333;
            /* margin: 2px 0; */

        }
        .footer {
            text-align: center;
            margin: 0;
            color: #333;
        }
        .no-print {
            display: block;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            margin: 0;
        }
        .no-print:hover {
            background-color: #0056b3;
        }
        @media print {
            /* body {
                color: black;
                background-color: white;
            } */
            .no-print {
                display: none;
            }
            /* .invoice-box {
                border: none;
                padding: 10px;
            } */
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
</head>
<body>
    <div class="invoice-box">
        {{-- <img src="https://www.logoai.com/uploads/output/2025/03/03/43ec017c8de8a3a36a05c343a452378c.jpg" style="display: block; margin: 0 auto 10px; max-width: 100px;"> --}}
        <img src="{{ asset('logo/logo.png') }}" style="display: block; margin: 0 auto 10px; max-width: 100px;">


    <h1>لصيانه المحمول REZK </h1>
        <p><strong>اسم العميل:</strong> {{ $deviceReceipt->customer->name }}</p>
        <p><strong>رقم الهاتف:</strong> {{ $deviceReceipt->customer->phone }}</p>
        <p><strong>نوع الجهاز:</strong> {{ $deviceReceipt->device_type }}</p>
        <p> <strong>SN:</strong>{{ $deviceReceipt->SN }}</p>
        <p><strong>مشكلة الجهاز:</strong> {{ $deviceReceipt->device_issue }}</p>
        <p><strong>ملاحظات:</strong> {{ $deviceReceipt->notes }}</p>
        <p><strong>اسم الفني:</strong> {{ $deviceReceipt->employee_name }}</p>
        <p><strong>تاريخ الاستلام:</strong> {{ $deviceReceipt->created_at->format('Y-m-d') }}</p>
        <p><strong>تاريخ تسليم:</strong> {{ $deviceReceipt->delivery_date }}</p>
        <p><strong>سعر المتفق عليه:</strong> {{ $deviceReceipt->Cost }}</p>
        <p> امضاء العميل_____________</p>
        <p>المحل غير مسؤل عن ترك الاجهزه اكثر من شهر</P>
        <p>
            لا يوجد ضمان علي الشاشه
            بعد التجربه داخل المحل
        </p>
        <p>
            مواعيد العمل من 12:3 معادا الجمعه
        </p>
        <h3>03-4248092</h3>
        <h3>01094554809</h3>
    </div>

    <div class="footer">
        <button class="no-print" onclick="window.print();">طباعة</button>
        <a class="no-print" href="javascript:history.go(-1)">Go back</a>
    </div>

    <script>
        window.onafterprint = function() {
            window.location.href = '/device-receipts/1/1';  // هنا يمكنك تغيير '/' إلى الرابط الذي تريد إعادة التوجيه إليه
        };
    </script>
</body>
</html>
