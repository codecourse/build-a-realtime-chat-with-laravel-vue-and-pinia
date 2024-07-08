<?php

namespace App\Http\Controllers;

use App\Http\Resources\MessageResource;
use App\Models\Room;
use Illuminate\Http\Request;

class MessageIndexController extends Controller
{
    public function __invoke(Room $room)
    {
        return MessageResource::collection(
            $room->messages()->with('user')->latest()->paginate(20)
        );
    }
}
