<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index()
    {
        $media = Media::orderBy('id', 'DESC')->get();
        return response()->json(
            [
                'media' => $media
            ],
            200
        );
    }

    public function store(Request $request){
        $media = new Media();
        $media->link = $request -> link;
        $media->icon = $request -> icon;
        $media -> save();
    }

    public function deleteMedia($id){
        $media = Media::find($id);
        $media -> delete();
    }
}
