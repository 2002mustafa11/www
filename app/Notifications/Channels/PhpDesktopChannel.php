<?php

namespace App\Notifications\Channels;

use Illuminate\Notifications\Notification;

class PhpDesktopChannel
{
    /**
     * Send the notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        // استرجاع البيانات من الإشعار
        $data = $notification->toPhpDesktop($notifiable);

        // تنفيذ جافا سكربت عبر PHPDesktop
        echo "<script>
            window.external.notify({
                message: '{$data['message']}',
                invoiceNumber: '{$data['invoiceNumber']}',
                amountPaid: '{$data['amountPaid']}'
            });
        </script>";
    }
}

