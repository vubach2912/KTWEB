<?php

namespace App\Http\Controllers;

use App\Models\PVPGNGiftcheck;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Services\SocialAccountService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Socialite;
use Laracasts\Flash\Flash;


class SocialAuthController extends Controller
{
    public function redirect($social)
    {
        $username   = Auth::User()->name;

        $bnetModel = \App\Models\BNET::where('acct_username', $username)->first();
        if (!$bnetModel) {
            Flash::error('Cannot active /Ann, please contact Administrator');
            return redirect()->to('home');
        }

        $bnetModel->auth_command_groups = 3;
        $bnetModel->timestamps = false;
        $bnetModel->save();

        $codeUsed   = PVPGNGiftcheck::where('username', $username)->where('gift_code', 'EXP60')->first();
        if (!$codeUsed) {
            $newCode = new PVPGNGiftcheck();
            $newCode->gift_code = 'EXP60';
            $newCode->username = $username;
            $newCode->used = 2;
            $newCode->save();
        } else {
            $codeUsed->used = 2;
            $codeUsed->save();
        }

        Flash::success('Kích hoạt thành công, vui lòng vào game gõ "#CODE EXP60" để nhận GIFTCODE, Chat toàn hệ thống sẽ được kích hoạt vào ngày hôm sau.');
        return Socialite::driver($social)->redirect();
    }

    public function callback($social)
    {
        $user = SocialAccountService::createOrGetUser(Socialite::driver($social)->user(), $social);
        auth()->login($user);

        return redirect()->to('/home');
    }
}
