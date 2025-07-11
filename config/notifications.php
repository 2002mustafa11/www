<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Notification Channel
    |--------------------------------------------------------------------------
    |
    | You may specify the default notification channel to use when sending
    | notifications. The available channels are "mail", "database", "broadcast",
    | "nexmo", and "slack". You may also add your custom notification channels.
    |
    */

    'default' => env('NOTIFICATION_CHANNEL', 'mail'),

    /*
    |--------------------------------------------------------------------------
    | Custom Notification Channels
    |--------------------------------------------------------------------------
    |
    | You can register custom notification channels here. The key should be the
    | name of the channel, and the value should be the fully qualified class
    | name of the channel's handler. This allows you to add any custom logic
    | or functionality to the notification sending process.
    |
    */

'channels' => [
        // 'phpdesktop' => App\Notifications\Channels\PhpDesktopChannel::class,
        'phpdesktop' => App\Notifications\toPhpDesktop::class,
    ],

];
