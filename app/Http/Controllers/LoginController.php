<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authorizeUser(Request $request){
        $loginArr = $request->validate([//e se o nome na tabela for diferente
            'name' => 'required|min:6|max:30',
            'password' => 'required|min:8'
        ]);

        if(Auth::attempt($loginArr, $request->has('keep_logged'))){
            $request->session()->regenerate();//sera que sempre tem um sessao

            return redirect()->intended('/daily-tasks');
        }

        return back()->withErrors(['loginFail' => 'A conta não foi encontrada, tente novamente']);

        /** 'The credentials were not found, please try again'*/
    }


    public function logoutUser(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('site.home')->with(['logoutSuccess' => 'User was logged out']);
    }
}
