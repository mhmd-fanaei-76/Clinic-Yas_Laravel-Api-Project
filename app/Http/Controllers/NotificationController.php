<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function indexNotification()
    {
        $user = User::query()->find(auth()->user()->id);
        $notification = $user->notifications;
        return NotificationResource::collection($notification);
    }
}
