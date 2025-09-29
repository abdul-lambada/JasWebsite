<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('admin.profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('avatar')) {
            // Hapus avatar lama jika ada
            if ($user->avatar && file_exists(public_path('storage/avatars/' . $user->avatar))) {
                unlink(public_path('storage/avatars/' . $user->avatar));
            }

            $avatarName = time() . '.' . $request->avatar->extension();
            Storage::disk('public')->putFileAs('avatars', $request->file('avatar'), $avatarName);
            $user->avatar = $avatarName;
        }

        // Simpan perubahan menggunakan save() method
        User::where('id', $user->id)->update([
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar,
        ]);

        return redirect()->route('admin.profile')->with('success', 'Profil berhasil diperbarui');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini tidak cocok']);
        }

        $user->password = Hash::make($request->password);
        User::where('id', $user->id)->update(['password' => Hash::make($request->password)]);

        return redirect()->route('admin.profile')->with('success', 'Password berhasil diperbarui');
    }
}
