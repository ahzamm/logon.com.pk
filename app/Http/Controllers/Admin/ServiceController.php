<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public $icons = ['flaticon-analysis', 'flaticon-startup', 'flaticon-profit', 'flaticon-server', 'flaticon-server-1', 'flaticon-growth', 'flaticon-strategy', 'flaticon-innovation', 'flaticon-creativity', 'flaticon-marketing', 'flaticon-teamwork', 'flaticon-technology', 'flaticon-leadership', 'flaticon-presentation', 'flaticon-business', 'flaticon-data', 'flaticon-research', 'flaticon-idea', 'flaticon-education', 'flaticon-network', 'flaticon-communication', 'flaticon-finance', 'flaticon-analytics', 'flaticon-report', 'flaticon-goal', 'flaticon-success', 'flaticon-collaboration', 'flaticon-support', 'flaticon-development', 'flaticon-strategy', 'flaticon-feedback', 'flaticon-planning', 'flaticon-vision'];

    public function index(Request $request)
    {
        $services = Service::orderby('sortIds', 'asc')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create(Request $request)
    {
        $icons = $this->icons;
        return view('admin.services.create', compact('icons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'heading' => 'required',
            'text' => 'required',
            'icon' => 'required',
        ]);

        $maxSortId = Service::max('sortIds');
        $service = new Service();
        $service->heading = $request->heading;
        $service->text = $request->text;
        $service->icon = $request->icon;
        $service->sortIds = $maxSortId !== null ? $maxSortId + 1 : 0;
        $service->save();

        return redirect()->route('service.index')->with('success', 'Service Added successfully!');
    }

    public function edit(Request $request, $id)
    {
        $icons = $this->icons;
        $service = Service::find($id);
        return view('admin.services.edit', compact('service', 'icons'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'heading' => 'required',
            'text' => 'required',
            'icon' => 'required',
        ]);

        $service = Service::findOrFail($id);
        $service->heading = $request->heading;
        $service->text = $request->text;
        $service->icon = $request->icon;
        $service->save();

        return redirect()->route('service.index')->with('success', 'Service updated successfully!');
    }

    public function destroy(Request $request, $id)
    {
        Service::find($id)->delete();
        return response()->json(['status' => true]);
    }
    public function sort(Request $request)
    {
        $sortIds = $request->sort_Ids;
        foreach ($sortIds as $key => $value) {
            $menu = Service::find($value);
            if ($menu) {
                $menu->sortIds = $key;
                $menu->save();
            }
        }
        $frontValue = Service::orderby('sortIds', 'asc')->get();
        return response()->json($frontValue);
    }

    public function change_status(Request $request)
    {
        $status = $request->status;
        $id = $request->id;

        $statusChange = Service::where('id', $id)->update(['is_active' => $status]);
        if ($statusChange) {
            return response()->json('success');
        } else {
            return response()->json('error');
        }
    }
}
