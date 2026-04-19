<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('id', 'DESC')->with('skills')->get();
        return response()->json([
            'services' => $services
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'icon' => 'required|string',
            'description' => 'required|string',
        ]);

        $service = new Service();
        $service->name = $request->name;
        $service->icon = $request->icon;
        $service->description = $request->description;
        $service->save();

        return response()->json([
            'message' => 'Service created successfully'
        ], 201);
    }

    public function updateService(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'icon' => 'required|string',
            'description' => 'required|string',
        ]);
        $service = Service::find($id);
        $service->name = $request->name;
        $service->icon = $request->icon;
        $service->description = $request->description;
        $service->save();

        return response()->json([
            'message' => 'Service updated successfully'
        ], 201);
    }

    public function deleteService($id)
    {
        $service = Service::find($id);
        $service->delete();
        return response()->json([
            'message' => 'Service deleted successfully'
        ], 201);
    }
}
