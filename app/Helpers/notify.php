<?php

use App\Notifications\GlobalNotification;

if (! function_exists('notify_user')) {
    function notify_user(
        $user,
        string $message,
        bool $sendEmail = false,
        ?string $url = null
    ): void {
        $user->notify(
            new GlobalNotification($message, $url, $sendEmail)
        );
    }
}
