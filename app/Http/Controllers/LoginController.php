<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.auth.login', [
            'title' => 'Login',
            'items' => Item::where('isDeleted', 0)->whereNotIn('stock', [0])->latest()->get()
        ]);
    }

    public function identifikasi(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/pinjam-pengembalian');
        } else {
            return back()->withErrors(['credentials' => 'Invalid username or password']);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
