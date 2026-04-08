<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AdminAuthController extends Controller
{
    private function ensureDefaultAdmin(): void
    {
        Admin::updateOrCreate(
            ['username' => 'admin'],
            ['password' => Hash::make('admin123')]
        );
    }

    public function showLogin(): View|RedirectResponse
    {
        $this->ensureDefaultAdmin();

        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $this->ensureDefaultAdmin();

        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $admin = Admin::find($credentials['username']);

        if (! $admin || ! Hash::check($credentials['password'], $admin->password)) {
            return back()->withInput($request->only('username'))->with('error', 'Username atau password salah.');
        }

        $request->session()->put('admin_logged_in', true);
        $request->session()->put('admin_username', $admin->username);

        return redirect()->route('admin.dashboard')->with('success', 'Berhasil login sebagai admin.');
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget(['admin_logged_in', 'admin_username']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Anda berhasil logout.');
    }
}
