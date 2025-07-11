
@extends('layouts.app')

@section('content')
<form action="{{ route('delivery.store') }}" method="post">
    @csrf
    @error('customer_id')
    <div class="text-danger">{{ $message }}</div>
    @enderror
    <input type="hidden" name="customer_id" value="{{ $request->customer_id }}">
    <input type="hidden" name="device_receipt_id" value="{{ $request->device_receipt_id }}">
    <input type="hidden" name="status" value="{{ $request->status }}">
    <input type="text" name="repair_cost" >
        <div class="mb-3">
                <label for="technician_id" class="form-label">البائع (الفني):</label>
                <select name="technician_id" id="technician_id" class="form-control" required>
                    <option value="">اختر الفني</option>
                    @foreach($technicians as $technician)
                        <option value="{{ $technician->id }}">{{ $technician->name }}</option>
                    @endforeach
                </select>
            </div>
    <input type="submit" value="submit">
</form>
@endsection
