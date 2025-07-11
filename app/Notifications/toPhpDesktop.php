<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class toPhpDesktop extends Notification
{
    use Queueable;
    public $invoice;

    public function __construct($invoice)
    {
        $this->invoice = $invoice;
    }

    public function via(object $notifiable): array
    {
        return [PhpDesktop::class]; // قناة phpdesktop فقط
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
