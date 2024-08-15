<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CoreArea;
use App\Models\ZoneArea;
use Validator;

class ZoneAreaController extends Controller
{
    public function __construct()
    {
        //
    }
    public function index()
    {
        $zoneAreas = ZoneArea::all();
        return view('admin.zoneareas.index', compact('zoneAreas'));
    }

    public function create()
    {
        $coreAreas = CoreArea::where('active', 1)->get();
        return view('admin.zoneareas.create', compact('coreAreas'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'zone_name' => 'required|unique:zone_areas,name',
            'core_area' => 'required',
        ]);
        if ($validator->passes()) {
            $zoneArea = new ZoneArea();
            $zoneArea->name = $request->zone_name;
            $zoneArea->core_area_id = $request->core_area;
            $zoneArea->save();
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
        $coreAreas = CoreArea::where('active', 1)->get();
        $zoneArea = ZoneArea::find($id);
        return view('admin.zoneareas.edit', compact('coreAreas', 'zoneArea'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'zone_name' => 'required|unique:zone_areas,name,' . $request->id,
            'core_area' => 'required',
        ]);
        if ($validator->passes()) {
            $zoneArea = ZoneArea::find($request->id);
            $zoneArea->name = $request->zone_name;
            $zoneArea->core_area_id = $request->core_area;
            $zoneArea->save();
            return response()->json(['status' => true]);
        } else {
            return response()->json(['error' => $validator->errors()->all()]);
        }
    }

    public function destroy($id)
    {
        try {
            $zoneArea = ZoneArea::find($id);
            $zoneArea->delete();
            return response()->json(['status' => true]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false]);
        }
    }

    public function changeStatus(Request $request)
    {
        $status = $request->status;
        $id = $request->id;

        $statusChange = ZoneArea::where('id', $id)->update(['active' => $status]);
        if ($statusChange) {
            return response()->json('success');
        } else {
            return response()->json('error');
        }
    }
}
