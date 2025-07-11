<!DOCTYPE html>
<!-- lang="ar" dir="rtl" -->
<html >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AccessorySales</title>

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
    <div class="container mt-5">
        <h2 class="mb-4">مبيعات الملحقات</h2>
        <a href="{{ route('accessorySale.index', ['all' => true]) }}" class="btn btn-primary mb-3">كل الأجهزة</a>
        <a href="{{ route('accessorySale.index') }}" class="btn btn-secondary mb-3">أجهزة اليوم</a>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <!-- إضافة حقول بحث لكل عمود -->
        <div class="row mb-3">
<div class="row mb-3">
    <div class="col-md-3">
        <label for="technician" class="form-label">البائع:</label>
        <input type="text" id="technician" class="form-control" placeholder="ابحث بنوع الجهاز...">
    </div>
    <div class="col-md-3">
        <label for="searchDeviceType" class="form-label">بحث بنوع الجهاز:</label>
        <input type="text" id="searchDeviceType" class="form-control" placeholder="ابحث بنوع الجهاز...">
    </div>
    <div class="col-md-2">
        <label for="searchPrice" class="form-label">بحث بالسعر:</label>
        <input type="text" id="searchPrice" class="form-control" placeholder="ابحث بالسعر...">
    </div>
    <div class="col-md-2">
        <label for="searchQuantity" class="form-label">بحث بالعدد:</label>
        <input type="text" id="searchQuantity" class="form-control" placeholder="ابحث بالعدد...">
    </div>
    <div class="col-md-2">
        <label for="fromDate" class="form-label">من:</label>
        <input type="date" id="fromDate" class="form-control">
    </div>
    <div class="col-md-2">
        <label for="toDate" class="form-label">إلى:</label>
        <input type="date" id="toDate" class="form-control">
    </div>
</div>
        </div>

        <table id="AccessorySalesTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>البائع</th>
                    <th>نوع الجهاز</th>
                    <th>سعر</th>
                    <th>عدد</th>
                    <th>حذف</th>
                    <th>وقت</th>
                </tr>
            </thead>
            <tbody>
                @foreach($AccessorySales as $receipt)
                
                <tr class="{{ $receipt->total_price == 0 ? 'text-danger' : 'text-dark' }}">
                        <td>{{ $receipt->id }}</td>
                        <td>
                            @if(isset($receipt->technician->name))
                                {{ $receipt->technician->name }}
                            @endif

                        </td>
                        <td>{{ $receipt->accessory->name }} {{ $receipt->accessory->device_type }}</td>
                        <td>{{ $receipt->total_price }}</td>
                        <td>{{ $receipt->quantity }}</td>
                        <td>
                            <form action="{{ route('accessorySale.destroy', $receipt->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">حذف</button>
                            </form>
                        </td>
                        <td>{{ date('Y-m-d', strtotime($receipt->created_at)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
 $(document).ready(function() {
    var table = $('#AccessorySalesTable').DataTable({
        "paging": true, // تمكين الصفحات
        "searching": true, // تمكين البحث
        "ordering": true, // تمكين الترتيب
        "info": true, // عرض المعلومات الإضافية عن البيانات
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/ar.json" // تغيير لغة الجدول للعربية
        }
    });
  $('#technician').on('keyup', function() {
        table.columns(0).search(this.value).draw(); 
    });
    // ربط حقول البحث بالأعمدة
    $('#searchDeviceType').on('keyup', function() {
        table.columns(1).search(this.value).draw(); // البحث في العمود الأول (نوع الجهاز)
    });

    $('#searchPrice').on('keyup', function() {
        table.columns(2).search(this.value).draw(); // البحث في العمود الثاني (السعر)
    });

    $('#searchQuantity').on('keyup', function() {
        table.columns(3).search(this.value).draw(); // البحث في العمود الثالث (العدد)
    });

    // فلتر البحث بالتاريخ "من" و"إلى"
    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
        var fromDate = $('#fromDate').val();
        var toDate = $('#toDate').val();
        var rowDate = data[4]; // العمود الرابع (الوقت)

        if (fromDate === '' && toDate === '') {
            return true; // إذا لم يتم تحديد تاريخ، يتم عرض جميع الصفوف
        }

        if (fromDate === '' && rowDate <= toDate) {
            return true; // إذا تم تحديد "إلى" فقط
        }

        if (toDate === '' && rowDate >= fromDate) {
            return true; // إذا تم تحديد "من" فقط
        }

        if (rowDate >= fromDate && rowDate <= toDate) {
            return true; // إذا تم تحديد "من" و"إلى"
        }

        return false; // إخفاء الصف إذا لم يكن ضمن النطاق
    });

    // تطبيق الفلتر عند تغيير التواريخ
    $('#fromDate, #toDate').on('change', function() {
        table.draw(); // إعادة رسم الجدول مع تطبيق الفلتر
    });
});
    </script>
</body>
</html>