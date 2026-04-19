<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::orderBy('id', 'DESC')->get();
        return response()->json([
            'messages' => $messages,
        ], 200);
    }

    public function changeStatus(Request $request, $id)
    {
        $message = Message::find($id);
        if ($message->status == '0') {
            $message->status = '1';
        } else {
            $message->status = '0';
        }
        $message->save();
    }

    public function deleteMessage($id)
    {
        $message = Message::find($id);
        $message->delete();
    }
}
