<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::orderBy('id', 'ASC')->get();
        return response()->json([
            'educations' => $educations
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'institution' => 'required',
            'period' => 'required',
            'degree' => 'required',
            'department' => 'required'
        ]);

        $education = new Education();
        $education->institution = $request->institution;
        $education->degree = $request->degree;
        $education->period = $request->period;
        $education->department = $request->department;
        $education->save();
    }

    public function updateEducation(Request $request, $id)
    {

        $request->validate([
            'institution' => 'required',
            'period' => 'required',
            'degree' => 'required',
            'department' => 'required'
        ]);

        $education = Education::find($id);
        $education->institution = $request->institution;
        $education->degree = $request->degree;
        $education->period = $request->period;
        $education->department = $request->department;
        $education->save();
    }

    public function deleteEducation($id)
    {
        $education = Education::find($id);
        $education->delete();
    }
}
