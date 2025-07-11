<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title>Document</title>
</head>
<body>
@include('../Navigation')
    <form action="{{ route('accessory.update',['accessory'=>$accessory->id ]) }}" method="post" class="container mt-5" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="type">فئه </label>
            <select name="type" class="form-control" id="name" required >
                <option value="{{$accessory->type}}">{{$accessory->type}}</option>
                <option value="kafirs">جراب</option>
                <option value="screens">اسكرينه </option>
                <option value="other">other</option>
            </select>

        </div>
        <div class="form-group">
            <label for="device_type">نوع الجهاز</label>
            <input type="text" name="device_type" class="form-control" id="device_type" required value="{{$accessory->device_type}}">
        </div>


        <div class="form-group">
            <label for="name">نوع</label>
            <input type="text" name="name" class="form-control" id="name" required value="{{$accessory->name}}">
        </div>

        <div class="form-group">
            <label for="price">سعر</label>
            <input type="text" name="price" class="form-control" id="price" required value="{{$accessory->price}}">
        </div>

        <div class="form-group">
            <label for="stock">مخزون</label>
            <input type="text" name="stock" class="form-control" id="stock" required value="{{$accessory->stock}}">
        </div>
        
        <div>
            <label for="image">Accessory Image</label>
            <input type="file" name="image" id="image">
        </div>

        <button type="submit" class="btn btn-primary">إرسال</button>
    </form>


</body>
</html>
