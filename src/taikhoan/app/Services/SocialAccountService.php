<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use Laravel\Socialite\Contracts\User as ProviderUser;
use App\Models\SocialAccount;

class SocialAccountService
{
    public static function checkSocialAccount($user_id)
    {
        $account = SocialAccount::whereUserId($user_id)->first();
        if ($account) {
            return true;
        }
        return false;
    }

    public static function createOrGetUser(ProviderUser $providerUser, $social)
    {
        $account = SocialAccount::whereProvider($social)
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {

            if (!Auth::check()) {
                Flash::error('Please login first then active facebook account.');
                return redirect()->to('/home');
            }

            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => $social
            ]);
            $user = Auth::user();
            $account->user()->associate($user);
            $account->save();

            return $user;
        }
    }
}
