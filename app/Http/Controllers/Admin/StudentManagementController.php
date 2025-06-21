<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Models\Admin;
use App\Models\GeneralPassword;
use App\Models\Level;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class StudentManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $admin = Auth::guard('Admin')->user();
        // dd($admin);
        $category_id = $admin->category_id;
        $endStudent = Student::where('category_id', $category_id)
            ->orderBy('id', 'desc')
            ->first();;
        // dd($endStudent);
        $code = $endStudent ? $endStudent->code + 1 : 0;
        // dd($code);

        return view("admin.views.student.create" , compact("code"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        $data = $request->validated();
        // dd($data);
        $admin = Auth::guard("Admin")->user();
        // $category_id = $admin->category_id;
        $data["admin_id"] = $admin->id;
        $data['category_id'] = $admin->category_id;
        $level = Level::where('category_id', $data['category_id'])
            ->where('number_level', 1)->first();
        if (!$level)
        {
            return redirect()->back()->with('error', 'No level found for this category.');
        }
        $data['level_id'] = $level->id;
        $data["email"] = $data["code"] . "@unv.edu.eg";
        // $data["fees"] = 0;
        // dd($data);

        $newImage = null;

        DB::beginTransaction();
        try
        {
            if($request->hasFile("image"))
            {
                $image = $request->file("image");
                $ext = $image->getClientOriginalExtension();
                $newImage = time() . rand(10000 , 50000) . "." . $ext;

                $path = public_path("images/students");
                if(!file_exists($path))
                {
                    mkdir($path , 0777 , true);
                }

                try
                {
                    $image->move($path, $newImage);
                    if (!file_exists($path . '/' . $newImage))
                    {
                        throw new \Exception("Image upload failed.");
                    }

                    $data["image"] = $newImage;
                    // dd($data);
                }
                catch (\Exception $e)
                {
                    throw new \Exception("Failed to upload image , please try again upload image.");
                }
            }

            $data['password'] = Hash::make($data['password']);
            // dd($data);
            $student = Student::create($data);
            if(!$student)
            {
                throw new \Exception("Failed to create student");
            }

            do
            {
                $code = $student["code"];
            } while (GeneralPassword::where('general_code', $code)->exists());

            $general_pss = GeneralPassword::create([
                'general_code' => $code,
                'accessible_type' => Student::class,
                'accessible_id' => $student->id,
            ]);

            if (!$general_pss)
            {
                throw new \Exception('Failed to create general password for student');
            }

            // dd($student);
            DB::commit();
            return redirect()->route('create_student')->with('success', 'Student created successfully.');
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            if ($newImage && File::exists(public_path('images/students/' . $newImage)))
            {
                File::delete(public_path('images/students/' . $newImage));
            }
            return redirect()->back()->with('error', 'Something went wrong , please try again.');
        }
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
}
