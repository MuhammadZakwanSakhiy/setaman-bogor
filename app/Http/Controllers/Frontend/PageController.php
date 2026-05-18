<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function tentang()
    {
        return view('kontak-tentang');
    }

    public function kontak()
    {
        return view('kontak-tentang');
    }

    public function privasi()
    {
        return view('welcome'); // Placeholder
    }
}
