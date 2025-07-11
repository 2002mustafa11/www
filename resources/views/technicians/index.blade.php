
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>technician</title>

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
    <!-- resources/views/technicians/index.blade.php -->

{{-- @extends('layouts.app') --}}

{{-- @section('content') --}}
<div class="container">
    <h1>Technicians</h1>
    <a href="{{ route('technicians.create') }}" class="btn btn-primary mb-3">Create New Technician</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($technicians as $technician)
                <tr>
                    <td>{{ $technician->id }}</td>
                    <td>{{ $technician->name }}</td>
                    <td>{{ $technician->phone }}</td>
                    <td>
                        <a href="{{ route('technicians.show', $technician->id) }}" class="btn btn-info">Show</a>
                        <a href="{{ route('technicians.edit', $technician->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('technicians.destroy', $technician->id) }}" method="POST" style="display:inline;">
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
{{-- @endsection --}}
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
