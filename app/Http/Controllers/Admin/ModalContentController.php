<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ModalContent;
use DB;
use Illuminate\Support\Str;
use Image;

class ModalContentController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkuseraccess', ['only' => ['index']]);
    }

    public function index()
    {
        $content = ModalContent::all();
        return view('admin.modalcontent.index', compact('content'));
    }

    public function create()
    {
        return view('admin.modalcontent.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:modal_contents,title',
            'banner_image' => 'required|image|max:2000',
            'content' => 'required',
        ]);
        DB::transaction(function () use ($request) {
            $modal = new ModalContent();
            $modal->title = $request->title;
            $modal->content = $request->content;
            $modal->image = '';
            $modal->save();
            //upload Image
            if ($request->hasFile('banner_image')) {
                $image = $request->file('banner_image');
                $extension = $request->file('banner_image')->extension();
                $fileName = Str::random(10) . '_' . time() . '.' . $extension; //File Name for save file in folder
                $img = Image::make($image->path());
                $img->resize(750, 280, function ($constraint) {})->save(public_path('/modalimages') . '/' . $fileName);
                $modal->image = $fileName;
                $modal->save();
            }
        }, 2);
        return redirect()->route('modalcontent.index')->with('success', 'Popup Added Successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $content = ModalContent::find($id);
        return view('admin.modalcontent.edit', compact('content'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'banner_image' => 'nullable|image',
        ]);
        try {
            DB::transaction(function () use ($request, $id) {
                $modal = ModalContent::find($id);
                $modal->title = $request->title;
                $modal->content = $request->content;
                $modal->save();
                //upload Image
                if ($request->hasFile('banner_image')) {
                    if ($modal->image != null) {
                        unlink(public_path('/modalimages/' . $modal->image));
                    }
                    $image = $request->file('banner_image');
                    $extension = $request->file('banner_image')->extension();
                    $fileName = Str::random(10) . '_' . time() . '.' . $extension; //File Name for save file in folder
                    $image->move(public_path('/modalimages'), $fileName);
                    $modal->image = $fileName;
                    $modal->save();
                }
            }, 2);
            return redirect()->route('modalcontent.index')->with('success', 'Popup Updated Successfully');
        } catch (\Throwable $th) {
        }
    }

    public function destroy(Request $request, $id)
    {
        $modalcontent = ModalContent::find($id);
        if ($modalcontent) {
            $modalcontent->delete();
            return response()->json(['status' => true]);
        }
    }

    public function changeStatus(Request $request)
    {
        $status = $request->status;
        $id = $request->id;

        $statusChange = ModalContent::where('id', $id)->update(['active' => $status]);
        if ($statusChange) {
            return response()->json('success');
        } else {
            return response()->json('error');
        }
    }
}
