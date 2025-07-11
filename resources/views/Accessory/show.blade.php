@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow-lg p-4" style="width: 400px;">
        <h4 class="text-center mb-4">بيع الإكسسوارات</h4>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- بيانات الإكسسوار -->
        <div class="text-center mb-3">
            <h5 class="mt-2">{{ $accessory->name }}</h5>
            <p class="text-muted">السعر: <strong>${{ $accessory->price }}</strong></p>
            <p class="text-muted">المتوفر: <strong>{{ $accessory->stock }}</strong> قطعة</p>
        </div>

        <form action="{{ route('accessorySale.store') }}" method="POST">
            @csrf
            <input type="hidden" name="accessory_id" value="{{ $accessory->id }}" required>
            <div class="mb-3">
            <input class="form-control" type="number" name="total_price" value="{{ $accessory->price }}" required>
            </div>
            <div class="mb-3">
                                    <label for="quantity-{{ $accessory->id }}" class="form-label">عدد:</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        id="quantity-{{ $accessory->id }}"
                                        name="quantity"
                                        value="1"
                                        required
                                        min="1"
                                    >
                                    @error('quantity')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
            </div>
            <div class="mb-3">
                <label for="technician_id" class="form-label">البائع (الفني):</label>
                <select name="technician_id" id="technician_id" class="form-control" required>
                    <option value="">اختر الفني</option>
                    @foreach($technicians as $technician)
                        <option value="{{ $technician->id }}">{{ $technician->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">إتمام البيع</button>
        </form>
    </div>
</div>
@endsection
