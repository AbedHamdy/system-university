<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralPasswordRequest;
use App\Models\GeneralPassword;
use Illuminate\Http\Request;

class GeneralPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("general_password");
    }

    /**
     * Check the specified resource.
     */
    public function check(GeneralPasswordRequest $request)
    {
        $pass = $request->validated();
        // dd($pass);
        $generalPassword = GeneralPassword::where('general_code', $pass["general_password"])->first();
        if (!$generalPassword)
        {
            return redirect()->back()->with(['error' => 'Invalid General Password']);
        }

        // dd($generalPassword);

        $type = $generalPassword->accessible_type;
        $model = class_basename($type);   // هنا جبت المودل بس جمع
        // dd($model);
        $model = strtolower($model);
        // Ensure the view path matches your resources/views directory structure
        $viewPath = strtolower($model) . '.views.login_' . strtolower($model); // حولت المودل لحروف صغيرة
        // dd($viewPath);
        return redirect()->route("show_login_$model");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
