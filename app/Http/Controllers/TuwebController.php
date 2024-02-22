<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TuwebController extends Controller
{
    public function index()
    {
        return view('jadwaltuweb.jadwaltuwebmhs');
    }
}
