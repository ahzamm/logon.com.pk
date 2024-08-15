<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ModalContent;
use App\Models\ModalShow;
use Session;
class ModalShowController extends Controller
{
    public function create()
    {
        $content = ModalContent::all();
        $modalShow = ModalShow::first();
        return view('admin.modalshow.create', compact('content', 'modalShow'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
        $data = ModalShow::first();
        if ($data) {
            $data->modal_content_id = $request->content;
            $data->start_date = $request->start_date;
            $data->end_date = $request->end_date;
            $data->save();
        } else {
            $modalShow = new ModalShow();
            $modalShow->modal_content_id = $request->content;
            $modalShow->start_date = $request->start_date;
            $modalShow->end_date = $request->end_date;
            $modalShow->save();
        }
        Session::flash('activate', 'Added');
        return redirect()->route('modalshow.index');
    }

    public function deactivate()
    {
        ModalShow::truncate();
        Session::flash('deactivate', 'Truncate');
        return redirect()->route('modalshow.index');
    }
}
