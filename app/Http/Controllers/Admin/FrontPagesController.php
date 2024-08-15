<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FrontPage;
use Auth;
use DB;
use Illuminate\Support\Str;
use Image;
class FrontPagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkuseraccess', ['only' => ['index', 'create']]);
    }
    public function index()
    {
        $pages = FrontPage::all();
        return view('admin.front_pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.front_pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'page_name' => 'required',
            'meta_name' => 'required',
            'meta_description' => 'required',
            'slogan' => 'required',
            'page_title' => 'required',
            'content' => 'required',
            'banner_image' => 'required|image|max:2000',
        ]);
        try {
            DB::transaction(function () use ($request) {
                $frontPage = new FrontPage();
                $frontPage->name = $request->page_name;
                $frontPage->meta_tag = $request->meta_name;
                $frontPage->meta_description = $request->meta_description;
                $frontPage->page_title = $request->page_title;
                $frontPage->content = $request->content;
                $frontPage->slogan = $request->slogan;
                $frontPage->created_by = Auth::user()->name;
                $frontPage->updated_by = Auth::user()->name;
                $frontPage->save();
                //upload Image
                if ($request->hasFile('banner_image')) {
                    $image = $request->file('banner_image');
                    $extension = $request->file('banner_image')->extension();
                    $fileName = Str::random(10) . '_' . time() . '.' . $extension;

                    $img = Image::make($image->path());
                    $img->resize(1920, 580, function ($constraint) {})->save(public_path('/pagesbanner') . '/' . $fileName);

                    $frontPage->banner_image = $fileName;
                    $frontPage->save();
                }
            }, 2);
            return redirect()->route('front-pages.index')->with('success', 'Front Page Added Successfully');
        } catch (\Throwable $th) {
        }
    }

    public function show($id)
    {
        $frontPage = FrontPage::find($id);
        return view('admin.front_pages.show-modal', compact('frontPage'));
    }

    public function edit($id)
    {
        $frontPage = FrontPage::find($id);
        return view('admin.front_pages.edit', compact('frontPage'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'page_name' => 'required',
            'meta_name' => 'required',
            'meta_description' => 'required',
            'slogan' => 'required',
            'page_title' => 'required',
            'content' => 'required',
            'banner_image' => 'image|max:200',
        ]);

        try {
            DB::transaction(function () use ($request, $id) {
                $frontPage = FrontPage::find($id);
                $frontPage->name = $request->page_name;
                $frontPage->meta_tag = $request->meta_name;
                $frontPage->meta_description = $request->meta_description;
                $frontPage->page_title = $request->page_title;
                $frontPage->content = $request->content;
                $frontPage->slogan = $request->slogan;
                $frontPage->updated_by = Auth::user()->name;
                $frontPage->save();
                //upload Image
                if ($request->hasFile('banner_image')) {
                    if ($frontPage->banner_image != null) {
                        unlink(public_path('/pagesbanner/' . $frontPage->banner_image));
                    }
                    $image = $request->file('banner_image');
                    $extension = $request->file('banner_image')->extension();
                    $fileName = Str::random(10) . '_' . time() . '.' . $extension;
                    $image->move(public_path('/pagesbanner'), $fileName);
                    $frontPage->banner_image = $fileName;
                    $frontPage->save();
                }
            }, 2);
            return redirect()->route('front-pages.index')->with('success', 'Front Page Updated Successfully');
        } catch (\Throwable $th) {
        }
    }

    public function destroy(Request $request, $id)
    {
        $frontpage = FrontPage::find($id);
        if ($frontpage) {
            $frontpage->delete();
            return response()->json(['status' => true]);
        }
    }

    public function changeStatus(Request $request)
    {
        $status = $request->status;
        $id = $request->id;

        $statusChange = FrontPage::where('id', $id)->update(['status' => $status]);
        if ($statusChange) {
            return response()->json('success');
        } else {
            return response()->json('error');
        }
    }
}
