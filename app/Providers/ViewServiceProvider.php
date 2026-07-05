<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Notifications;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('partials.header', function ($view) {

            if (Auth::check()) {

                $notifications = Notifications::where('user_id', Auth::user()->user_id)
//                    ->latest()
//                    ->take(10)
                    ->get();

                $unreadCount = Notifications::where('user_id', Auth::user()->user_id)
                    ->where('is_read', 0)
                    ->count();

            } else {

                $notifications = collect();
                $unreadCount = 0;

            }

            $view->with(compact('notifications', 'unreadCount'));
        });
    }
}
