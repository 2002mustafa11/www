<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إيصالات الأجهزة</title>

    <!-- إضافة Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- إضافة DataTables CSS مع Bootstrap -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    <!-- إضافة DataTables Buttons CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap5.min.css">

    <!-- إضافة jQuery و DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <!-- إضافة DataTables Buttons JS -->
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

    <!-- إضافة Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
    @include('../Navigation')

    <div class="container mt-5">
        <h2 class="mb-4">إيصالات الأجهزة</h2>

        <a href="{{ route('receipts.create') }}" class="btn btn-primary mb-3">فورم لاستلام الأجهزة</a>
        <a href="{{ route('device_receipts.rejected.all', ["all" => true]) }}" class="btn btn-primary mb-3">كل الأجهزة</a>
        <a href="{{ route('device_receipts.rejected') }}" class="btn btn-secondary mb-3">أجهزة اليوم</a>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <table id="deviceReceiptsTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>رقم</th>
                    <th>نوع الجهاز</th>
                    <th>مشكلة الجهاز</th>
                    <th>اسم العميل</th>
                    <th>اسم المستلم</th>
                    <th>الملاحظات</th>
                    <th>الإجراء</th>
                    <th>التاريخ</th>
                    <th>الحالة</th>
                    <th>الطباعة</th>
                    <th>الحذف</th>
                </tr>
            </thead>
            <tbody>
    @foreach($deviceReceipts as $receipt)
        <tr>
            <td>{{ $receipt->id }}</td>
            <td>{{ $receipt->device_type }}</td>
            <td>{{ $receipt->device_issue }}</td>
            <td>{{ $receipt->customer->name }}<br>{{ $receipt->customer->phone }}</td>
            <td>{{ $receipt->employee_name }}</td>
            <td>{{ $receipt->notes }}</td>
            <td>
                <a href="{{ route('delivery.create', ['customer_id' => $receipt->customer->id, 'device_receipt_id' => $receipt->id, 'status' => 'completed']) }}" class="btn btn-success btn-sm">تسليم</a>
                <!-- <a href="{{ route('delivery.create', ['customer_id' => $receipt->customer->id, 'device_receipt_id' => $receipt->id, 'status' => 'rejected']) }}" class="btn btn-danger btn-sm">رفض</a> -->
                <a href="{{ route('device_receipts.edit', $receipt->id) }}" class="btn btn-primary btn-sm">تعديل</a>
            </td>
            <td>{{ date('d-m-Y h:i A', strtotime($receipt->created_at)) }}</td>
            <td>
                <!-- عرض الحالة الحالية -->
                <span class="badge bg-{{ $receipt->status == 'completed' ? 'success' : ($receipt->status == 'rejected' ? 'danger' : 'warning') }}">
                    {{ $receipt->status == 'completed' ? 'مكتملة' : ($receipt->status == 'rejected' ? 'مرفوضة' : 'قيد الانتظار') }}
                </span>

                <!-- نموذج لتغيير الحالة -->
                <form action="{{ route('device_receipts.updateStatus', $receipt->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PUT')
                    <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="pending" {{ $receipt->status == 'pending' ? 'selected' : '' }}>قيد الانتظار</option>
                        <option value="completed" {{ $receipt->status == 'completed' ? 'selected' : '' }}>مكتملة</option>
                        <option value="rejected" {{ $receipt->status == 'rejected' ? 'selected' : '' }}>مرفوضة</option>
                    </select>
                </form>
            </td>
            <td>
                <a href="{{ route('receipts.viewPDF', ['deviceReceipt' => $receipt->id]) }}" class="btn btn-success btn-sm">عرض</a>
            </td>
            <td>
                <form action="{{ route('device_receipts.destroy', $receipt->id) }}" method="POST" >
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-danger" value="حذف">
                </form>
            </td>
        </tr>
    @endforeach
</tbody>

        </table>
    </div>

    <script>
        $(document).ready(function() {
            $('#deviceReceiptsTable').DataTable({
                "paging": true, // تمكين الصفحات
                "searching": true, // تمكين البحث
                "ordering": true, // تمكين الترتيب
                "info": true, // عرض المعلومات الإضافية عن البيانات
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/ar.json" // لتغيير لغة الجدول للعربية
                },
                "dom": 'Bfrtip', // إضافة أزرار التصدير
                "buttons": [
                    {
                        extend: 'excel',
                        text: 'تصدير إلى Excel'
                    },
                    {
                        extend: 'pdf',
                        text: 'تصدير إلى PDF'
                    },
                    {
                        extend: 'print',
                        text: 'طباعة الجدول'
                    }
                ]
            });
        });
    </script>

</body>
</html>
