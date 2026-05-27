<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Order;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('profil-pengguna', compact('user'));
    }

    public function update(Request $request)
    {
        $phoneInput = $request->input('phone');
        $countryCode = $request->input('country_code', '+62');
        $combinedPhone = null;

        if ($phoneInput !== null && $phoneInput !== '') {
            $digits = ltrim($phoneInput, '0');
            $digits = preg_replace('/[^0-9]/', '', $digits);
            
            $codeDigits = ltrim($countryCode, '+');
            if (str_starts_with($digits, $codeDigits)) {
                $digits = substr($digits, strlen($codeDigits));
            }
            
            $combinedPhone = $countryCode . $digits;
        }

        $request->merge(['phone' => $combinedPhone]);

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = auth()->user();
        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        // Ensure user profile exists
        $profile = $user->profile()->firstOrCreate([]);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($profile->avatar_url) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($profile->avatar_url);
            }
            
            $path = $request->file('avatar')->store('avatars', 'public');
            $profile->update([
                'avatar_url' => $path
            ]);
        }

        $user->logActivity('Memperbarui profil pengguna');

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah.']);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        $user->logActivity('Mengubah password akun');

        return back()->with('success', 'Password berhasil diperbarui.');
    }

    public function orders()
    {
        $orders = Order::where('user_id', auth()->id())
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
                    
        return view('riwayat-pesanan', compact('orders'));
    }
}
