<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function Index()
    {
        return view('admin.pages.index')
            ->with('title', 'Welcom Admin');
    }
}
