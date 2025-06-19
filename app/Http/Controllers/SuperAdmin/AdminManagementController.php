<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Models\Admin;
use App\Models\Category;
use App\Models\GeneralPassword;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $categoryId = $request->category_id;

        $admins = Admin::with('category')
            ->when(
                $categoryId,
                function ($query) use ($categoryId) {
                    $query->where('category_id', $categoryId);
                }
            )->paginate();

        return view('superadmin.views.admin.index', compact('admins', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view("superadmin.views.admin.create", compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminRequest $request)
    {
        $data = $request->validated();

        $category = Category::find($data['category_id']);
        if (!$category) {
            return redirect()->back()->with('error', 'Category not found');
        }

        $newImage = null;

        DB::beginTransaction();

        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $ext = $image->getClientOriginalExtension();
                $newImage = time() . rand(10000, 50000) . "." . $ext;

                $path = public_path('images/admins');
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }

                $image->move($path, $newImage);
                $data['image'] = $newImage;
            }

            $password = Hash::make($data['password']);

            $admin = Admin::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $password,
                'image' => $data['image'] ?? null,
                'category_id' => $data['category_id'],
                'super_admin_id' => auth()->id(),
            ]);
            if (!$admin)
            {
                throw new \Exception('Failed to create admin');
            }

            do
            {
                $code = random_int(10000, 99999);
            }
            while (GeneralPassword::where('general_code', $code)->exists());
            $general_pss = GeneralPassword::create([
                'general_code' => $code,
                'accessible_type' => Admin::class,
                'accessible_id' => $admin->id,
            ]);
            if (!$general_pss)
            {
                throw new \Exception('Failed to create general password');
            }

            DB::commit();

            return redirect()->route('create_admin')->with('success', 'Admin created successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            if ($newImage && File::exists(public_path('images/admins/' . $newImage))) {
                File::delete(public_path('images/admins/' . $newImage));
            }

            return redirect()->back()->with('error', 'Something went wrong, please try again.');
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
        $admin = Admin::findOrFail($id);
        $categories = Category::all();
        return view('superadmin.views.admin.edit', compact('admin', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreAdminRequest $request, $id)
    {
        $admin = Admin::find($id);
        if (!$admin)
        {
            return redirect()->back()->with('error', 'Admin not found');
        }

        $data = $request->validated();

        $category = Category::find($data['category_id']);
        if (!$category)
        {
            return redirect()->back()->with('error', 'Category not found');
        }

        $newImage = null;
        $oldImage = $admin->image;

        DB::beginTransaction();

        try {
            if ($request->hasFile('image'))
            {
                if ($oldImage && File::exists(public_path('images/admins/' . $oldImage)))
                {
                    File::delete(public_path('images/admins/' . $oldImage));
                }

                $image = $request->file('image');
                $ext = $image->getClientOriginalExtension();
                $newImage = time() . rand(10000, 50000) . "." . $ext;

                $path = public_path('images/admins');
                if (!file_exists($path))
                {
                    mkdir($path, 0777, true);
                }

                $image->move($path, $newImage);
                $data['image'] = $newImage;
            }
            else
            {
                $data['image'] = $admin->image;
            }

            $data['password'] = Hash::make($data['password']);

            $updated = $admin->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'category_id' => $data['category_id'],
                'image' => $data['image'],
                'password' => $data['password'],
            ]);

            if (!$updated)
            {
                throw new \Exception('Failed to update admin');
            }

            DB::commit();

            return redirect()->route('all_admins')->with('success', 'Admin updated successfully');
        }
        catch (\Exception $e)
        {
            DB::rollBack();

            if ($newImage && File::exists(public_path('images/admins/' . $newImage)))
            {
                File::delete(public_path('images/admins/' . $newImage));
            }

            return redirect()->back()->with('error', 'Something went wrong, please try again. <br>' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $admin = Admin::find($id);
        if (!$admin) {
            return redirect()->back()->with('error', 'Admin not found');
        }

        $admin->delete();

        return redirect()->route('all_admins')->with('success', 'Admin deleted successfully');
    }
}
