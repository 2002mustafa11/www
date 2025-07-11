<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل السجل</title>

    <!-- إضافة Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- إضافة jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- إضافة Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    @include('Navigation')

    <div class="container mt-5">
        <h2 class="mb-4">تعديل السجل</h2>

        <form action="{{ route('money.update', $money->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">الاسم</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $money->name }}" required>
            </div>

            <div class="mb-3">
                <label for="money" class="form-label">المبلغ</label>
                <input type="text" class="form-control" id="money" name="money" value="{{ $money->money }}" required>
            </div>

            <div class="mb-3">
                <label for="notes" class="form-label">الملاحظات</label>
                <textarea class="form-control" id="notes" name="notes">{{ $money->notes }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">تحديث</button>
            <a href="{{ route('money.index') }}" class="btn btn-secondary">إلغاء</a>
        </form>
    </div>
</body>
</html>
