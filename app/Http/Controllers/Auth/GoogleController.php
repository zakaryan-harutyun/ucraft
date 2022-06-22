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

class GoogleController extends Controller
{
    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();
            $searchUser = User::where('google_id', $user->id)->first();

            if($searchUser){

                Auth::login($searchUser);

                return redirect('/');

            }else{

                $check_user = User::where('email', $user->email)->first();

                if($check_user){
                    Auth::login($check_user);
                    return redirect('/');
                }

                $random = Str::random(10);

                $gitUser = User::create([
                    'name' => $user->name,
                    'google_id'=> $user->id,
                    'auth_type'=> 'google',
                    'password' => (new BcryptHasher())->make($random),
                    'email' => $user->email,
                    'email_verified_at' => Carbon::now(),
                ]);

                Auth::login($gitUser);

                return redirect('/');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
