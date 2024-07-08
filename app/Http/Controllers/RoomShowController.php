<?php

namespace App\Http\Controllers;

use App\Http\Resources\RoomResource;
use App\Models\Room;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RoomShowController extends Controller
{
    public function __invoke(Room $room)
    {
        return inertia()->render('Room', [
            'room' => RoomResource::make($room)
        ]);
    }
}
