<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSemesterRequest;
use App\Models\Category;
use App\Models\Level;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // جلب السنين والترمات المرتبطة بكل سنة
        $yearsWithSemesters = Semester::select('year', 'semester_number')
            ->orderBy('year', 'desc')
            ->orderBy('semester_number', 'asc')
            ->get()
            ->groupBy('year')
            ->map(function ($semesters) {
                return $semesters->pluck('semester_number')
                    ->unique()
                    ->sort()
                    ->values();
            });

        return view('superadmin.views.semester.index', compact('yearsWithSemesters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::with(['levels' => function ($q) {
                $q->where('super_admin_id', auth()->id())
                ->whereDoesntHave('semester');
            }])
            ->where('super_admin_id', auth()->id())
            ->get();


        return view("superadmin.views.semester.create", compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSemesterRequest $request)
    {
        $data = $request->validated();

        // تحقق من وجود المستوى والتخصص
        $level = Level::where('id', $data['level_id'])
            ->where('category_id', $data['category_id'])
            ->first();

        if (!$level) {
            return redirect()->back()
                ->with('error', 'Invalid level for selected category.')
                ->withInput();
        }

        // تحقق هل المستوى لديه ترمات بالفعل؟
        if (Semester::where('level_id', $level->id)->exists()) {
            return redirect()->back()
                ->with('error', 'This level already has semesters.')
                ->withInput();
        }

        DB::beginTransaction();
        try {
            foreach ($data['semesters'] as $semester) {
                $semesterData = [
                    'semester_number' => $semester['semester_number'],
                    'level_id' => $level->id,
                    'start_date' => $semester['start_date'],
                    'end_date' => $semester['end_date'],
                    'year' => $data['academic_year'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                // تسجيل البيانات قبل محاولة الحفظ للتأكد من صحتها
                Log::info('Attempting to create semester with data:', $semesterData);

                $newSemester = Semester::create($semesterData);

                if (!$newSemester) {
                    throw new \Exception('Failed to create semester record');
                }
            }

            DB::commit();
            return redirect()->route("create_semester")
                ->with('success', 'Semesters added successfully.');
        }
        catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating semesters: ' . $e->getMessage());
            Log::error($e->getTraceAsString());

            return redirect()->back()
                ->with('error', 'Error: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $validated = $request->validate([
            'year' => 'required|string',
            'semester' => 'required|integer|min:1|max:3',
        ]);

        $semesterData = Semester::where('year', $validated['year'])
            ->where('semester_number', $validated['semester'])
            ->with('level.category')
            ->get();

        // dd($semesterData);

        return view('superadmin.views.semester.show', compact('semesterData', 'validated'));
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
