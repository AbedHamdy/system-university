<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\Doctor;
use App\Models\Level;
use App\Models\Semester;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validated = $request->validate([
            'category_id' => ['nullable', 'integer', 'exists:categories,id'],
        ]);

        $query = Course::query()->with('category');
        if (!empty($validated['category_id'])) {
            $query->where('category_id', $validated['category_id']);
        }

        $courses = $query->paginate();
        $categories = Category::all();

        return view('superadmin.views.course.index', compact('courses', 'categories'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        if(!$categories)
        {
            return redirect()->route('create_category')->with('error', 'Create first category');
        }

        return view("superadmin.views.course.create", compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        $data = $request->validated();
        // dd($data);
        $category = Category::find($data["category_id"]);
        if (!$category) {
            return redirect()->back()->with("error", "Category not found");
        }

        $data["super_admin_id"] = auth()->id();
        // dd($data);

        $course = Course::create($data);
        if (!$course) {
            return redirect()->back()->with("error", "Field to create course , please try again");
        }

        return redirect()->back()->with("success", "Course  created successfully");
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
    public function destroy($id)
    {
        $course = Course::find($id);

        if (!$course)
        {
            return redirect()->back()->with('error', 'Course not found');
        }

        $course->delete();

        return redirect()->route('all_courses')->with('success', 'Course deleted successfully');
    }
}
