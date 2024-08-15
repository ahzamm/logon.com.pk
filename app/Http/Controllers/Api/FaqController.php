<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FrontFaq;

class FaqController extends Controller
{
    public function index()
    {
        return response()
        ->json(FrontFaq::where('active', 1)
        ->orderBy('sortIds', 'asc')
        ->select('question', 'answer')
        ->get(), 200);
    }
}
