<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Laravel\Socialite\Facades\Socialite;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class githubController extends Controller
{
    public function githubpage(){

        return Socialite::driver('github')->redirect();

    }

    public function githubcallback(){
        try{
            $user = Socialite::driver('github')->user();
            $finduser = User::where('github_id',$user->id)->first();
            if($finduser){
                Auth::login($finduser);
                return redirect()->intended('dashboard');
            }
            else{
                $newuser = User::create([
'name' => $user->name,
'email'=> $user->email,
'github_id'=> $user->id,
'password' => encrypt('123456dummy')

                ]);
                Auth::login($newuser);
                return redirect()->intended('dashboard');
            }

        }
        catch (Exception $e){
            dd($e->getMessage());
        }
    }//
}
