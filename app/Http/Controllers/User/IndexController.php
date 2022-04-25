<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;

class IndexController extends Controller
{
    public function Index()
    {
        return view('user.pages.index')
            ->with('title', 'Welcom User');
    }
}