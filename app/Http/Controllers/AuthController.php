<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    
    public function index()
    {
        return view('auth.login');
    }
    
    public function register()
    {
        return view('auth.registration');
    }
    
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        }
        return redirect("login")->with('error', 'Wrong email or password');
    }

    public function postRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $data = $request->all();
        $check = $this->create($data);
        return redirect("dashboard");
    }
    
    public function dashboard()
    {
        if (Auth::check()) {
            return view('dashboard');
        }
        return redirect("login");
    }

    public function profile()
    {
        if (Auth::check()) {
            return view('profile.profile');
        }
        
        return redirect("login");
    }
    public function modifyPass()
    {
        if (Auth::check()) {
            return view('profile.modifyPassword');
        }
        
        return redirect("login");
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
