<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login() {
        $user = Auth::user();

        if(!empty($user)) {
            return redirect('/admin');
        }

        return view('auth.login');
    }

    public function loginAction(Request $request) {
        $fields = $request->only('email', 'password');

        if($fields['email'] && $fields['password']) {
            if(Auth::attempt($fields)) {
                return redirect('/admin');
            }else {
                return redirect('/auth/login')->with('error', 'Dados incorretos');
            }
        }else {
            return redirect('/auth/login')->with('error', 'Preencha todos os campos');
        }
    }

    public function register() {
        $user = Auth::user();

        if(!empty($user)) {
            return redirect('/admin');
        }

        return view('auth.register');
    }

    public function registerAction(Request $request) {
        $fields = $request->only('name', 'email', 'password');

        $hasEmail = User::where('email', $fields['email'])->count();

        if($fields['name'] && $fields['email'] && $fields['password']) {

            if($hasEmail === 0) {

                $newUser = new User();
                $newUser->name = $fields['name'];
                $newUser->email = $fields['email'];
                $newUser->password = password_hash($fields['password'], PASSWORD_DEFAULT);
                $newUser->save();

                Auth::login($newUser);
                return redirect('/admin');

            }else {
                return redirect('/auth/register')->with('error', 'Esse email já existe');
            }

        }else {
            return redirect('/auth/register')->with('error', 'Preencha todos os campos');
        }

    }

    public function logout() {
        Auth::logout();
        return redirect('/admin');
    }
}
