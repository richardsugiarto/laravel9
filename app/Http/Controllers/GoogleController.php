<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class GoogleController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
          
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function handleGoogleCallback()
    {
        
        
            $user = Socialite::driver('google')->stateless()->user();
         
            $finduser = User::where('google_id', $user->id)->first();
         
            if($finduser){
         
                Auth::login($finduser);
        
                return redirect('/');
         
            }else{
                $newUser = User::updateOrCreate(['email' => $user->email],[
                        'name' => $user->name,
                        'google_id'=> $user->id,
                        'password' => Crypt::encryptString('123456du')
                    ]);
         
                Auth::login($newUser);
        
                return redirect('/');
            }
        
        
    }
}
