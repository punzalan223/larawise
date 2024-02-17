<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UsersAppSetting;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('links.user-profile');
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
        $user_input = $request->all();

        User::find($id)
            ->update([
                'dark_mode' => $user_input['dark_mode']
            ]);

        UsersAppSetting::first()
            ->update([
                'topbar_bg' => $user_input['topbar_bg'],
                'sidebar_bg' => $user_input['sidebar_bg'],
                'sidebar_title_name' => $user_input['sidebar_title'],
                'footer_company_name' => $user_input['footer_title']
            ]);
            
        return redirect()->back()->with('edit-success', 'Settings Updated Sucessfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
