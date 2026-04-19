<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {

        if ($request->searchQuery == "undefined") {
            $projects = Project::orderBy('id', 'DESC')->paginate(2);
        } else {
            $projects = Project::where('name', 'like', '%' . $request->searchQuery . '%')->orderBy('id', 'DESC')->paginate(2);
        }
        return response()->json([
            'projects' => $projects
        ], 200);
    }

    public function projectList()
    {
        $projects = Project::orderBy('id', 'DESC')->get();
        return response()->json([
            'projects' => $projects
        ], 200);

    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $project = new Project();
        $project->name = $request->name;
        $project->description = $request->description;
        $project->link = $request->link;
        if ($request->hasFile('image')) {
            $file_name = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('upload'), $file_name);
            $project->image = $file_name;
        }
        $project->save();
    }

    public function edit($id)
    {
        $project = Project::find($id);
        return response()->json([
            'project' => $project,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $project = Project::find($id);
        $project->name = $request->name;
        $project->description = $request->description;
        $project->link = $request->link;
        if ($project->image != $request->image) {
            $upload_path = public_path() . "/upload/";
            $image = $upload_path . $project->image;
            if (file_exists($image)) {
                @unlink($image);
            }
            $file_name = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('upload'), $file_name);
            $project->image = $file_name;
        }
        $project->save();
    }

    public function deleteProject($id)
    {
        $project = Project::find($id);
        $upload_path = public_path() . "/upload/";
        $image = $upload_path . $project->image;
        if (file_exists($image)) {
            @unlink($image);
        }
        $project->delete();
    }
}
