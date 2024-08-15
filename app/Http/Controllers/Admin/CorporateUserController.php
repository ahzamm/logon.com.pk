<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CorporateUser;
use DB;
use Illuminate\Support\Str;
use Image;

class CorporateUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkuseraccess', ['only' => ['index', 'create']]);
    }

    public function index()
    {
        $corporates = CorporateUser::all();
        return view('admin.corporate.index', compact('corporates'));
    }

    public function create()
    {
        return view('admin.corporate.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'banner_image' => 'required|image|max:2000',
        ]);
        DB::transaction(function () use ($request) {
            $corporate = new CorporateUser();
            $corporate->name = $request->name;
            $corporate->address = $request->address;
            $corporate->email = $request->email;
            $corporate->contact = $request->contact;
            $maxSortId = CorporateUser::max('sortIds');
            $corporate->sortIds = $maxSortId !== null ? $maxSortId + 1 : 0;
            $corporate->save();
            //upload Image
            if ($request->hasFile('banner_image')) {
                $image = $request->file('banner_image');
                $extension = $request->file('banner_image')->extension();
                $fileName = Str::random(10) . '_' . time() . '.' . $extension;

                $img = Image::make($image->path());
                $img->resize(270, 115, function ($constraint) {})->save(public_path('/corporate') . '/' . $fileName);
                $corporate->logo = $fileName;
                $corporate->save();
            }
        }, 2);
        return redirect()->route('corporate.index')->with('success', 'Corporate User Added Successfully');
    }

    public function show($id)
    {
        $corporate = CorporateUser::find($id);
        return view('admin.corporate.show-modal', compact('corporate'));
    }

    public function edit($id)
    {
        $corporate = CorporateUser::find($id);
        return view('admin.corporate.edit', compact('corporate'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'banner_image' => 'nullable|image|max:2000',
        ]);
        DB::transaction(function () use ($request, $id) {
            $corporate = CorporateUser::findOrFail($id);
            $corporate->name = $request->name;
            $corporate->address = $request->address;
            $corporate->email = $request->email;
            $corporate->contact = $request->contact;
            $corporate->order = 1;
            $corporate->save();
            //upload Image
            if ($request->hasFile('banner_image')) {
                if ($corporate->logo && file_exists(public_path('/corporate' . $corporate->logo))) {
                    unlink(public_path('/corporate' . $corporate->logo));
                }
                $image = $request->file('banner_image');
                $extension = $request->file('banner_image')->extension();
                $fileName = Str::random(10) . '_' . time() . '.' . $extension;

                $img = Image::make($image->path());
                $img->resize(270, 115, function ($constraint) {})->save(public_path('/corporate') . '/' . $fileName);
                $corporate->logo = $fileName;
                $corporate->save();
            }
        }, 2);
        return redirect()->route('corporate.index')->with('success', 'Corporate User Updated Successfully');
    }

    public function destroy(Request $request, $id)
    {
        $coporateuser = CorporateUser::find($id);
        if ($coporateuser) {
            $coporateuser->delete();
            return response()->json(['status' => true]);
        }
    }

    public function changeStatus(Request $request)
    {
        $status = $request->status;
        $id = $request->id;

        $statusChange = CorporateUser::where('id', $id)->update(['active' => $status]);
        if ($statusChange) {
            return response()->json('success');
        } else {
            return response()->json('error');
        }
    }

    public function sort(Request $request)
    {
        $sortIds = $request->sort_Ids;
        foreach ($sortIds as $key => $value) {
            $item = CorporateUser::find($value);
            if ($item) {
                $item->sortIds = $key;
                $item->save();
            }
        }
        $responseValue = CorporateUser::orderby('sortIds', 'asc')->get();
        return response()->json($responseValue);
    }
}
