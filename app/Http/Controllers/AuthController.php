<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequests\LoginRequest;
use App\Http\Requests\AuthRequests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class AuthController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getRegister()
    {

        return view('admin.register');
    }

    public function postRegister(RegisterRequest $request)
    {
        $data = [
            'username' => $request['username'],
            'email'    => $request['email'],
            'password' => bcrypt($request['password']),
        ];

        if ($request->hasFile('avatar')) {
            $imageName = $request->file('avatar')->getClientOriginalName();

            $request->file('avatar')->storeAs(Config::get('constants.PATH.AVATAR'), $imageName);

            $data['avatar'] = $imageName;
        }

        $this->user->create($data);

        return redirect()->route('get-login');
    }

    public function getLogin()
    {
        if (Auth::check()) {
            return redirect('admin');
        } else {
            return view('admin.login');
        }
    }

    public function postLogin(LoginRequest $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($login)) {
            return redirect('admin');
        } else {
            return redirect()->back()->with('status', 'Email address or password is incorrect.');
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('get-login');
    }
}
