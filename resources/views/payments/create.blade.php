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
@include('../Navigation')
    <div class="container">
<form action="{{ route('payments.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="supplier_id" class="form-label">Supplier</label>
        <select name="supplier_id" id="supplier_id" class="form-select" required>
            <option value="" disabled selected>Select a supplier</option>
            @foreach ($suppliers as $supplier)
                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="payment" class="form-label">Payment</label>
        <input type="number" name="payment" id="payment" class="form-control" required min="0">
    </div>

    <div class="mb-3">
        <label for="from" class="form-label">From</label>
        <input type="text" name="from" id="from" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="to" class="form-label">To</label>
        <input type="text" name="to" id="to" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">Submit Payment</button>
</form>
    </div>
</body>
</html>
