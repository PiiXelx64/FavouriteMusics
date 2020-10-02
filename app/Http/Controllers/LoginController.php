<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class LoginController extends Controller
{
    public function authenticate(Request $request) {

        $creds = $request->only('email', 'password');
        $creds['password'] = Hash::make($creds['password']);
        if(Auth::attempt($creds)) { return redirect('/account'); }
    }

    public function createAccount(Request $request) {

        if($request->password1 != $request->password2) {
            $error_message = 'Les deux mots de passe doivent être identiques !';
            return Response::view('register', compact('error_message'));
        }

        $newUser = new User;
        $newUser->name = $request->username;
        $newUser->password = Hash::make($request->password1);
        $newUser->email = $request->email;
        try {
            $newUser->save();
        }
        catch (QueryException $exception) {
            $error_message = 'Erreur lors de la création du compte, veuillez ré-essayer.';
            return Response::view('register', compact('error_message'));
        }
    }

    public function registerForm() {
        return view('register');
    }

    public function loginForm() {
        return view('login');
    }
}