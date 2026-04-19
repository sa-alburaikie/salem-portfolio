<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Message;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use App\Models\TestMonial;
use Illuminate\Http\Request;
use Log;
use Mail;

class DashboardController extends Controller
{
    public function index()
    {
        $skillCount = Skill::count();
        $educationCount = Education::count();
        $experienceCount = Experience::count();
        $servicesCount = Service::count();
        $projectCount = Project::count();
        $testmonialCount = TestMonial::count();
        $messageCount = Message::count();
        $projects = Project::orderBy('id', 'DESc')->take(5)->get();
        $testmonials = TestMonial::orderBy('id', 'DESc')->take(5)->get();
        $skills = Skill::orderBy('id', 'DESc')->get();
        $services = Service::orderBy('id', 'DESc')->with('skills')->get();
        return response()->json([
            'skillCount' => $skillCount,
            'educationCount' => $educationCount,
            'experienceCount' => $experienceCount,
            'servicesCount' => $servicesCount,
            'projectCount' => $projectCount,
            'testmonialCount' => $testmonialCount,
            'messageCount' => $messageCount,
            'projects' => $projects,
            'testmonials' => $testmonials,
            'skills' => $skills,
            'services' => $services,
        ], 200);
    }

    public function contactMe(Request $request)
    {
        // Log::info($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'project' => 'required',
            'description' => 'required'
        ]);

        $data = $request->only(['name', 'email', 'project', 'description']);

        Mail::to('smoaa667@gmail.com')->send(new ContactMail($data));

        return response()->json([
            'message' => 'Message sent successfully'
        ], 200);
    }
}
