<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Activity;
use Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile');
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['string', 'min:8', 'confirmed'],
        ]);
        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        if (isset($request->password)) {
            $user->password = Hash::make($request->get('password'));
        }
        $user->save();

        $activity = Activity::create('telah melakukan ubah profil');

        return redirect()->route('home')->with('status', 'Profil akun berhasil diubah');

    }
}
