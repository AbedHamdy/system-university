<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function loginSuperAdmin()
    {
        return view("superadmin.views.login_superadmin");
    }

    public function checkCredential(CheckLoginRequest $request)
    {
        $data = $request->validated();
        // dd($data["role"]);
        if(Auth::guard($data["role"])->attempt(
[
                'email' => $data['email'],
                'password' => $data['password'],
            ]))
        {
            $user = Auth::guard($data["role"])->user();
            // dd($user);
            return redirect()->route("dashboard_".$data['role']);
        }
        // dd("Invalid credentials");
        return redirect()->back()->with(['error' => 'Invalid password']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        // $user = Auth::user();
        // dd($user);
        Auth::logout();
        return redirect()->route("home");
    }
}
