<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagePengujianController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.page_pengujian');
    }
}
