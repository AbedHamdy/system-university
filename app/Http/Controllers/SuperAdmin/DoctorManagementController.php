<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDoctorRequest;
use App\Models\Category;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Str;

class DoctorManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validated = $request->validate(
     [
                'category_id' => ['nullable', 'integer', 'exists:categories,id'],
            ]
        );
        $query = Doctor::with('category');

        if ($request->filled('category_id'))
        {
            $query->where('category_id', $request->category_id);
        }

        $doctors = $query->paginate();;
        $categories = Category::all();

        return view('superadmin.views.doctor.index', compact('doctors', 'categories'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select("id", "name")->get();
        if (!$categories) {
            return redirect()->back()->with("error", "Create first category");
        }

        return view("superadmin.views.doctor.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDoctorRequest $request)
    {
        $data = $request->validated();
        // dd($data);

        // Check if the category exists
        $category = Category::find($data['category_id']);
        if (!$category) {
            return redirect()->back()->with('error', 'Category not found');
        }
        // dd($data);

        $newImage = null;

        DB::beginTransaction();

        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $ext = $image->getClientOriginalExtension();
                $newImage = time() . rand(10000, 50000) . "." . $ext;

                $path = public_path('images/doctors');
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                $image->move($path, $newImage);
                $data['image'] = $newImage;
            }

            $password = Hash::make($data['password']);
            // dd($data);

            $doctor = Doctor::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $password,
                'image' => $data['image'],
                'category_id' => $data['category_id'],
                'super_admin_id' => auth()->id(),
            ]);

            // dd($doctor);

            if (!$doctor) {
                throw new \Exception('Failed to create doctor');
            }

            DB::commit();

            return redirect()->route('create_doctor')->with('success', 'Doctor created successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            if ($newImage && File::exists(public_path('images/doctors/' . $newImage))) {
                File::delete(public_path('images/doctors/' . $newImage));
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
    public function edit($id)
    {
        $doctor = Doctor::find($id);
        if (!$doctor) {
            return redirect()->back()->with('error', 'Doctor not found');
        }

        $categories = Category::select("id", "name")->get();
        if (!$categories) {
            return redirect()->back()->with("error", "Create first category");
        }

        return view('superadmin.views.doctor.edit', compact('doctor', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreDoctorRequest $request, $id)
    {
        $doctor = Doctor::find($id);
        if (!$doctor) {
            return redirect()->back()->with('error', 'Doctor not found');
        }

        $data = $request->validated();

        // Check if the category exists
        $category = Category::find($data['category_id']);
        if (!$category) {
            return redirect()->back()->with('error', 'Category not found');
        }

        $newImage = null;
        $oldImage = $doctor->image;

        DB::beginTransaction();

        try
        {
            if ($request->hasFile('image'))
            {
                if ($oldImage && File::exists(public_path('images/doctors/' . $oldImage)))
                {
                    File::delete(public_path('images/doctors/' . $oldImage));
                }

                $image = $request->file('image');
                $ext = $image->getClientOriginalExtension();
                $newImage = time() . rand(10000, 50000) . "." . $ext;

                $path = public_path('images/doctors');
                if (!file_exists($path))
                {
                    mkdir($path, 0777, true);
                }

                $image->move($path, $newImage);
                $data['image'] = $newImage;
            }

            // if (isset($data['password']))
            // {
            $data['password'] = Hash::make($data['password']);
            // }
            // else
            // {
            //     unset($data['password']);
            // }

            $updated = $doctor->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'category_id' => $data['category_id'],
                'image' => $data['image'],
                'password' => $data['password'],
                // super_admin_id remains unchanged
            ]);

            if (!$updated)
            {
                throw new \Exception('Failed to update doctor');
            }

            DB::commit();

            return redirect()->route('all_doctors')->with('success', 'Doctor updated successfully');
        }
        catch (\Exception $e)
        {
            DB::rollBack();

            // Delete new image if uploaded but transaction failed
            if ($newImage && File::exists(public_path('images/doctors/' . $newImage)))
            {
                File::delete(public_path('images/doctors/' . $newImage));
            }

            return redirect()->back()->with('error', 'Something went wrong , please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $doctor = Doctor::find($id);
        if (!$doctor) {
            return redirect()->back()->with('error', 'Doctor not found');
        }

        $doctor->delete();

        return redirect()->route('all_doctors')->with('success', 'Doctor deleted successfully');
    }
}
