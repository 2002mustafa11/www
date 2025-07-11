<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accessories</title>

    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Add DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    <!-- Add jQuery and DataTables.js -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <!-- Add Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    {{-- <style>
    #notification {
        display: none;
        position: fixed;
        top: 20px;
        right: 20px;
        background-color: #28a745;
        color: white;
        padding: 15px;
        border-radius: 5px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 9999;
        width: 250px;
    }
    #notification p {
        margin: 0;
        font-size: 14px;
    }
    #notification-message {
        font-weight: bold;
    }
</style> --}}

</head>
<body>
    @include('../Navigation')

    <div class="container mt-5">
        <h2 class="mb-4">Accessories</h2>

<a href="{{ route('accessorys.create') }}" class="btn btn-secondary mb-3">اضافة</a>

<a href="{{ route('accessorys', ['type' => 'kafirs']) }}" class="btn
    {{ $type == 'kafirs' ? 'btn-primary' : 'btn-secondary' }} mb-3">
    جرابات
</a>

<a href="{{ route('accessorys', ['type' => 'screens']) }}" class="btn
    {{ $type == 'screens' ? 'btn-primary' : 'btn-secondary' }} mb-3">
    اسكيرنات
</a>

<a href="{{ route('accessorys', ['type' => 'other']) }}" class="btn
    {{ $type == 'other' ? 'btn-primary' : 'btn-secondary' }} mb-3">
    أخرى
</a>

        <!-- Custom Search Field -->
        <div class="mb-3">
            <label for="customSearch" class="form-label">بحث مخصص:</label>
            <input type="text" id="customSearch" class="form-control" placeholder="ابحث هنا...">
        </div>
                <!-- إضافة حقل بحث بالتاريخ -->
        <!-- <div class="row mb-3">
            <div class="col-md-4">
                <label for="searchDate" class="form-label">بحث بالتاريخ:</label>
                <input type="date" id="searchDate" class="form-control">
            </div>
        </div> -->
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <table id="accessorysTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>id</th>
                    <th>image</th>
                    <th>نوع الجهاز</th>
                    <th>نوع الكسسوار </th>
                    <th>سعر</th>
                    <th>عدد مخزون</th>
                    <th>بيع</th>
                </tr>
            </thead>
            <tbody>
                @foreach($accessorys as $receipt)
                {{-- @dd() --}}
                    <tr>

                        <td>
                            {{ $receipt->id }}
                        </td>

                        <td>
                        @if($receipt->image)
                        <img src="{{ asset('storage/' . $receipt->image) }}" width="80" height="80" style="object-fit: cover;">

                        @endif
                        </td>

                        <td >
                            @auth()

                            <a href="{{ route('accessory.edit',["accessory" => $receipt->id]) }}" class="btn btn-secondary mb-3">edit</a>
                            @endauth

                            {{ $receipt->device_type }}
                        </td>
                        <td>{{ $receipt->name }}</td>
                        <td>{{ $receipt->price }}</td>
                        <td>
                            @if (auth()->check())
                                <form action="{{ route('accessory.updateStock', $receipt->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" class="form-control" id="stock" name="stock" value="{{ $receipt->stock }}" required min="0">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            @else
                                <span>{{ $receipt->stock }}</span>
                            @endif
                        </td>

                        <td>
                        <a href="{{ route('accessory.show', $receipt->id) }}" class="btn btn-info">Show</a>

                            {{-- @if ( $receipt->stock >0)
                                <form action="{{ route('accessorySale.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="accessory_id" value="{{ $receipt->id }}" required>
                                <input type="number" name="total_price" value="{{ $receipt->price }}" required>

                                <div class="mb-3">
                                    <label for="quantity-{{ $receipt->id }}" class="form-label">عدد:</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        id="quantity-{{ $receipt->id }}"
                                        name="quantity"
                                        value="1"
                                        required
                                        min="1"
                                    >
                                    @error('quantity')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">بيع</button>
                                </div>
                            </form>


                            @endif --}}

                        </td>

                        {{-- <td>{{ date('d-m-Y h:i A', strtotime($receipt->created_at)) }}</td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
    $(document).ready(function() {
        var table = $('#accessorysTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/ar.json"
            },
            "order": [[0, "desc"]] // ترتيب حسب العمود الأول (id)
        });

        // التحقق من الضغط على "Alt + S"
        $(document).on('keydown', function(e) {
            if (e.altKey && e.which == 83) {  // Alt + S
                e.preventDefault(); // لمنع السلوك الافتراضي مثل اختصارات المتصفح
                $('#customSearch').focus();  // التركيز على حقل البحث
            }
        });

        // تفعيل البحث عندما يكتب المستخدم في الحقل
        $('#customSearch').on('input', function() {
            table.search(this.value).draw();  // البحث في الجدول بناءً على النص المدخل
        });
    });
        // تحديث البحث حسب التاريخ والنص
    function applySearch() {
        var searchText = $('#customSearch').val(); // النص المكتوب في البحث المخصص
        var searchDate = $('#searchDate').val();   // التاريخ المختار
        var combinedSearch = searchText + ' ' + searchDate; // الجمع بين النص والتاريخ
        table.search(combinedSearch).draw();      // تطبيق البحث
    }
       // استماع لتغيير التاريخ في حقل البحث
    $('#searchDate').on('change', function() {
        applySearch();
    });
    </script>

</body>
</html>
