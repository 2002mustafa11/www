<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مراجعة التنبيهات</title>
    
    <!-- إضافة Bootstrap من خلال CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
</head>
<body dir="rtl">
    <div class="container mt-5">
        <h1 class="text-center mb-4">مراجعة التنبيهات</h1>
        
        <!-- زر لمراجعة تواريخ التسليم -->
        <div class="text-center mb-4">
            <button id="checkDeliveryDates" class="btn btn-primary">مراجعة تواريخ التسليم</button>
        </div>
        
        <!-- حاوية التنبيهات -->
        <div id="notifications-container"></div>
    </div>

    <script>
        // دالة لتحميل التنبيهات عبر AJAX
        function loadReviewDeliveryDate() {
            $.ajax({
                url: '/review-delivery-date/ajax',  // رابط الـ API
                type: 'GET',
                success: function(data) {
                    // مسح التنبيهات السابقة
                    $('#notifications-container').empty();

                    // عرض التنبيهات (أو إذا لم تكن هناك بيانات)
                    if (data.length > 0) {
                        data.forEach(function(deviceReceipt) {
                            // إضافة بطاقة لكل تنبيه
                            $('#notifications-container').append(`
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <strong>جهاز: ${deviceReceipt.device_type}</strong>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>العميل:</strong> ${deviceReceipt.customer.name}</p>
                                        <p><strong>تاريخ التسليم:</strong> ${deviceReceipt.delivery_date}</p>
                                    </div>
                                </div>
                            `);
                        });
                    } else {
                        // إذا لم تكن هناك أجهزة متأخرة
                        $('#notifications-container').append(`
                            <div class="alert alert-success">
                                <strong>مبروك!</strong> لا توجد أجهزة متأخرة في التسليم.
                            </div>
                        `);
                    }
                },
                error: function(xhr, status, error) {
                    console.log('حدث خطأ أثناء تحميل البيانات:', error);
                }
            });
        }

        // عند الضغط على الزر
        $('#checkDeliveryDates').click(function() {
            loadReviewDeliveryDate();
        });

        // التحقق كل 15 دقيقة
        setInterval(loadReviewDeliveryDate, 900000);  // 15 دقيقة
    </script>
</body>
</html>
