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
    <h1 class="mb-4">Edit Device Receipt</h1>

    <form action="{{ route('device_receipts.update', $deviceReceipt->id) }}" method="POST">
        @csrf
        @method('PUT')


    <!-- اسم العميل -->
    <div class="mb-3">
        <label for="name" class="form-label">اسم العميل:</label>
        <input tabindex="0" type="text" class="form-control" id="name" name="name" value="{{ old('name', $deviceReceipt->customer->name) }}" required>
        <input type="hidden" class="form-control" id="id" name="id" value="{{ old('id', $deviceReceipt->customer->id) }}" required>
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <!-- رقم الهاتف -->
    <div class="mb-3">
        <label for="phone" class="form-label">Phone:</label>
        <input tabindex="1" type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $deviceReceipt->customer->phone) }}" required>
        @error('phone')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

        <!-- نوع الجهاز -->
        <div class="mb-3">
            <label for="device_type" class="form-label">Device Type</label>
            <input type="text" class="form-control" id="device_type" name="device_type" value="{{ old('device_type', $deviceReceipt->device_type) }}" required>
            @error('device_type')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- مشكلة الجهاز -->
        <div class="mb-3">
            <label for="device_issue" class="form-label">Device Issue</label>
            <input type="text" class="form-control" id="device_issue" name="device_issue" value="{{ old('device_issue', $deviceReceipt->device_issue) }}" required>
            @error('device_issue')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- الملاحظات -->
        <div class="mb-3">
            <label for="notes" class="form-label">Notes</label>
            <textarea class="form-control" id="notes" name="notes">{{ old('notes', $deviceReceipt->notes) }}</textarea>
            @error('notes')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- اسم الموظف الذي استلم الجهاز -->
        <div class="mb-3">
            <label for="employee_name" class="form-label">Employee Name</label>
            <input type="text" class="form-control" id="employee_name" name="employee_name" value="{{ old('employee_name', $deviceReceipt->employee_name) }}" required>
            @error('employee_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- موعد التسليم -->
        <div class="mb-3">
            <label for="delivery_date" class="form-label">Delivery Date</label>
            <input type="date" class="form-control" id="delivery_date" name="delivery_date" value="{{ old('delivery_date', $deviceReceipt->delivery_date) }}">
            @error('delivery_date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- رقم الصندوق (box_number) -->
        <div class="mb-3">
            <label for="box_number" class="form-label">Box Number</label>
            <input type="text" class="form-control" id="box_number" name="box_number" value="{{ old('box_number', $deviceReceipt->box_number) }}">
            @error('box_number')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- زر التحديث -->
        <button type="submit" class="btn btn-primary">Update</button>
    </form>

</div>

