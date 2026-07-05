<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\notifications;

class NotificationController extends BaseController {

    public function read($id)
    {
        $notification = notifications::where('id', $id)
            ->where('user_id', Auth::user()->user_id)
            ->firstOrFail();

        $notification->update([
            'is_read' => 1
        ]);

        return back();
    }


}
