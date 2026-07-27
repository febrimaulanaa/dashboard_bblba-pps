<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAccountController extends Controller
{
    public function index()
    {
        $admins = \App\Models\Admin::orderBy('id', 'desc')->get();
        return view('backend.admins.index', compact('admins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admins',
            'password' => 'required|string|min:6',
            'role' => 'required|in:superadmin,admin',
        ]);

        \App\Models\Admin::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->back()->with('success', 'Admin berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $admin = \App\Models\Admin::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admins,username,'.$id,
            'role' => 'required|in:superadmin,admin',
        ]);

        $admin->name = $request->name;
        $admin->username = $request->username;
        $admin->role = $request->role;

        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:6']);
            $admin->password = \Illuminate\Support\Facades\Hash::make($request->password);
        }

        $admin->save();

        return redirect()->back()->with('success', 'Admin berhasil diupdate.');
    }

    public function destroy($id)
    {
        // Jangan hapus akun sendiri atau akun pertama jika perlu (optional safety)
        if (session('admin_id') == $id) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $admin = \App\Models\Admin::findOrFail($id);
        $admin->delete();

        return redirect()->back()->with('success', 'Admin berhasil dihapus.');
    }
}
