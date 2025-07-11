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
<div class="container">
    <h1 class="mb-4">Payments</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('payments.create') }}" class="btn btn-primary mb-3">Add Payment</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>id</th>
                <th>Supplier</th>
                <th>contact_info</th>
                <th>Debts</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suppliers as $supplier)
                <tr>
                    <td>{{ $supplier->id }}</td>
                    <td>{{ $supplier->name }}</td>
                    <td>{{ $supplier->contact_info }}</td>
                    <td>{{ $supplier->Debts }}</td>
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
