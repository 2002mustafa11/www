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
    <form action="{{ route('Shortage.store') }}" method="post" class="container mt-5">
        @csrf
        <div class="form-group">
            <label for="type">فئه </label>
            <select name="type" class="form-control" id="name" required>
                <option value="kafirs">جراب</option>
                <option value="screens">اسكرينه </option>
                <option value="other">other</option>
            </select>
            {{-- <input type="text" name="type" class="form-control" id="type" required> --}}
        </div>
        <div class="form-group">
            <label for="name">نوع الجهاز</label>
            <input type="text" name="name" class="form-control" id="name" required>
        </div>


        <div class="form-group">
            <label for="price">سعر</label>
            <input type="text" name="price" class="form-control" id="price" required>
        </div>


        <button type="submit" class="btn btn-primary">إرسال</button>
    </form>


</body>
</html>
