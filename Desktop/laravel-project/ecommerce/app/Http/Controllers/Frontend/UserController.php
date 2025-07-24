<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    public function index()
    {
        // Kullanıcıların listelendiği sayfa
        return View::make('frontend.user.index');
    }
}
