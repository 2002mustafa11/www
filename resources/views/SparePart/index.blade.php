<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SparePart</title>

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
        <h2 class="mb-4">SparePart</h2>

        <a href="{{ route('receipts.create') }}" class="btn btn-primary mb-3">فورم لاستلام الاجهزة</a>
        <a href="{{ route('device_receipts.index.all',["all" => true]) }}" class="btn btn-primary mb-3">كول الاجهزة</a>
        <a href="{{ route('device_receipts.index') }}" class="btn btn-secondary mb-3">أجهزة اليوم</a>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <table id="sparePartsTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>id</th>
                    <th>اسم</th>
                    <th> عدد</th>
                    <th> سعر</th>
                    <th>وقت</th>
                </tr>
            </thead>
            <tbody>
                @foreach($spareParts as $receipt)
                    <tr>
                        <td>{{ $receipt->id }}</td>
                        <td>{{ $receipt->name }}</td>
                        <td>{{ $receipt->quantity }}</td>
                        <td>{{ $receipt->price }}</td>
                        <td>{{ date('d-m-Y h:i A', strtotime($receipt->created_at)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            $('#sparePartsTable').DataTable({
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
