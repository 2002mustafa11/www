<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title>Document</title>
</head>
<body>
@include('../Navigation')
    <form action="{{ route('purchases.store') }}" method="post" class="container mt-5">
        @csrf
        <div class="form-group">
            <label for="buyer_name">نوع قطع الغيار</label>
            <input type="text" name="spare_parts_type" class="form-control" id="buyer_name" required>
        </div>

        <div class="form-group">
            <label for="buyer_name">اسم المشتري</label>
            <input type="text" name="buyer_name" class="form-control" id="buyer_name" required>
        </div>

        <div class="form-group">
            <label for="seller_name">اسم البائع</label>
            <input type="text" name="seller_name" class="form-control" id="seller_name" required>
        </div>

        <div class="form-group">
            <label for="supplier_id">المورد</label>
            <select name="supplier_id" class="form-control" id="supplier_id" required>
                <option value="1">معتز</option>
                <option value="2">حفظي</option>
            </select>
        </div>

        <div class="form-group">
            <label for="total_price"> السعر</label>
            <input type="text" name="total_price" class="form-control" id="total_price" required>
        </div>

        <div class="form-group">
            <label for="quantity">الكمية</label>
            <input type="text" name="quantity" class="form-control" id="quantity" required>
        </div>

        <button type="submit" class="btn btn-primary">إرسال</button>
    </form>

</body>
</html>
