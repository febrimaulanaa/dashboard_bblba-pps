<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DaftarTutorController extends Controller
{
    public function index()
    {
        return view('daftartutor.index');
    }
}
