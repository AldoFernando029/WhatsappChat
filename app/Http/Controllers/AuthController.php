<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $request->validate(['phone_number' => 'required']);
        $user = User::firstOrCreate(['phone_number' => $request->phone_number]);
        Auth::login($user);
        return redirect('/chat');
    }

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }
}
?>