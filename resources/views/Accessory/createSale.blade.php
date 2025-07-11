<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accessory Sale</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@include('../Navigation')
<div class="container mt-5">
    <h2 class="mb-4">Accessory Sale</h2>

    <form action="{{ route('accessorySale.store') }}" method="POST">
        @csrf <!-- CSRF protection -->

        <div class="form-group">
            <label for="accessory_id">Accessory</label>
            <select name="accessory_id" class="form-control" id="accessory_id" required>
                @foreach($accessorys as $receipt)
                    <option value="{{ $receipt->id }}" data-price="{{ $receipt->price }}">{{ $receipt->name }} ({{$receipt->price}})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity:</label>
            <input tabindex="0" type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity') }}" required>
            @error('quantity')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="total_price" class="form-label">Total Price:</label>
            <input type="text" class="form-control" id="total_price" name="total_price" value="{{ old('total_price') }}" readonly>
        </div>

        <div class="d-grid gap-2">
            <button tabindex="5" type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const accessorySelect = document.getElementById('accessory_id');
    const quantityInput = document.getElementById('quantity');
    const totalPriceInput = document.getElementById('total_price');

    function calculateTotalPrice() {
        const selectedOption = accessorySelect.options[accessorySelect.selectedIndex];
        const price = parseFloat(selectedOption.getAttribute('data-price')) || 0;
        const quantity = parseInt(quantityInput.value) || 0;
        const totalPrice = price * quantity;
        totalPriceInput.value = totalPrice.toFixed(2);
    }

    accessorySelect.addEventListener('change', calculateTotalPrice);
    quantityInput.addEventListener('input', calculateTotalPrice);
</script>

</body>
</html>
