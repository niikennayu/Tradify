<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Menampilkan daftar semua user (Req #10)
     */
    public function index()
    {
        $users = User::latest()->get();
        // Anda perlu membuat file view: resources/views/admin/users/index.blade.php
        return view('admin.users.index', compact('users'));
    }

    /**
     * Menampilkan form untuk membuat user baru
     */
    public function create()
    {
        // Anda perlu membuat file view: resources/views/admin/users/create.blade.php
        return view('admin.users.create');
    }

    /**
     * Menyimpan user baru ke database (Req #10)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users', // Req #17
            'password' => 'required|string|min:8|confirmed', // 'confirmed' butuh field 'password_confirmation'
            'role' => 'required|in:admin,user', // Req #2
            'phone_number' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        $validated['password'] = Hash::make($request->password);
        User::create($validated);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambah.');
    }

    /**
     * Menampilkan form untuk mengedit user
     */
    public function edit(User $user)
    {
        // Anda perlu membuat file view: resources/views/admin/users/edit.blade.php
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Mengupdate data user di database (Req #10)
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed', // Password opsional saat update
            'role' => 'required|in:admin,user',
            'phone_number' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        // Cek jika admin mengisi password baru
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            // Jika password tidak diisi, jangan update password
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Menghapus user dari database (Req #10)
     */
    public function destroy(User $user)
    {
        // Tambahan: Jangan biarkan admin menghapus dirinya sendiri
        if ($user->id == Auth::id()) {
             return redirect()->route('admin.users.index')->with('error', 'Anda tidak bisa menghapus akun Anda sendiri.');
        }

        // Tambahan: Cek jika user punya pinjaman aktif
        if ($user->rentals()->where('status', 'dipinjam')->count() > 0) {
            return redirect()->route('admin.users.index')->with('error', 'User ini memiliki pinjaman aktif, tidak bisa dihapus.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }
}