<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageStoreRequest;
use App\Http\Resources\MessageResource;
use App\Models\Room;
use Illuminate\Http\Request;

class MessageStoreController extends Controller
{
    public function __invoke(MessageStoreRequest $request, Room $room)
    {
        $message = $room->messages()->make($request->only('body'));
        $message->user()->associate(auth()->user());

        $message->save();

        return MessageResource::make($message);
    }
}
