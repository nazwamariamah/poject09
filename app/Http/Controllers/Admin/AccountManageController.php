<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountManageController extends Controller
{
    /**
     * Display a listing of the resource with Search capability.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Filter data user berdasarkan nama, email, role, atau sub_role
        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%")
                         ->orWhere('role', 'like', "%{$search}%")
                         ->orWhere('sub_role', 'like', "%{$search}%");
        })->get();

        return view('admin.kelola_user.kelola_user', compact('users', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kelola_user.user_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
            'role' => 'required|string',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_privileged' => 0,
        ]);

        return redirect()->route('account.index')->with('success', 'Berhasil Menambahkan Account');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.kelola_user.user_edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $rules = [
            'name' => 'required|string',
            'email' => 'required|email',
            'role' => 'required|string',
            'sub_role' => 'required|string',
            'izin_akses_arsip' => 'required|string',
        ];

        // password hanya divalidasi jika diisi
        if ($request->password) {
            $rules['password'] = 'string';
        }

        $request->validate($rules);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'sub_role' => $request->sub_role,
            'is_privileged' => $request->izin_akses_arsip,
        ];

        // hanya update password jika user mengisi password baru
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('account.index')->with('success', 'Akun berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('account.index')->with('success', 'Akun berhasil dihapus');
    }
}