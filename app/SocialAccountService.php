<?php

namespace App;

use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAccountService
{
    public function createOrGetUser(ProviderUser $providerUser)
    {
        $account = SocialAccount::whereprovider('facebook')
            ->whereprovider_user_id($providerUser->getId())
            ->first();

        if ($account) {
            return $account;
        } else {
            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'facebook',
                'email' => $providerUser->getEmail(),
            ]);

            $user = User::whereemail($providerUser->getEmail())->first();

            if (!$user) {

                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'first_name' => $providerUser->getName(),
                    'confirm_code' => 'null',
                    'confirmed' => 1,
                ]);
            }

            $account->user()->associate($user);
            $account->save();

            return $user;

        }

    }
}