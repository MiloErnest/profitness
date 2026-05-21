<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OnlineTrainingController extends Controller
{
    public function index()
    {
        return view('online-training');
    }
}
