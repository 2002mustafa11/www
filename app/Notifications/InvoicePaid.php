<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class InvoicePaid extends Notification
{
    public $invoice;

    public function __construct($invoice)
    {
        $this->invoice = $invoice;
    }

    public function via(object $notifiable): array
    {
        return ['phpdesktop']; // قناة phpdesktop فقط
    }

    public function toPhpDesktop($notifiable)
    {
        return [
            'message' => 'Your invoice has been paid successfully!',
            'invoiceNumber' => $this->invoice->number,
            'amountPaid' => $this->invoice->amount,
        ];
    }
}
