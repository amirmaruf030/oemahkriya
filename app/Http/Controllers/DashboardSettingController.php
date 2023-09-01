<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DashboardSettingController extends Controller
{
    public function store()
    {
        $user = Auth::user();

        return view('pages.dashboard-settings', [
            'user' => $user,
        ]);
    }

    public function account()
    {
        $user = Auth::user();

        return view('pages.user.dashboard-account', [
            'user' => $user,
            'aktif' => 'Akun Saya'
        ]);
    }

    public function update(Request $request, $redirect)
    {
        if ($request->file('image')) {
            $user = User::findOrFail(Auth::user()->id);
            // Validasi input gambar
            $validatedData = $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            // Hapus gambar lama jika ada
            if ($user->image) {
                Storage::delete('public/assets/profil/' . $user->image);
            }
            // Simpan gambar ke dalam direktori public/storage/assets/profil
            $imagePath = $request->file('image')->store('assets/profil', 'public');
            // Simpan nama file gambar ke dalam field image pada database
            $user->image = basename($imagePath);

            $user->save();
        }

        $user = User::findOrFail(Auth::user()->id);
        // Validasi input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        // Update data pada field name, username, dan email pada database
        $user->name = $validatedData['name'];
        $user->username = $validatedData['username'];
        $user->email = $validatedData['email'];
        $user->save();

        return redirect()->route($redirect);
    }
}
