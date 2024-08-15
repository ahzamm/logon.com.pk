<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use Illuminate\Support\Str;
use Image;
use Auth;
use DB;
use App\Models\FrontEmail;
class CitiesController extends Controller
{
    public function index()
    {
        $cities = City::all();
        return view('admin.cities.index', compact('cities'));
    }

    public function create()
    {
        return view('admin.cities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'city_name' => 'required',
            'province' => 'required',
        ]);
        try {
            DB::transaction(function () use ($request) {
                $city = new City();
                $city->name = $request->city_name;
                $city->province = $request->province;
                $city->created_by = Auth::user()->name;
                $city->updated_by = Auth::user()->name;
                $city->save();
            }, 2);
            return redirect()->route('cities.index')->with('success', 'City Added Successfully');
        } catch (\Throwable $th) {
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $city = City::find($id);
        return view('admin.cities.edit', compact('city'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'city_name' => 'required',
            'city_image' => 'image|max:2000',
        ]);
        DB::transaction(function () use ($request, $id) {
            $city = City::find($id);
            $city->name = $request->city_name;
            $city->updated_by = Auth::user()->name;
            $city->save();
            //upload Image
            if ($request->hasFile('city_image')) {
                if ($city->image != null) {
                    unlink(public_path('/cityimages/' . $city->image));
                }
                $image = $request->file('city_image');
                $extension = $request->file('city_image')->extension();
                $fileName = Str::random(10) . '_' . time() . '.' . $extension;

                $img = Image::make($image->path());
                $img->resize(256, 256, function ($constraint) {})->save(public_path('/cityimages') . '/' . $fileName);
                $city->image = $fileName;
                $city->save();
            }
        }, 2);
        return redirect()->route('cities.index')->with('success', 'City Updated Successfully');
    }

    public function destroy(Request $request, $id)
    {
        $city = City::find($id);
        if ($city) {
            $city->delete();
            return response()->json(['status' => true]);
        }
    }
    public function partnerEmail($flag)
    {
        if ($flag == 'c') {
            $frontEmail = FrontEmail::where('name', 'consumeruser')->first();
        } else {
            $frontEmail = FrontEmail::where('name', 'consumerpartner')->first();
        }
        $emails = explode(' ', preg_replace("/\r|\n/", '', $frontEmail->emails));
        return view('admin.front-contact.editemail', compact('emails', 'frontEmail'));
    }
    public function updateEmail(Request $request)
    {
        $email = FrontEmail::find($request->emailId);
        $email->emails = implode(' ', $request->emails);
        $email->save();
        return response()->json(['status' => true]);
    }

    public function changeStatus(Request $request)
    {
        $status = $request->status;
        $id = $request->id;

        $statusChange = City::where('id', $id)->update(['active' => $status]);
        if ($statusChange) {
            return response()->json('success');
        } else {
            return response()->json('error');
        }
    }
}
