<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function edit()
    {
        $about = About::latest()->first();
        return response()->json([
            'about' => $about
        ], 200);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email'=> 'required'
        ]);
        
        $about = About::latest()->first();

        if (!$about) {
            return response()->json(['message' => 'No about record found'], 404);
        }

        $about->name = $request->name;
        $about->email = $request->email;
        $about->phone = $request->phone;
        $about->address = $request->address;
        $about->description = $request->description;
        $about->summary = $request->summary;
        $about->tagline = $request->tagline;

        /* ---------- HOME IMAGE ---------- */
        if ($request->hasFile('home_image')) {

            if ($about->home_image && file_exists(public_path('upload/' . $about->home_image))) {
                unlink(public_path('upload/' . $about->home_image));
            }

            $homeImageName = time() . '_home.' . $request->home_image->getClientOriginalExtension();
            $request->home_image->move(public_path('upload'), $homeImageName);
            $about->home_image = $homeImageName;
        }

        /* ---------- BANNER IMAGE ---------- */
        if ($request->hasFile('banner_image')) {

            if ($about->banner_image && file_exists(public_path('upload/' . $about->banner_image))) {
                unlink(public_path('upload/' . $about->banner_image));
            }

            $bannerImageName = time() . '_banner.' . $request->banner_image->getClientOriginalExtension();
            $request->banner_image->move(public_path('upload'), $bannerImageName);
            $about->banner_image = $bannerImageName;
        }

        /* ---------- CV ---------- */
        if ($request->hasFile('cv')) {

            if ($about->cv && file_exists(public_path('upload/' . $about->cv))) {
                unlink(public_path('upload/' . $about->cv));
            }

            $cvName = time() . '_cv.' . $request->cv->getClientOriginalExtension();
            $request->cv->move(public_path('upload'), $cvName);
            $about->cv = $cvName;
        }

        $about->save();

        return response()->json(['message' => 'Updated successfully']);
    }

}
