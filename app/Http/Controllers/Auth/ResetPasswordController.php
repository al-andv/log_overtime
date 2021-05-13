<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\PasswordReset;
use Carbon\Carbon;
use App\User;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index() {
        return view('password/enter_pass');
    }

    public function getReset($token)
    {
        $token = substr($token,6,strlen($token));
        $reset = PasswordReset::where('token', $token)->get();
        foreach ($reset as $res) {
            $email = $res->email;
        }
        return view('password/enter_pass', ['token' => $token,'email' => $email]);
    }

    public function postReset(Request $request, $token)
    {
        $request->validate([
            'password' => 'required|min:3',
            'password_again' =>'required|same:password'
        ],[
            'password_again.same' => 'The password confirmation does not match.'
        ]);
        $passwordReset = PasswordReset::where('token', $token)->firstOrFail();
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(300)->isPast()) {
            $passwordReset->delete();
            return redirect('forgot-password')->with('error','This password reset token is invalid.');
        }
        $user = User::where('email', $passwordReset->email)->firstOrFail();
        $updatePasswordUser = $user->update(['password' => bcrypt($request->password)]);
        $passwordReset->delete();

        if ($updatePasswordUser == true) {
            setcookie('name', $user->user_name, time() + 120);
            setcookie('pass', $request->password, time() + 120);
            return view('login');
        }
    }
}
