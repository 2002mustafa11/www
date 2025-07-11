<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cutting</title>

    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Add DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    <!-- Add jQuery and DataTables.js -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <!-- Add Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    @include('../Navigation')
    <div class="container mt-5">
        <h2 class="mb-4">Cutting</h2>
         <a href="{{ route('Cutting.create') }}" class="btn btn-secondary mb-3">اضافة</a>
        {{--<a href="{{ route('accessorys',["type" => 'kafirs']) }}" class="btn btn-secondary mb-3">جرابات</a>
        <a href="{{ route('accessorys',["type" => 'screens']) }}" class="btn btn-secondary mb-3">اسكيرنات</a>
        <a href="{{ route('accessorys',["type" => 'other']) }}" class="btn btn-secondary mb-3">أخرى</a>--}}

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <table id="CuttingsTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>id</th>
                    <th>الشركة</th> <!-- Column for company -->
                    <th>الموديل</th>  <!-- Column for model -->
                    <th>المحتوى</th>  <!-- Column for content -->
                    <th>حذف</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cuttings as $receipt)
                    <tr>
                        <td>
                            {{ $receipt->id }}
                        </td>
                        <td>
                            <a href="{{ route('Cutting.edit', ['Cutting' => $receipt->id]) }}" class="btn btn-secondary mb-3">edit</a>

                            {{ $receipt->company }}</td> <!-- Display company -->
                        <td>{{ $receipt->model }}</td>   <!-- Display model -->
                        <td>{{ $receipt->content }}</td> <!-- Display content -->
                        <td>
                            <form action="{{ route('Cutting.destroy', $receipt->id) }}" method="post" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">حذف</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <script>
        $(document).ready(function() {
            $('#CuttingsTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/ar.json"
                },
                "order": [[ 0, "desc" ]] // Order by the fourth column (وقت)
            });
        });
    </script>

</body>
</html>
