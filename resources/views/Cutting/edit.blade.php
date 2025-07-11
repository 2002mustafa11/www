<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title>Edit Cutting</title>
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
        <h2>تعديل جهاز</h2>
        <form action="{{ route('Cutting.update',['Cutting' => $Cutting->id] ) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="company">الشركة</label>
                <input type="text" class="form-control" id="company" name="company" value="{{ old('company', $Cutting->company) }}" required>
                @error('company')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="model">الموديل</label>
                <input type="text" class="form-control" id="model" name="model" value="{{ old('model', $Cutting->model) }}" required>
                @error('model')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="content">المحتوى</label>
                <textarea class="form-control" id="content" name="content">{{ old('content', $Cutting->content) }}</textarea>
                @error('content')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">تحديث</button>
        </form>
    </div>
</body>
</html>
