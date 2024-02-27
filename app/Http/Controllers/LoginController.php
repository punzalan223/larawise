<?php

namespace App\Http\Controllers;

use App\Models\UserLog;
use App\Models\UsersAppSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            // If user is already authenticated, redirect to dashboard
            return redirect()->route('dashboard');
        }

        $data = [];
        $data['app_settings'] = UsersAppSetting::first();
        
        return view('login.login', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function login(Request $request){
        
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $request->session()->put('app_settings', UsersAppSetting::first());

            UserLog::create([
                'ip_address' => $request->ip(),
                'useragent' => $request->userAgent(),
                'description' => 'User login',
                'id_users' => auth()->user()->id,
                'created_at' => now()
            ]);

            return redirect()->intended('dashboard')->with('login-success', 'Your success message here');
        }

        return back()->withErrors([
            'email' => "The provided credentials do not match to the records."
        ]);
    }

    public function logout(Request $request){
        
        Auth::logout();

        $request->session()->invalidate();
        
        $request->session()->regenerateToken();

        Session::flash('logout', 'You have been successfully logged out.');

        return redirect('/login');
    }
}
