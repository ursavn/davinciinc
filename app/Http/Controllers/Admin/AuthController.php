<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequests\ChangePasswordRequest;
use App\Http\Requests\AuthRequests\LoginRequest;
use App\Http\Requests\AuthRequests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected $dirView = 'pages.admin.auth.';
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getRegister()
    {

        return view($this->dirView . 'register');
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

        return redirect()->route('admin.auth.get-login');
    }

    public function getLogin()
    {
        if (Auth::check()) {
            return redirect('admin');
        } else {
            return view($this->dirView . 'login');
        }
    }

    public function postLogin(LoginRequest $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($login)) {
            return redirect('admin/templates');
        } else {
            return redirect()->back()->with('status', 'Email address or password is incorrect.');
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('admin.auth.get-login');
    }

    public function resetPassword(ChangePasswordRequest $request)
    {
        $currentPassword = $request['current_password'];
        $newPassword     = $request['new_password'];

        if (!(Hash::check($currentPassword, Auth::user()->password))) {
            return response([
                'status' => 422,
                'message' => 'The current password is incorrect.'
            ]);
        }

        if (strcmp($currentPassword, $newPassword) == false) {
            return response([
                'status' => 422,
                'message' => 'The new password is the same as the current password.'
            ]);
        }

        $user = User::find(Auth::user()->id);

        $user->update([
            'password' => $newPassword
        ]);

        return response([
            'status' => 200,
            'message' => 'Password changed successfully. Please log in again.'
        ]);
    }
}
