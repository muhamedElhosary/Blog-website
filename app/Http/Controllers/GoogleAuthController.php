<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Events\UserRegistered;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
       return Socialite::driver('google')->redirect();
    }
    public function callbackGoogle()
    {
        try{
        $google_user=Socialite::driver('google')->user();
        $user=User::where('google_id',$google_user->getId())->first();

        if(!$user)
        {
            $new_user = User::create([
                'name'=>$google_user->getName(),
                'email'=>$google_user->getEmail(),
                'google_id'=>$google_user->getId(),
            ]);
            Auth::login($new_user);
            event(new UserRegistered($new_user));
            return redirect()->intended('/');
        }
        else
        {
            Auth::login($user);
            return redirect()->intended('/');
        }
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error', 'Login failed. Please try again.');
        }
        
    }

}

