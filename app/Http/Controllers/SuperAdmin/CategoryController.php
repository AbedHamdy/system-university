<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with("superAdmin")
            ->orderBy('created_at', 'desc')
            ->get();
        // dd($categories);
        return view("superadmin.views.category.index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("superadmin.views.category.create");

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();
        // dd($data);
        if (Category::where('name', $data['name'])->exists())
        {
            return redirect()->back()->with('error', 'The name has already been taken');
        }
        $user = auth()->user();
        // dd($user);
        $category = Category::create([
            "name" => $data["name"],
            "super_admin_id" => $user->id,
        ]);

        if (!$category)
        {
            return redirect()->back()->with("error", "Failed to create category");
        }
        // dd($category);

        return redirect()->route('create_level', [
            'category_id' => $category->id,
        ])->with('success', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $superAdmin = auth()->user();                              // السوبر أدمن الحالي
        $categories = $superAdmin->categories()->latest()->get();  // التخصصات المرتبطة بيه

        return view('superadmin.views.category.my_categories', compact('categories'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::find($id);
        if (!$category)
        {
            return redirect()->route('my_categories')->with('error', 'Category not found.');
        }

        if ($category->super_admin_id !== auth()->id())
        {
            return redirect()->route('my_categories')->with('error', 'You do not have permission to edit this category.');
        }

        return view('superadmin.views.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategoryRequest $request, $id)
    {
        $category = Category::find($id);
        if (!$category)
        {
            return redirect()->route('my_categories')->with('error', 'Category not found.');
        }
        // $id = auth()->id();
        // dd($id);

        if ($category->super_admin_id !== auth()->id())
        {
            return redirect()->route('my_categories')->with('error', 'You do not have permission to update this category.');
        }

        $data = $request->validated();
        $category = Category::where("id" , $id)->update($data);

        if (!$category)
        {
            return redirect()->back()->with('error', 'Failed to update category.');
        }
        // dd($category);
        // return redirect()->route('my_categories')->with('success', 'Category updated successfully.');
        return redirect()->route('edit_level', [
            'category_id' => $id,
        ])->with('success', 'Category updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if (!$category)
        {
            return redirect()->route('my_categories')->with('error', 'Category not found.');
        }

        if ($category->super_admin_id !== auth()->id())
        {
            return redirect()->route('my_categories')->with('error', 'You do not have permission to delete this category.');
        }

        $category->delete();

        return redirect()->route('my_categories')->with('success', 'Category deleted successfully.');
    }
}
