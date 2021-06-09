<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InstagramAuthController extends Controller
{
    public function show() {
        $profile = \Dymantic\InstagramFeed\Profile::where('username', 'wunderkrafts')->first();
    
        return view('admin.instagram-auth-page', ['instagram_auth_url' => $profile->getInstagramAuthUrl()]);
    }
}
