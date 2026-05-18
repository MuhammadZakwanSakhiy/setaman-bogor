<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function toggleBlock(User $user)
    {
        if ($user->role === 'admin') {
            return back()->with('error', 'Tidak dapat memblokir admin.');
        }

        $user->update([
            'is_blocked' => !$user->is_blocked
        ]);

        $status = $user->is_blocked ? 'diblokir' : 'diaktifkan';
        return back()->with('success', "Pengguna {$user->name} berhasil {$status}.");
    }
}
