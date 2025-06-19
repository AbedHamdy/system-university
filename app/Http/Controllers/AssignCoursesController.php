<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignCourseToLevelRequest;
use App\Http\Requests\ValidateLevelCategoryRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\Level;
use Illuminate\Http\Request;

class AssignCoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with("superAdmin")
            ->orderBy('created_at', 'desc')
            ->get();
        if($categories->isEmpty())
        {
            return view("superadmin.views.category.create", compact("categories"));
        }
        // dd($categories);

        return view("superadmin.views.assign.index" , compact("categories"));
    }

    public function show($id)
    {
        $category = Category::with('levels')->find($id);
        $courses = Course::where('category_id', $id)->get();
        if(!$category)
        {
            return redirect()->route('select_category')->with('error', 'Category not found.');
        }
        if($courses->isEmpty())
        {
            return redirect()->route('create_course')->with('error', 'No courses found , please add courses first.');
        }
        // dd($courses);
        $levels = $category->levels;

        return view('superadmin.views.assign.show_levels', compact('category', 'levels'));
    }

    /**
     * Show the form for creating a new resource.
     */
   public function assign(ValidateLevelCategoryRequest $request)
    {
        $data = $request->validated();

        $level = Level::find($request->level_id);
        $category = Category::find($request->category_id);
        if(!$level || !$category)
        {
            return redirect()->route('select_category')->with('error', 'Level or Category not found.');
        }
        // dd($data);

        $courses = Course::where('category_id', $category->id)
            ->whereNull('level_id')
            ->get();

        if($courses->isEmpty())
        {
            return redirect()->route('create_course')->with('error', 'All courses are already assigned to this level , please create a new course.');
        }
        return view('superadmin.views.assign.add_courses', compact('level', 'category' , "courses"));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AssignCourseToLevelRequest $request)
    {
        $data = $request->validated();
        // dd($data);
        foreach($data["courses"] as $course)
        {
            $course = Course::whereIn('id', $data['courses'])->update([
                'level_id' => $data['level_id']
            ]);
            if(!$course)
            {
                return redirect()->back()->with('error', 'Failed to assign course');
            }
        }

        return redirect()->back()->with('success', 'Courses assigned successfully');
    }

    /**
     * Display the specified resource.
     */


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
