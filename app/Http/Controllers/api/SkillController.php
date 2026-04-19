<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::with('service')->orderBy('id', 'DESC')->get();
        return response()->json([
            'skills' => $skills
        ], 200);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'proficiency' => 'required',
        ]);

        $skill = new Skill();
        $skill->name = $request->name;
        $skill->proficiency = $request->proficiency;
        $skill->service_id = $request->service_id;
        $skill->save();
    }

    public function updateSkill(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'proficiency' => 'required',
        ]);
        $skill = Skill::find($id);
        $skill->name = $request->name;
        $skill->proficiency = $request->proficiency;
        $skill->service_id = $request->service_id;
        $skill->save();

    }

    public function deleteSkill($id)
    {
        $skill = Skill::find($id);
        $skill->delete();
    }
}
