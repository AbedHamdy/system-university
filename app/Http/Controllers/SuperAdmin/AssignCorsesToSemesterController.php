<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateAssignCoursesToSemesterRequest;
use App\Http\Requests\ValidateLevelCategoryRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\CourseSemester;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssignCorsesToSemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        if(!$categories)
        {
            return redirect()->route("create_category")->with("error" , "Create a category first");
        }

        return view("superadmin.views.assign_courses.index" , compact("categories"));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::find($id);
        if(!$category)
        {
            return redirect()->route("choose_category_to_choose_level")->with("error" , "Category not found");
        }
        // dd($category);
        // $levels = Category::with("levels")->find($id);
        $levels = $category->levels;
        // dd($levels);
        return view("superadmin.views.assign_courses.show_level" , compact("category" , "levels"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function assign(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'level_id' => 'required|exists:levels,id',
        ]);

        // dd($data);
        $category_id = $request->input('category_id');
        $level_id = $request->input('level_id');

        $category = Category::find($category_id);
        $level = Level::with('semesters')->find($level_id);
        // dd($category);
        // dd($level);
        // dd($level->semesters);
        $courses = Course::where('level_id', $level_id)
            ->where('category_id', $category_id)
            ->get();
        // if($courses->isEmpty())
        // {
        //     return redirect()->route('create_course')->with('error', 'No courses found for this level. Please add courses first.');
        // }
        // dd($courses);
        return view('superadmin.views.assign_courses.assign', compact('category', 'level', 'courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidateAssignCoursesToSemesterRequest $request)
    {
        $data = $request->validated();
        // dd($data);
        $category = Category::find($data['category_id']);
        if(!$category)
        {
            return redirect()->back()->with("error" , "Category not found");
        }

        $level = Level::find($data['level_id']);
        if(!$level)
        {
            return redirect()->bach()->with("error" , "Level not found");
        }

        // $semester_courses = CourseSemester::c
        DB::beginTransaction();
        try
        {
            $semesterIds = $level->semesters->pluck('id');
            CourseSemester::whereIn('semester_id', $semesterIds)->delete();

            foreach ($data['semester_courses'] as $semesterId => $courseIds)
            {
                foreach ($courseIds as $courseId)
                {
                    CourseSemester::create(
        [
                        'semester_id' => $semesterId,
                        'course_id' => $courseId,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route("choose_category_to_choose_level")->with('success', 'Courses assigned to semester successfully');
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to assign courses to semester');
        }
    }
}
