<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\TestMonial;
use Illuminate\Http\Request;

class TestMonialController extends Controller
{
    public function index()
    {
        $testmonials = TestMonial::orderBy('id', 'DESC')->get();
        return response()->json([
            'testmonials' => $testmonials,
        ], 200);
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'function' => 'required'
        ]);

        $testmonial = new TestMonial();
        $testmonial->name = $request->name;
        $testmonial->function = $request->function;
        $testmonial->rating = $request->rating;
        $testmonial->testinomy = $request->testinomy;
        if ($request->hasFile('image')) {
            $file_name = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('upload'), $file_name);
            $testmonial->image = $file_name;
        }
        $testmonial->save();
    }

    public function edit($id)
    {
        $testmonial = TestMonial::find($id);
        return response()->json([
            'testmonial' => $testmonial,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'function' => 'required'
        ]);

        $testmonial = TestMonial::find($id);
        $testmonial->name = $request->name;
        $testmonial->function = $request->function;
        $testmonial->rating = $request->rating;
        $testmonial->testinomy = $request->testinomy;
        if ($testmonial->image != $request->image) {
            $upload_path = public_path() . "/upload/";
            $image = $upload_path . $testmonial->image;
            if (file_exists($image)) {
                @unlink($image);
            }
            $file_name = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('upload'), $file_name);
            $testmonial->image = $file_name;
        }
        $testmonial->save();
    }

    public function delete($id){
        $testmonial = TestMonial::find($id);
        $testmonial->delete();
    }
}
