@extends('layouts.app')

@section('title', 'تفاصيل الفني')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">بيانات الفني: {{ $technician->name }}</h1>

    <div class="mb-4">
        <button class="btn btn-outline-primary toggle-section" data-target="#deviceReceiptsSection">عرض إيصالات الأجهزة</button>
        <button class="btn btn-outline-secondary toggle-section" data-target="#deviceDeliverySection">عرض تسليم الأجهزة</button>
        <button class="btn btn-outline-success toggle-section" data-target="#accessorySalesSection">عرض مبيعات الملحقات</button>
    </div>

    <!-- إيصالات الأجهزة -->
    <div id="deviceReceiptsSection" style="display: none;">
        <h2 class="mb-3">إيصالات الأجهزة</h2>
        <div class="row mb-3">
            <div class="col-md-4">
                <input type="text" class="form-control filter-input" data-table="deviceReceiptsSection" placeholder="🔍 بحث عن الجهاز أو العميل...">
            </div>
            <div class="col-md-3">
                <input type="date" class="form-control filter-date-from" data-table="deviceReceiptsSection">
            </div>
            <div class="col-md-3">
                <input type="date" class="form-control filter-date-to" data-table="deviceReceiptsSection">
            </div>
        </div>
        <table class="table table-striped table-bordered">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>نوع الجهاز</th>
                    <th>مشكلة الجهاز</th>
                    <th>اسم العميل</th>
                    <th>ملاحظات</th>
                    <th>التاريخ</th>
                    <th>الحالة</th>
                </tr>
            </thead>
            <tbody>
                @foreach($technician->DeviceReceipt as $receipt)
                <tr>
                    <td>{{ $receipt->id }}</td>
                    <td>{{ $receipt->device_type }}</td>
                    <td>{{ $receipt->device_issue }}</td>
                    <td>{{ $receipt->customer->name }}<br>{{ $receipt->customer->phone }}</td>
                    <td>{{ $receipt->notes }}</td>
                    <td>{{ date('d-m-Y', strtotime($receipt->created_at)) }}</td>
                    <td>{{ $receipt->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- تسليم الأجهزة -->
    <div id="deviceDeliverySection" style="display: none;">
        <h2 class="mb-3">تسليم الأجهزة</h2>
        <div class="row mb-3">
            <div class="col-md-4">
                <input type="text" class="form-control filter-input" data-table="deviceDeliverySection" placeholder="🔍 بحث عن الجهاز أو العميل...">
            </div>
            <div class="col-md-3">
                <input type="date" class="form-control filter-date-from" data-table="deviceDeliverySection">
            </div>
            <div class="col-md-3">
                <input type="date" class="form-control filter-date-to" data-table="deviceDeliverySection">
            </div>
        </div>
        <table class="table table-striped table-bordered">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>نوع الجهاز</th>
                    <th>اسم العميل</th>
                    <th>وقت التسليم</th>
                    <th>تكلفة الإصلاح</th>
                    <th>الحالة</th>
                </tr>
            </thead>
            <tbody>
                @foreach($technician->deviceDelivery as $receipt)
                <tr>
                    <td>{{ $receipt->id }}</td>
                    <td>{{ $receipt->device_receipt->device_type ?? '-' }}</td>
                    <td>{{ $receipt->customer->name ?? '-' }}<br>{{ $receipt->customer->phone ?? '-' }}</td>
                    <td>{{ date('d-m-Y', strtotime($receipt->created_at)) }}</td>
                    <td>{{ $receipt->repair_cost }}</td>
                    <td>{{ $receipt->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- مبيعات الملحقات -->
    <div id="accessorySalesSection" style="display: none;">
        <h2 class="mb-3">مبيعات الملحقات</h2>
        <div class="row mb-3">
            <div class="col-md-4">
                <input type="text" class="form-control filter-input" data-table="accessorySalesSection" placeholder="🔍 بحث عن الملحق...">
            </div>
            <div class="col-md-3">
                <input type="date" class="form-control filter-date-from" data-table="accessorySalesSection">
            </div>
            <div class="col-md-3">
                <input type="date" class="form-control filter-date-to" data-table="accessorySalesSection">
            </div>
        </div>
        <table class="table table-striped table-bordered">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>الملحق</th>
                    <th>السعر الإجمالي</th>
                    <th>الكمية</th>
                    <th>التاريخ</th>
                </tr>
            </thead>
            <tbody>
                @foreach($technician->AccessorySale as $sale)
                <tr>
                    <td>{{ $sale->id }}</td>
                    <td>{{ $sale->accessory->name ?? '-' }} - {{ $sale->accessory->device_type ?? '-' }}</td>
                    <td>{{ $sale->total_price }}</td>
                    <td>{{ $sale->quantity }}</td>
                    <td>{{ date('Y-m-d', strtotime($sale->created_at)) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- سكريبت إظهار وإخفاء الجداول + البحث + الفلترة -->
<script>
document.querySelectorAll('.toggle-section').forEach(button => {
    button.addEventListener('click', function () {
        const target = document.querySelector(this.dataset.target);
        const allSections = ['#deviceReceiptsSection', '#deviceDeliverySection', '#accessorySalesSection'];
        allSections.forEach(id => {
            const section = document.querySelector(id);
            if (id === this.dataset.target) {
                section.style.display = section.style.display === 'none' ? 'block' : 'none';
            } else {
                section.style.display = 'none';
            }
        });
    });
});

// البحث بالنص
document.querySelectorAll('.filter-input').forEach(input => {
    input.addEventListener('input', function () {
        const sectionId = this.dataset.table;
        const table = document.querySelector(`#${sectionId} table`);
        const filter = this.value.toLowerCase();
        Array.from(table.tBodies[0].rows).forEach(row => {
            const text = row.innerText.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });
});

// فلترة التاريخ
function filterByDate() {
    document.querySelectorAll('table').forEach(table => {
        const sectionId = table.closest('div').id;
        const fromInput = document.querySelector(`.filter-date-from[data-table="${sectionId}"]`);
        const toInput = document.querySelector(`.filter-date-to[data-table="${sectionId}"]`);
        const fromDate = fromInput?.value ? new Date(fromInput.value) : null;
        const toDate = toInput?.value ? new Date(toInput.value) : null;
        Array.from(table.tBodies[0].rows).forEach(row => {
            const dateCell = row.cells[5] || row.cells[4] || row.cells[3]; // يعتمد حسب ترتيب الأعمدة
            const rowDate = dateCell ? new Date(dateCell.innerText) : null;
            if (!rowDate) return;
            let show = true;
            if (fromDate && rowDate < fromDate) show = false;
            if (toDate && rowDate > toDate) show = false;
            row.style.display = show ? '' : 'none';
        });
    });
}

document.querySelectorAll('.filter-date-from, .filter-date-to').forEach(input => {
    input.addEventListener('change', filterByDate);
});
</script>
@endsection
