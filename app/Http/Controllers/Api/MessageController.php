<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MessageController extends Controller
{
    public function messages(User $user)
    {
        $userFrom = Auth::user()->id;
        $userTo = $user->id;

        $messages = Message::where(
            function ($query) use ($userFrom, $userTo) {
                $query->where([
                    'from' => $userFrom,
                    'to'   => $userTo
                ]);
            }
        )->orWhere(
            function ($query) use ($userFrom, $userTo) {
                $query->where([
                    'from' => $userTo,
                    'to' => $userFrom
                ]);
            }
        )->orderBy('created_at', 'ASC')->get();

        return response()->json([
            'messages' => $messages
        ], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $params = $request->only(['content', 'to']);
        $message = Message::create([
            'from'      => Auth::user()->id,
            'to'        => $params['to'],
            'content'   => filter_var($params['content'], FILTER_SANITIZE_STRIPPED)
        ]);

        return response()->json([
            'message' => $message
        ], Response::HTTP_OK);
    }
}
