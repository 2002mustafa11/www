{{-- <div id="notification" style="display: none; position: fixed; top: 20px; right: 20px; background-color: #28a745; color: white; padding: 15px; border-radius: 5px; box-shadow: 0px 4px 6px rgba(0,0,0,0.1); z-index: 9999;">
    <p id="notification-message"></p>
    <p id="notification-invoice"></p>
    <p id="notification-amount"></p>
</div> --}}

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{url('/')}}">Device Management</a>
        <a href="javascript:history.go(-1)">Go back</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <!-- Dropdown for Accessories -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownAccessories" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        اكسسوارات
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownAccessories">
                        <li><a class="dropdown-item" href="{{route('accessorys')}}">اكسسوارات</a></li>
                        <li><a class="dropdown-item" href="{{route('accessorySale.index',['all'=>0])}}">بيع اكسسوارات</a></li>
                    </ul>
                </li>

                <!-- Dropdown for Device Operations -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownDeviceOps" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        عمليات الجهاز
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownDeviceOps">
                        <li><a class="dropdown-item" href="{{route('device_receipts.index')}}">استلام</a></li>
                        <li><a class="dropdown-item" href="{{route('delivery')}}">تسليم</a></li>
                        <li><a class="dropdown-item" href="{{route('delivery_date')}}">delivery_date</a></li>
                    </ul>
                </li>
               
                <!-- Dropdown for Suppliers & Purchases -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownSuppliers" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        الموردين والمشتريات
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownSuppliers">
                        <li><a class="dropdown-item" href="{{route('supplier.index')}}">suppliers</a></li>
                        <li><a class="dropdown-item" href="{{route('purchases.index')}}">قطع غيار</a></li>
                        <li><a class="dropdown-item" href="{{route('payments.index')}}">دفعات</a></li>

                    </ul>
                </li>

                <!-- Dropdown for Payments & Shortages -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPayments" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        النواقص و حساب
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownPayments">
                        <li><a class="dropdown-item" href="{{route('Shortage.index')}}">نواقص</a></li>
                        <li><a class="dropdown-item" href="{{route('money.index')}}">حساب المبيعات الاجلة</a></li>

                    </ul>
                </li>

                <!-- Dropdown for Cutting Operations -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownCutting" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        عمليات التقطيع
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownCutting">
                        <li><a class="dropdown-item" href="{{route('Cutting.index')}}">تقطيع</a></li>
                        <li><a class="dropdown-item" href="{{route('CuttingUP.index')}}">تقطيع علي الرف</a></li>
                    </ul>
                </li>

                <!-- Other Links -->
                <li class="nav-item">
                    <a class="nav-link" href="{{route('technicians.index')}}">Technician</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/notifications/view')}}">notification</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('login')}}">login</a>
                </li>
            </ul>

            @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
            @endauth
        </div>
    </div>
</nav>

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
{{-- <audio id="notification-sound" src="/sounds/mixkit-bell-notification-933.wav"></audio>

<div>
    <h4 id="notification-title">عنوان التنبيه</h4>
    <p id="notification-body">تفاصيل التنبيه</p>
    <p id="notification-count">عدد التنبيهات: 0</p> <!-- عرض عدد التنبيهات -->
</div>

<script>
    // دالة لجلب التنبيهات
    function fetchNotifications() {
        $.ajax({
            url: '/notifications/index',  // طلب جلب التنبيهات
            type: 'GET',
            success: function (response) {
                if (response.count > 0) {
                    // عرض عدد التنبيهات
                    $('#notification-count').text('عدد التنبيهات: ' + response.count);

                    // عرض بيانات التنبيه (إذا كان هناك أي إشعار جديد)
                    const notification = response.notifications[0]; // اختيار أول إشعار
                    $('#notification-title').text(notification.data.title);  // عرض عنوان التنبيه
                    $('#notification-body').text(notification.data.message); // عرض محتوى التنبيه

                    // تشغيل الصوت عند وجود إشعار جديد
                    const audio = document.getElementById('notification-sound');
                    audio.play();
                } else {
                    // إذا لم يكن هناك تنبيهات
                    $('#notification-title').text('لا توجد تنبيهات جديدة');
                    $('#notification-body').text('');
                }
            },
            error: function (xhr, status, error) {
                console.error("حدث خطأ أثناء جلب التنبيهات:", error);
            }
        });
    }

    // جلب التنبيهات عند تحميل الصفحة
    fetchNotifications();

    // إعادة جلب التنبيهات كل 3 ثوانٍ (3000ms)
    setInterval(fetchNotifications, 300000);
</script>
 --}}
