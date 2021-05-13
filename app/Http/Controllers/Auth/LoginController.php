<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Overtime;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function changStatus($st)
    {
        $userId = Auth::User()->id;
        $setStatus = User::find($userId);
        $setStatus->status = $st;
        $setStatus->save();
    }

    //view page login
    public function getLogin()
    {
        if (isset(Auth::User()->id)) {
            $id = Auth::User()->id;
            $user = User::find($id);
            if ($user->role == 1) {
                return redirect('admin/home');
            } else {
                return redirect('page/home');
            }
        }
        return view('login');
    }

    // post login
    public  function postLogin(LoginRequest $request)
    {
        $remember = ($request['remember-me']) ? true : false;
        $name = $request->name;
        $pass = $request->password;
        if ($remember === true) {
            setcookie('name', $name, time() +(3600*4));
            setcookie('pass', $pass, time() +(3600*4));
        } else {
            setcookie('name', null, time()-1);
            setcookie('pass', null, time()-1);
        }
        if (Auth::attempt(['user_name' => $name, 'password' => $pass, 'role' => 1], $remember)) {
            $this->changStatus(1);
            return redirect('admin/home');
        } elseif (Auth::attempt(['user_name' => $name, 'password' => $pass, 'role' => 0], $remember)) {
            $this->changStatus(1);
            return redirect('page/home');
        } else {
            return redirect('page/login')->with('global',
                'Incorrect username or password. Please try again.');
        }
    }

    //logout page
    public  function getLogout()
    {
        if (isset(Auth::User()->id)) {
            $this->changStatus(0);
            $id = Auth::User()->id;
            $ot = Overtime::where('user_id',$id)->get();
            foreach ($ot as $over) {
                if ($over->work == null) {
                    Overtime::find($over->id)->delete();
                }
            }
        }
        setcookie('start', "", -1, '/AL_training/logtime/admin');
        Auth::logout();
        return redirect('page/login');
    }
}
