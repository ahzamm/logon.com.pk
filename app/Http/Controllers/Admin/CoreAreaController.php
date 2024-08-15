<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CoreArea;
use App\Models\City;
use Validator;
class CoreAreaController extends Controller
{
    public function __construct()
    {
        //
    }

    public function index()
    {
        $coreAreas = CoreArea::all();
        return view('admin.coreareas.index', compact('coreAreas'));
    }

    public function create()
    {
        $cities = City::where('active', 1)->get();
        return view('admin.coreareas.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'area_name' => 'required|unique:core_areas,name',
            'city' => 'required',
        ]);
        if ($validator->passes()) {
            $coreArea = new CoreArea();
            $coreArea->name = $request->area_name;
            $coreArea->city_id = $request->city;
            $coreArea->save();
            return response()->json(['status' => true]);
        } else {
            return response()->json(['error' => $validator->errors()->all()]);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $cities = City::where('active', 1)->get();
        $coreArea = CoreArea::find($id);
        return view('admin.coreareas.edit', compact('cities', 'coreArea'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'area_name' => 'required|unique:core_areas,name,' . $request->id,
            'city' => 'required',
        ]);
        if ($validator->passes()) {
            $coreArea = CoreArea::find($request->id);
            $coreArea->name = $request->area_name;
            $coreArea->city_id = $request->city;
            $coreArea->save();
            return response()->json(['status' => true]);
        } else {
            return response()->json(['error' => $validator->errors()->all()]);
        }
    }

    public function destroy($id)
    {
        try {
            $coreArea = CoreArea::find($id);
            $coreArea->delete();
            return response()->json(['status' => true]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false]);
        }
    }

    public function changeStatus(Request $request)
    {
        $status = $request->status;
        $id = $request->id;

        $statusChange = CoreArea::where('id', $id)->update(['active' => $status]);
        if ($statusChange) {
            return response()->json('success');
        } else {
            return response()->json('error');
        }
    }
}
