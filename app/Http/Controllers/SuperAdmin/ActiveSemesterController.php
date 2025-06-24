<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreActiveSemesterRequest;
use App\Models\Level;
use App\Models\Semester;
use Illuminate\Http\Request;

class ActiveSemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $levels = Level::with(['semesters', 'category'])
        //     ->has('semesters')
        //     ->paginate();
        // if ($levels->isEmpty())
        // {
        //     return redirect()->route('create_level')->with('error', 'No levels found. Please create a level first.');
        // }
        return view('superadmin.views.active_semester.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreActiveSemesterRequest $request)
    {
        $data = $request->validated();
        // dd($data);
        try
        {
            $semesters = Semester::all();
            foreach ($semesters as $semester)
            {
                // $semester->status = ($semester->semester_number == $data["semester_number"]);
                $semester->status = ($semester->semester_number == $data["semester_number"]) ? 1 : 0;
                $semester->save();
            }

            return redirect()->back()->with('success', 'The selected term has been activated successfully.');

        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('error', 'Something went wrong , please try again');
        }

    }
}
