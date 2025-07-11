<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض البيانات</title>

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
    @include('Navigation') <!-- أضف ملف التنقل الخاص بك -->

    <div class="container mt-5">
        <h2 class="mb-4">عرض البيانات</h2>
        <a href="{{ route('money.create') }}" class="btn btn-primary mb-3">إضافة سجل جديد</a>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <table id="moneyTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>المبلغ</th>
                    <th>الملاحظات</th>
                    <th>الوقت</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($monies as $money)
                    <tr>
                        <td>{{ $money->name }}</td>
                        <td>{{ $money->money }}</td>
                        <td>{{ $money->notes }}</td>
                        <td>{{ $money->created_at->format('d-m-Y h:i A') }}</td>
                        <td>
                            <a href="{{ route('money.edit', $money->id) }}" class="btn btn-warning btn-sm">تعديل</a>
                            <form action="{{ route('money.destroy', $money->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            $('#moneyTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/ar.json"
                }
            });
        });
    </script>
</body>
</html>
