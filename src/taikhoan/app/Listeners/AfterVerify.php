<?php

namespace App\Listeners;

use App\Helpers\BNETPost;
use App\Models\BNET;
use App\Models\JXAccount;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use NotificationChannels\Telegram\TelegramMessage;

class AfterVerify
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle(object $event)
    {
        $user = $event->user;
        $account = JXAccount::where('email', $user->email)->first();
        $account->loginName = $user->name;

        try {
            $account->save();
            Log::info("Tài khoản kích hoạt thành công:" . $user->name);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }

    }
}
