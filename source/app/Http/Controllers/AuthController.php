<?php

namespace App\Http\Controllers;

use App\Enums\ProviderEnum;
use App\Http\Requests\Admin\LoginAdminRequest;
use App\Http\Requests\Admin\RegisterAdminRequest;
use App\Http\Requests\User\LoginUserRequest;
use App\Http\Requests\User\RegisterUserRequest;
use App\Models\Admin;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    // -- ADMIN --
    public function adminLogin()
    {
        return view('admin.auth.login');
    }

    public function adminRegister()
    {
        return view('admin.auth.register');
    }

    public function adminRegistering(RegisterAdminRequest $request)
    {
        $data = $request->validated();
        $dob = $request->date('dob');

        $password = Hash::make(request()->password);

        $data['password'] = $password;
        $data['dob'] = $dob;

        $admin = new Admin();
        $admin->fill($data);
        $admin->save();

        $admin = Admin::query()
            ->where('email', '=', $request->email)
            ->first(
                [
                    'name',
                    'email',
                    'id',
                    'role',
                ]
            );

        Auth::guard('admin')->login($admin);

        return redirect()->route('admins.index');
    }

    public function adminLogging(LoginAdminRequest $request)
    {
        $data = $request->validated();

        try {
            $admin = Admin::query()
                ->where('email', $request->get('email'))
                ->firstOrFail();

            if (!Hash::check($request->get('password'), $admin->password)) {
                throw new Exception('Invalid password');
            }

            Auth::guard('admin')->login($admin);

            return redirect()->route('admins.index');
        } catch (\Throwable $e) {
            return redirect()->route('admin-login');
        }
    }

    public function adminLogout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        return redirect()->route('admin-login');
    }

    // -- USER --
    public function registering(RegisterUserRequest $request)
    {
        $data = $request->validated();

        $password = Hash::make($request->password);

        $data['password'] = $password;

        $user = User::create($data);

        Auth::login($user);

        return redirect()->route('homes.index')->with('success', 'Đăng ký thành công.');
    }

    public function callback($provider)
    {
        $data = Socialite::driver($provider)->user();

        $provider_id = ProviderEnum::getKeyFromProviderEnum($provider);

        $user = User::query()
            ->firstOrCreate(
                [
                    'email' => $data->email,
                    'provider' => $provider_id,
                ],
                [
                    'name' => $data->name,
                    'password' => Hash::make(rand()),
                ]
            );

        Auth::login($user);

        return redirect()->route('homes.index');
    }

    public function logging(LoginUserRequest $request)
    {
        $remember = $request->has('remember') ? true : false;

        if (auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $remember)) {
            return redirect()->route('homes.index')->with('success', 'Chào mừng bạn trở lại.');
        } else {
            return back()->with('error', 'your username and password are wrong.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        return redirect()->route('homes.index');
    }
}
