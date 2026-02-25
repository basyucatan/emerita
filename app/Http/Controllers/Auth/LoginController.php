<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
    public function username()
    {
        return 'telefono';
    }
    protected function authenticated($request, $user)
    {
        if ($user->hasAnyRole(['admin', 'adminMax'])) {
            return redirect('/');
        }
        if ($user->hasRole('User')) {
            return redirect('/home');
        }
        return redirect('/');
    }    
}
