<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Deliverydate extends Notification
{
    use Queueable;

    protected $delivery;

    public function __construct($delivery)
    {
        $this->delivery = $delivery;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'title' => 'Pending Delivery Alert',
            'message' => 'Device receipt for ' . $this->delivery->customer->name . ' is past due for delivery.',
            'device_receipt_id' => $this->delivery->id,
            'device_type' => $this->delivery->device_type,
            'delivery_date' => $this->delivery->delivery_date,
        ];
    }
}
