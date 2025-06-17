<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLevelRequest;
use App\Http\Requests\UpdateLevelRequest;
use App\Models\Category;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::withCount('levels')->get();
        return view('superadmin.views.level.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::doesntHave('levels')
            ->where('super_admin_id', auth()->id())
            ->get();
        return view('superadmin.views.level.create' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLevelRequest $request)
    {
        $data = $request->validated();
        // dd($data);
        $category = Category::find($data['category_id']);
        if(!$category)
        {
            return redirect()->back()->with('error' , 'Category not found');
        }

        $user = auth()->user();
        if ($category->super_admin_id !== auth()->id())
        {
            return redirect()->back()->with('error', 'You do not have permission to add a level to this category');
        }

        if ($category->levels()->exists())
        {
            return redirect()->back()->with('error', 'This category already has levels.');
        }

        $levelCount = (int)$data['level_number'];

        try {
            //  هنا نبدأ الـ transaction
            DB::beginTransaction();

            for ($i = 1; $i <= $levelCount; $i++) {
                Level::create([
                    'category_id' => $data['category_id'],
                    'number_level' => $i,
                    'super_admin_id' => $user->id,
                ]);
            }

            //  لو كله عدى تمام، نثبت العملية
            DB::commit();

            return redirect()->route('create_level')->with('success', 'Levels created successfully');

        }
        catch (\Exception $e)
        {
            // لو حصل أي خطأ، نرجع كل حاجة
            DB::rollBack();

            return redirect()->back()->with('error', 'Failed to create levels: ' . $e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = auth()->user();
        $categories = Category::with(['levels'])
            ->withCount('levels')
            ->where('super_admin_id', $user->id)
            ->get();

        return view('superadmin.views.level.my_levels', compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit($id)
    // {
    //     // dd($id);
    //     $level = Level::with('category')->find($id);

    //     if (!$level)
    //     {
    //         return redirect()->back()->with('error', 'Level not found');
    //     }

    //     return view('superadmin.views.level.edit', compact('level'));
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(UpdateLevelRequest $request, $id)
    // {
    //     $data = $request->validated();
    //     $level = Level::find($id);
    //     if (!$level)
    //     {
    //         return redirect()->back()->with('error', 'Level not found');
    //     }

    //     if ($level->super_admin_id !== auth()->id())
    //     {
    //         return redirect()->route('my_categories')->with('error', 'You do not have permission to update this category.');
    //     }

    //     $level = Level::where("id" , $id)->update([
    //         'number_level' => $data['level_number'],
    //     ]);
    //     if (!$level)
    //     {
    //         return redirect()->back()->with('error', 'Failed to update level.');
    //     }

    //     return redirect()->route('my_levels')->with('success', 'Level updated successfully');
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd($id);
        $category = Category::find($id);

        if (!$category)
        {
            return redirect()->back()->with('error', 'Category not found.');
        }

        if ($category->super_admin_id !== auth()->id())
        {
            return redirect()->back()->with('error', 'You do not have permission to delete levels for this category.');
        }

        // حذف كل المستويات التابعة لهذا التخصص
        $deleted = $category->levels()->delete();

        if ($deleted)
        {
            return redirect()->back()->with('success', 'All levels for this category have been deleted.');
        }

        return redirect()->back()->with('error', 'Failed to delete levels.');

    }
}
