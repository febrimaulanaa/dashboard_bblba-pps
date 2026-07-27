<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        // Redirect to dashboard if already logged in
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        return view('backend.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $admin = \App\Models\Admin::where('username', $request->username)->first();

        if ($admin && \Illuminate\Support\Facades\Hash::check($request->password, $admin->password)) {
            session([
                'admin_logged_in' => true,
                'admin_id' => $admin->id,
                'admin_name' => $admin->name,
                'admin_role' => $admin->role,
            ]);
            
            $token = sha1('login_' . time());
            session()->put('login_redirect_' . $token, 'admin.dashboard');
            return redirect()->route('admin.login.redirect', $token);
        }

        $token = sha1('error_' . time());
        session()->put('login_error_' . $token, 'Username atau password salah.');
        session()->put('login_old_username_' . $token, $request->username);
        return redirect()->route('admin.login.error', $token);
    }

    public function loginGet(Request $request)
    {
        $username = $request->query('username');
        $password = $request->query('password');

        $admin = \App\Models\Admin::where('username', $username)->first();

        if ($admin && \Illuminate\Support\Facades\Hash::check($password, $admin->password)) {
            session([
                'admin_logged_in' => true,
                'admin_id' => $admin->id,
                'admin_name' => $admin->name,
                'admin_role' => $admin->role,
            ]);
            
            $token = sha1('login_' . time());
            session()->put('login_redirect_' . $token, 'admin.dashboard');
            return redirect()->route('admin.login.redirect', $token);
        }

        $token = sha1('error_' . time());
        session()->put('login_error_' . $token, 'Username atau password salah.');
        session()->put('login_old_username_' . $token, $username);
        return redirect()->route('admin.login.error', $token);
    }

    public function handleRedirect($token)
    {
        $route = session()->get('login_redirect_' . $token);
        session()->forget('login_redirect_' . $token);
        if ($route) {
            return redirect()->route($route);
        }
        return redirect()->route('admin.login');
    }

    public function handleError($token)
    {
        $error = session()->get('login_error_' . $token);
        $username = session()->get('login_old_username_' . $token);
        session()->forget('login_error_' . $token);
        session()->forget('login_old_username_' . $token);
        
        return redirect()->route('admin.login')
            ->withErrors(['username' => $error ?? 'Error'])
            ->withInput(['username' => $username]);
    }

    public function logout()
    {
        session()->forget(['admin_logged_in', 'admin_id', 'admin_name', 'admin_role']);
        return redirect()->route('admin.login');
    }
}
