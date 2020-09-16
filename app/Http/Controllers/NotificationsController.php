<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class NotificationsController extends Controller
{
    public function show()
    {
        $notifications = auth()->user()->unreadNotifications;
        $notifications->markAsRead();
        return view('notifications.show',[
            'notifications' => $notifications
        ]);
    }

    public function update()
    {
        $notifications = auth()->user()->unreadNotifications;
        $notifications->markAsRead();

        $count_notify = auth()->user()->unreadNotifications->count();
        return response()->json(['count_notify' => $count_notify]);

    }
}
