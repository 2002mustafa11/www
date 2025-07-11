<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cards Layout</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            text-align: center;
            border-radius: 15px;
            transition: 0.3s;
            border: none;
        }

        .card:hover {
            background-color: #007bff;
            color: white;
            transform: scale(1.08);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .card i {
            font-size: 50px;
            margin-bottom: 15px;
            color: #007bff;
        }

        .card:hover i {
            color: white;
        }

        .card-title {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-text {
            color: #6c757d;
            margin-bottom: 20px;
        }

        .btn-primary {
            border-radius: 20px;
        }
    </style>
</head>
<body>
    @include('../Navigation')

    <div class="container mt-5">
        <h2 class="text-center mb-5">لوحة التحكم</h2>
        <div class="row g-4">
            <!-- Card 1 -->
            <div class="col-md-3">
                <div class="card p-4 shadow-sm">
                    <i class="bi bi-person-fill"></i>
                    <h5 class="card-title">استلام</h5>
                    <p class="card-text">عرض جميع العملاء وإدارتهم بسهولة.</p>
                    <a href="{{route('device_receipts.index')}}" class="btn btn-primary">عرض المزيد</a>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col-md-3">
                <div class="card p-4 shadow-sm">
                    <i class="bi bi-wallet2"></i>
                    <h5 class="card-title">تسليم</h5>
                    <p class="card-text">إدارة عمليات البيع ومتابعة الفواتير.</p>
                    <a href="{{route('delivery')}}" class="btn btn-primary">عرض المزيد</a>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col-md-3">
                <div class="card p-4 shadow-sm">
                    <i class="bi bi-cart-fill"></i>
                    <h5 class="card-title">العملاء</h5>
                    <p class="card-text">تتبع العملاء بسهولة وسرعة.</p>
                    {{-- <a href="{{route('customers.index')}}" class="btn btn-primary">عرض المزيد</a> --}}
                </div>
            </div>
            <!-- Card 4 -->
            <div class="col-md-3">
                <div class="card p-4 shadow-sm">
                    <i class="bi bi-receipt-cutoff"></i>
                    <h5 class="card-title">مواعيد التسليم</h5>
                    <p class="card-text">متابعة تواريخ تسليم الأجهزة.</p>
                    <a href="{{route('delivery_date')}}" class="btn btn-primary">عرض المزيد</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
