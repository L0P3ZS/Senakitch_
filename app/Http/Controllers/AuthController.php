<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
 
class AuthController extends Controller
{
     //REGISTRO E INICIO SECION CON FACEBOOK
     public function redirectFacebook() {
        return Socialite::driver('facebook')->redirect();
     }
    public function callbackFacebook() {
         $user = Socialite::driver('facebook')->user();
          //metodo crea usuario si email no existe en base de datos
         $user = User::firstOrCreate([
               'email'=> $user->getEmail(),
         ],[
          'name'=> $user->getName(),
          'profile_photo_path' => $user->getAvatar()
         ]);
         auth()->login($user); //iniciar secion automaticamente despues de guardar registro
         return redirect()->to('/');
    }

    //REGISTRO E INICIO SECION CON GOOGLE
     public function redirectGoogle()
     {
         return Socialite::driver('google')->redirect();
     }

     public function callbackGoogle()
     {
         $user = Socialite::driver('google')->user();
         $user = User::firstOrCreate([
          'email'=> $user->getEmail(),
          ],[
          'name'=> $user->getName(),
          'profile_photo_path' => $user->getAvatar(),


          ]);
          auth()->login($user); //iniciar secion automaticamente despues de guardar registro
          return redirect()->to('/');
     }
}

