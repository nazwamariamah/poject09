<?php

namespace App\Http\Controllers\PPSPM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PPSPMController extends Controller
{
    function index()
    {
        return view('ppspm.dashboard');
    }
}
