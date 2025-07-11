<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- إضافة Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- إضافة DataTables CSS مع Bootstrap -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    <!-- إضافة jQuery و DataTables.js -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <!-- إضافة Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>عمليات الشراء</title>
</head>
<body>
    @include('../Navigation')
    <div class="container mt-5">
        <a href="{{ route('purchases.create') }}" class="btn btn-primary mb-3"> اضافه عمليات الشراء</a>
        <h2>قائمة عمليات الشراء</h2>
        <a href="{{ route('purchases.index',["all" => true]) }}" class="btn btn-primary mb-3">كل قطع الغيار</a>
        <a href="{{ route('purchases.index') }}" class="btn btn-secondary mb-3">قطع الغيار اليوم</a>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>نوع قطع الغيار</th>
                    <th>اسم المشتري</th>
                    <th>اسم البائع</th>
                    <th>المورد</th>
                    <th>الكمية</th>
                    <th>إجمالي السعر</th>
                    <th> ارجاع</th>
                    <th>تاريخ الشراء</th>
                    {{-- <th>إجراءات</th> --}}
                </tr>
            </thead>
            <tbody>
                @php $total_price = 0; @endphp
                @foreach($purchases as $purchase)
                    <tr class="{{ $purchase->return == 0 ? 'text-danger' : 'text-dark' }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $purchase->spare_parts_type }}</td>
                        <td>{{ $purchase->buyer_name }}</td>
                        <td>{{ $purchase->seller_name }}</td>
                        <td>{{ $purchase->supplier->name }}</td>
                        <td>{{ $purchase->quantity }}</td>
                        <td>{{ $purchase->total_price }}</td>
                        @php
                        if ( $purchase->return == 1){
                            $total_price += $purchase->total_price;
                        }
                        @endphp

                        <td>
                        @if ( $purchase->return == 1)
                            <form action="{{ route('purchase.update', ['purchase' => $purchase->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" class="form-control" id="return" name="return" value='0' required min="0">
                                <button type="submit" class="btn btn-primary">Return</button>
                            </form>
                        @endif
                        </td>
                        <td>{{ date('d-m-Y h:i A', strtotime($purchase->created_at)) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="6" class="text-right"><strong>Total Price:</strong></td>
                    <td colspan="2">{{ $total_price }}</td>
                </tr>
            </tbody>
        </table>
        {{-- <h3>{{$supplier[0]->name .'='. $supplier[0]->Debts}}</h3>
        <h3>{{$supplier[1]->name .'='. $supplier[1]->Debts}}</h3> --}}
    </div>

</body>
</html>
