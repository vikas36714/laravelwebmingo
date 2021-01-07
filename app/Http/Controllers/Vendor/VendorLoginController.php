<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;

class VendorLoginController extends Controller
{
    public function index()
    {
        Auth::logout();
        return view('vendor.auth.login');
    }

    # VENDOR LOGIN #
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(
            ['email' => $request->email,
             'password' => $request->password,
             'role' => 'vendor',
             'status' => 1])) {
                return redirect('vendor/dashboard');
        }
        Auth::logout();
        return redirect()->back()->with('error', 'Oppes! You have entered invalid credentials');
    }

}
