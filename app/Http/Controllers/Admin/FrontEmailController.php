<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FrontEmail;

class FrontEmailController extends Controller
{
    public function index()
    {
        $frontemails = FrontEmail::all();
        return view('admin.front-email.index', compact('frontemails'));
    }

    public function create()
    {
        return view('admin.front-email.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
