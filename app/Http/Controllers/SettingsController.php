<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('pages.settings.index', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email,'.$user->id,
        ]);
        $user->update($request->only('name','email'));
        return back()->with('success','Profil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password'=>'required',
            'password'=>'required|confirmed|min:6',
        ]);

        $user = Auth::user();
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password'=>'Password saat ini tidak cocok.']);
        }
        $user->update(['password' => Hash::make($request->password)]);
        return back()->with('success','Password berhasil diubah.');
    }
}
