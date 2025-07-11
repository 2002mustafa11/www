<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Device Receipt Form</title>

    <!-- إضافة Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
@include('../Navigation')
<div class="container mt-5">
    <h2 class="mb-4">Device Receipt Form</h2>

    <form action="{{ route('device_receipts.store') }}" method="POST">
    @csrf <!-- حماية ضد هجمات CSRF -->

    <!-- اسم العميل -->
    <div class="mb-3">
        <label for="name" class="form-label">اسم العميل:</label>
        <input tabindex="0" type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- رقم الهاتف -->
    <div class="mb-3">
        <label for="phone" class="form-label">Phone:</label>
        <input tabindex="1" type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" required>
        @error('phone')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- نوع الجهاز -->
    <div class="mb-3">
        <label for="device_type" class="form-label">نوع الجهاز :</label>
        <input tabindex="2" type="text" class="form-control" id="device_type" name="device_type" value="{{ old('device_type') }}" required>
        @error('device_type')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
    <label for="device_issue" class="form-label">مشكلة الجهاز:</label>
    <div class="form-check">
        <input tabindex="3" type="checkbox" class="form-check-input" id="issue1" name="device_issue[]" value="الشاشة مكسورة" {{ in_array('الشاشة مكسورة', old('device_issue', [])) ? 'checked' : '' }}>
        <label class="form-check-label" for="issue1">الشاشة مكسورة</label>
    </div>
    <div class="form-check">
        <input tabindex="3" type="checkbox" class="form-check-input" id="issue2" name="device_issue[]" value="الجهاز لا يعمل" {{ in_array('الجهاز لا يعمل', old('device_issue', [])) ? 'checked' : '' }}>
        <label class="form-check-label" for="issue2">الجهاز لا يعمل</label>
    </div>
    <div class="form-check">
        <input tabindex="3" type="checkbox" class="form-check-input" id="issue3" name="device_issue[]" value="السماعات لا تعمل" {{ in_array('السماعات لا تعمل', old('device_issue', [])) ? 'checked' : '' }}>
        <label class="form-check-label" for="issue3">السماعات لا تعمل</label>
    </div>
    <div class="form-check">
        <input tabindex="3" type="checkbox" class="form-check-input" id="issue4" name="device_issue[]" value="البرمجيات بحاجة لتحديث" {{ in_array('البرمجيات بحاجة لتحديث', old('device_issue', [])) ? 'checked' : '' }}>
        <label class="form-check-label" for="issue4">مشكلة شبكه</label>
    </div>
    <div class="form-check">
        <input tabindex="3" type="checkbox" class="form-check-input" id="issue4" name="device_issue[]" value="البرمجيات بحاجة لتحديث" {{ in_array('البرمجيات بحاجة لتحديث', old('device_issue', [])) ? 'checked' : '' }}>
        <label class="form-check-label" for="issue4">الباغه مكسورة</label>
    </div>
    <div class="form-check">
        <input tabindex="3" type="checkbox" class="form-check-input" id="issue4" name="device_issue[]" value="البرمجيات بحاجة لتحديث" {{ in_array('البرمجيات بحاجة لتحديث', old('device_issue', [])) ? 'checked' : '' }}>
        <label class="form-check-label" for="issue4">سوفت وير كامل</label>
    </div>
    <div class="form-check">
        <input tabindex="3" type="checkbox" class="form-check-input" id="issue4" name="device_issue[]" value="البرمجيات بحاجة لتحديث" {{ in_array('البرمجيات بحاجة لتحديث', old('device_issue', [])) ? 'checked' : '' }}>
        <label class="form-check-label" for="issue4">مشكلة شحن</label>
    </div>
    <div class="form-check">
        <input tabindex="3" type="checkbox" class="form-check-input" id="issue4" name="device_issue[]" value="البرمجيات بحاجة لتحديث" {{ in_array('البرمجيات بحاجة لتحديث', old('device_issue', [])) ? 'checked' : '' }}>
        <label class="form-check-label" for="issue4">مشكلة معالج</label>
    </div>
    @error('device_issue')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

  

    <!-- الملاحظات -->
    <div class="mb-3">
        <label for="notes" class="form-label">Notes (optional):</label>
        <textarea class="form-control" id="notes" name="notes">{{ old('notes') }}</textarea>
        @error('notes')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- اسم الموظف الذي استلم الجهاز -->
             <div class="mb-3">
                <label for="technician_id" class="form-label">البائع (الفني):</label>
                <select name="technician_id" id="technician_id" class="form-control" required>
                    <option value="">اختر الفني</option>
                    @foreach($technicians as $technician)
                        <option value="{{ $technician->id }}">{{ $technician->name }}</option>
                    @endforeach
                </select>
            </div>

    <!-- موعد التسليم -->
    <div class="mb-3">
        <label for="delivery_date" class="form-label">تاريخ التسليم:</label>
        <input tabindex="6" type="date" class="form-control" id="delivery_date" name="delivery_date" value="{{ old('delivery_date') }}">
        @error('delivery_date')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    {{-- <!-- رقم الصندوق -->
    <div class="mb-3">
        <label for="box_number" class="form-label">رقم الصندوق:</label>
        <input tabindex="5" type="text" class="form-control" id="box_number" name="box_number" value="{{ old('box_number') }}"/>
        @error('box_number')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div> --}}

    <!-- التكلفة -->
    <div class="mb-3">
        <label for="cost" class="form-label">التكلفة:</label>
        <input tabindex="7" type="number" class="form-control" id="cost" name="cost" value="{{ old('cost') }}" required>
        @error('cost')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- رقم التسلسل -->
    <div class="mb-3">
        <label for="serial_number" class="form-label">رقم التسلسل (SN):</label>
        <input tabindex="8" type="text" class="form-control" id="serial_number" name="serial_number" value="{{ old('serial_number') }}" required>
        @error('serial_number')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- رقم العميل -->
    <!-- <div class="mb-3">
        <label for="customer_id" class="form-label">رقم العميل:</label>
        <input tabindex="9" type="text" class="form-control" id="customer_id" name="customer_id" value="{{ old('customer_id') }}" required>
        @error('customer_id')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div> -->

    <!-- الحالة -->
    <!-- <div class="mb-3">
        <label for="status" class="form-label">الحالة:</label>
        <select tabindex="10" class="form-control" id="status" name="status" required>
            <option value="received" {{ old('status') == 'received' ? 'selected' : '' }}>استلام</option>
            <option value="in_process" {{ old('status') == 'in_process' ? 'selected' : '' }}>قيد المعالجة</option>
            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>مكتمل</option>
        </select>
        @error('status')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div> -->

    <!-- زر الإرسال -->
    <div class="d-grid gap-2">
        <button tabindex="11" type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

</div>

<!-- إضافة Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
