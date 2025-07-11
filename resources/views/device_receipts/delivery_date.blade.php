<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Device Receipts</title>

    <!-- إضافة Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- إضافة DataTables CSS مع Bootstrap -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    <!-- إضافة jQuery و DataTables.js -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <!-- إضافة Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
    @include('../Navigation')
    <div class="container mt-5">
        <h2 class="mb-4">Device Receipts</h2>

        {{-- <a href="{{ route('receipts.create') }}" class="btn btn-primary mb-3">فورم لاستلام الاجهزة</a>
        <a href="{{ route('device_receipts.index.all',["all" => true]) }}" class="btn btn-primary mb-3">كل الاجهزة</a>
        <a href="{{ route('device_receipts.index') }}" class="btn btn-secondary mb-3">أجهزة اليوم</a> --}}

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <table id="deviceReceiptsTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>id</th>
                    <th>نوع الجهاز</th>
                    <th>مشكلة الجهاز</th>
                    <th>اسم العميل</th>
                    <th>اسم المستلم</th>
                    <th>التكلفه المتوقعه</th>
                    <th>Action</th>
                    <th>وقت</th>
                    <th>حاله</th>
                    <th>حاله</th>
                    <th>delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($deviceReceipts as $receipt)
                    <tr>
                        <td>{{ $receipt->id }}</td>
                        <td>{{ $receipt->device_type }}</td>
                        <td>{{ $receipt->device_issue }}</td>
                        <td>
                            {{ $receipt->customer->name }}<br>
                            {{ $receipt->customer->phone }}
                        </td>
                        <td>{{ $receipt->employee_name }}</td>
                        <td>{{ $receipt->notes }}</td>
                        <td>
                            <a href="{{ route('delivery.create', ['customer_id' => $receipt->customer->id, 'device_receipt_id' => $receipt->id,'status' => 'completed']) }}" class="btn btn-success btn-sm">تسليم</a>
                            <a href="{{ route('delivery.create', ['customer_id' => $receipt->customer->id, 'device_receipt_id' => $receipt->id,'status' => 'rejected']) }}" class="btn btn-danger btn-sm">رفض</a>
                        </td>
                        <td>{{ date('d-m-Y h:i A', strtotime($receipt->created_at)) }}
                        </td>
                        <td>{{ $receipt->status }}</td>
                        <td>
                            {{-- <a href="{{ route('receipts.printReceipt', ['deviceReceipt' => $receipt->id]) }}" class="btn btn-success btn-sm">تحميل</a> --}}
                            <a href="{{ route('receipts.viewPDF', ['deviceReceipt' => $receipt->id]) }}" class="btn btn-success btn-sm">عرض</a>
                        </td>
                        <td>
                            {{-- <a href="{{ route('device_receipts.destroy', ['deviceReceipt' => $receipt->id]) }}" class="btn btn-danger btn-sm">delete</a> --}}
                            <form action="{{ route('device_receipts.destroy', $receipt->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
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
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/ar.json" // لتغيير لغة الجدول للعربية إذا لزم الأمر
                }
            });
        });
    </script>
</body>
</html>
