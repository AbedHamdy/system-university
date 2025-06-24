<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLevelRequest;
use App\Http\Requests\UpdateLevelRequest;
use App\Models\Category;
use App\Models\Level;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LevelController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        $category = Category::find($data["category_id"]);
        if (!$category)
        {
            return redirect()->route("create_category")->with('error', 'Category not found');
        }
        return view('superadmin.views.level.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLevelRequest $request)
    {
        $data = $request->validated();
        // dd($data);
        $category = Category::find($data['category_id']);
        if (!$category) {
            return redirect()->route("create_category")->with('error', 'Category not found');
        }

        $user = auth()->user();
        
        DB::beginTransaction();
        try {

            $createdLevels = [];

            for ($i = 1; $i <= $data['level_number']; $i++)
            {
                $level = Level::create([
                    'category_id' => $data['category_id'],
                    'number_level' => $i,
                    'super_admin_id' => $user->id,
                ]);

                if (!$level)
                {
                    throw new \Exception("Failed to create level {$i}");
                }

                $createdLevels[] = $level;
                for ($j = 1; $j <= 3; $j++)
                {
                    $semester = Semester::create([
                        'semester_number' => $j,
                        'level_id' => $level->id,
                    ]);

                    if (!$semester)
                    {
                        throw new \Exception("Failed to create semester {$j} for level {$i}");
                    }
                }
            }

            DB::commit();
            return redirect()->route('create_category')->with('success', 'Levels and Semesters created successfully');
        }
        catch (\Exception $e)
        {
            DB::rollBack();

            foreach ($createdLevels as $level)
            {
                Semester::where('level_id', $level->id)->delete();
                $level->delete();
            }

            return redirect()->back()->with('error', 'Something went wrong: please try again');
        }
    }

    public function edit(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        $category = Category::withCount("levels")->find($data["category_id"]);

        if (!$category)
        {
            return redirect()->route("create_category")->with('error', 'Category not found');
        }
        return view('superadmin.views.level.edit', compact('category'));
    }

    public function update(StoreLevelRequest $request)
    {
        $data = $request->validated();
        // dd($data);

        $category = Category::find($data['category_id']);
        if (!$category)
        {
            return redirect()->route('create_category')->with('error', 'Category not found');
        }

        DB::beginTransaction();
        try {
            $oldLevels = Level::where('category_id', $category->id)->get();
            foreach ($oldLevels as $level)
            {
                Semester::where('level_id', $level->id)->delete();
                $level->delete();
            }

            for ($i = 1; $i <= $data['level_number']; $i++)
            {
                $level = Level::create([
                    'category_id' => $category->id,
                    'number_level' => $i,
                    'super_admin_id' => auth()->id(),
                ]);

                for ($j = 1; $j <= 3; $j++)
                {
                    Semester::create([
                        'level_id' => $level->id,
                        'semester_number' => $j,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('my_categories')->with('success', 'Levels and Semesters updated successfully');
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to update levels , please try again.');
        }
    }


}
