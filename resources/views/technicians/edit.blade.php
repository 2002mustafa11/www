<!-- resources/views/technicians/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Technician</h1>
    <form action="{{ route('technicians.update', $technician->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $technician->name }}" required>
        </div>
                <div class="form-group">
            <label for="type">specialty </label>
            <select name="specialty" class="form-control" id="specialty" required>
                <option value="vendor">بائع</option>
                <option value="technician">فاني </option>
                <option value="Both">فاني و بائع</option>
            </select>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ $technician->phone }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection