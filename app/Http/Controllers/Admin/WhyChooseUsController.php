<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WhyChooseUs;
use DB;
class WhyChooseUsController extends Controller
{
    public $icons = ['flaticon-analysis', 'flaticon-startup', 'flaticon-server-1', 'flaticon-growth', 'flaticon-strategy', 'flaticon-innovation', 'flaticon-creativity', 'flaticon-marketing', 'flaticon-teamwork', 'flaticon-technology', 'flaticon-leadership', 'flaticon-presentation', 'flaticon-business', 'flaticon-data', 'flaticon-research', 'flaticon-idea', 'flaticon-education', 'flaticon-network', 'flaticon-communication', 'flaticon-finance', 'flaticon-analytics', 'flaticon-report', 'flaticon-goal', 'flaticon-success', 'flaticon-collaboration', 'flaticon-support', 'flaticon-development', 'flaticon-strategy', 'flaticon-feedback', 'flaticon-planning', 'flaticon-vision'];
    public function __construct()
    {
        $this->middleware('checkuseraccess', ['only' => ['index', 'create']]);
    }
    public function index()
    {
        $whychooseus = WhyChooseUs::orderby('sortIds', 'asc')->get();
        return view('admin.why-choose-us.index', compact('whychooseus'));
    }

    public function create()
    {
        $icons = $this->icons;
        return view('admin.why-choose-us.create', compact('icons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required',
            'heading' => 'required',
            'text' => 'required',
        ]);
        try {
            DB::transaction(function () use ($request) {
                $whychooseus = new WhyChooseUs();
                $whychooseus->text = $request->text;
                $whychooseus->heading = $request->heading;
                $whychooseus->icon = $request->icon;
                $whychooseus->save();
            }, 2);
            return redirect()->route('why-choose-us.index')->with('success', 'Why Choose Us Card Added Successfully');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function show($id)
    {
        $whychooseus = WhyChooseUs::find($id);
        return view('admin.why-choose-us.show-modal', compact('whychooseus'));
    }

    public function edit($id)
    {
        $icons = $this->icons;
        $whychooseus = WhyChooseUs::find($id);
        return view('admin.why-choose-us.edit', compact('whychooseus', 'icons'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'heading' => 'required',
            'text' => 'required',
            'icon' => 'required',
        ]);

        try {
            DB::transaction(function () use ($request, $id) {
                $whychooseus = WhyChooseUs::find($id);
                $whychooseus->heading = $request->heading;
                $whychooseus->text = $request->text;
                $whychooseus->icon = $request->icon;
                $whychooseus->save();
            }, 2);
            return redirect()->route('why-choose-us.index')->with('success', 'Why Choose Us Card Updated Successfully');
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public function destroy(Request $request, $id)
    {
        $whychooseus = WhyChooseUs::find($id);
        if ($whychooseus) {
            $whychooseus->delete();
            return response()->json(['status' => true]);
        }
    }

    public function changeStatus(Request $request)
    {
        $status = $request->status;
        $id = $request->id;

        $statusChange = WhyChooseUs::where('id', $id)->update(['is_active' => $status]);
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
            $item = WhyChooseUs::find($value);
            if ($item) {
                $item->sortIds = $key;
                $item->save();
            }
        }
        $responseValue = WhyChooseUs::orderby('sortIds', 'asc')->get();
        return response()->json($responseValue);
    }
}
