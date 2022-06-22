<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookCallback()
    {
        try {

            $user = Socialite::driver('facebook')->user();
            $searchUser = User::where('facebook_id', $user->id)->first();

            if($searchUser){

                Auth::login($searchUser);

                return redirect('/');

            }else{

                if($user->email){
                    $check_user = User::where('email', $user->email)->first();
                    if($check_user){
                        Auth::login($check_user);
                        return redirect('/');
                    }
                }

                $random = Str::random(10);

                $gitUser = User::create([
                    'name' => $user->name,
                    'facebook_id'=> $user->id,
                    'auth_type'=> 'facebook',
                    'password' => (new BcryptHasher())->make($random),
                    'email' => $user->email,
                    'email_verified_at' => Carbon::now()
                ]);

                Auth::login($gitUser);

                return redirect('/');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
