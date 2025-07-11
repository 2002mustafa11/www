<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Device Delivery</title>

    <!-- إضافة Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- إضافة DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    <!-- إضافة jQuery و DataTables.js -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <!-- إضافة Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <!-- Navigation Bar -->
    @include('../Navigation')

    <div class="container mt-5">
        <h2 class="mb-4">Device Delivery</h2>
        <a href="{{ route('delivery',["all" => true]) }}" class="btn btn-primary mb-3">كل الاجهزة</a>
        <a href="{{ route('delivery') }}" class="btn btn-secondary mb-3">أجهزة اليوم</a>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <table id="deviceDeliverysTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>نوع الجهاز</th>
                    <th>اسم العميل</th>
                    <th>فني صياني</th>
                    <th>وقت</th>
                    <th>تكلفه</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($deviceDelivery as $receipt)
                    <tr>
                    <td>{{ $receipt->id }}</td>

                        <td style="color: {{ $receipt->status == 'rejected' ? 'red' : 'black' }};">
                            {{ $receipt->device_receipt->device_type }}</td>
                        <td style="color: {{ $receipt->status == 'rejected' ? 'red' : 'black' }};">
                            {{ $receipt->customer->name }}<br>
                            {{ $receipt->customer->phone }}
                        </td>
                        <td>
                        @if(isset($receipt->technician->name))
                                {{ $receipt->technician->name }}
                            @endif
                        </td>
                        <td>{{ date('d-m-Y h:i A', strtotime($receipt->created_at)) }}</td>
                        <td>{{ $receipt->repair_cost }}</td>
                        <td style="color: {{ $receipt->status == 'rejected' ? 'red' : 'black' }};">
                            {{ $receipt->status }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            $('#deviceDeliverysTable').DataTable({
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
