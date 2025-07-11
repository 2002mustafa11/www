<!-- resources/views/technicians/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Technician</h1>
    <form action="{{ route('technicians.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="type">specialty </label>
            <select name="specialty" class="form-control" id="specialty" required>
                <option value="vendor">بائع</option>
                <option value="technician">فاني </option>
                <option value="Both">فاني و بائع</option>
            </select>
        </div>
         {{-- <div class="form-group">
            <label for="specialty">specialty</label>
            <input type="text" name="specialty" id="specialty" class="form-control" required>
        </div> --}}
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection