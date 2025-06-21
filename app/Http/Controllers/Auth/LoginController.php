<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckLoginRequest;
use App\Models\Admin;
use App\Models\Doctor;
use App\Models\Student;
use App\Models\SuperAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Login Super Admin.
     */
    public function loginSuperAdmin()
    {
        return view("superadmin.views.login_superadmin");
    }

    public function checkCredential(CheckLoginRequest $request)
    {
        $data = $request->validated();

        $model = match ($data['role']) {
            'SuperAdmin' => SuperAdmin::class,
            'Admin' => Admin::class,
            'Doctor' => Doctor::class,
            'Student' => Student::class,
            // default => null,
        };

        if (!$model::where('email', $data['email'])->exists())
        {
            return redirect()->back()->withErrors(['email' => 'This email does not exist .']);
        }
        // dd($data);
        if(Auth::guard($data["role"])->attempt(
[
                'email' => $data['email'],
                'password' => $data['password'],
            ]))
        {
            $user = Auth::guard($data["role"])->user();
            // dd("dashboard_".$data['role']);
            return redirect()->route("dashboard_".$data['role']);
        }
        // dd("Invalid credentials");
        return redirect()->back()->with(['error' => 'Invalid password']);
    }

    /**
     * Login Admin.
     */
    public function loginAdmin()
    {
        return view("admin.views.login_admin");
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
