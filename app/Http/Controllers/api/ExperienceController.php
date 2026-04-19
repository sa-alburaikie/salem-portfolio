<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::orderBy('id', 'DESC')->get();
        return response()->json([
            'experiences' => $experiences,
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'company' => 'required',
            'period' => 'required',
            'position' => 'required'
        ]);

        $experience = new Experience();
        $experience->company = $request->company;
        $experience->period = $request->period;
        $experience->position = $request->position;
        $experience->save();
    }

    public function updateExperience(Request $request, $id)
    {
        $request->validate([
            'company' => 'required',
            'period' => 'required',
            'position' => 'required'
        ]);

        $experience = Experience::find($id);
        $experience->company = $request->company;
        $experience->period = $request->period;
        $experience->position = $request->position;
        $experience->save();

    }

    public function deleteExperience($id){
        $experience = Experience::find($id);
        $experience->delete();
    }
}
