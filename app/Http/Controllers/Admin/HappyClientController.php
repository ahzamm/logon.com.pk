<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HappyClient;
use Illuminate\Http\Request;
class HappyClientController extends Controller
{
    public $icons = ['flaticon-analysis', 'flaticon-startup', 'flaticon-server-1', 'flaticon-growth', 'flaticon-strategy', 'flaticon-innovation', 'flaticon-creativity', 'flaticon-marketing', 'flaticon-teamwork', 'flaticon-technology', 'flaticon-leadership', 'flaticon-presentation', 'flaticon-business', 'flaticon-data', 'flaticon-research', 'flaticon-idea', 'flaticon-education', 'flaticon-network', 'flaticon-communication', 'flaticon-finance', 'flaticon-analytics', 'flaticon-report', 'flaticon-goal', 'flaticon-success', 'flaticon-collaboration', 'flaticon-support', 'flaticon-development', 'flaticon-strategy', 'flaticon-feedback', 'flaticon-planning', 'flaticon-vision'];

    public function index(Request $request)
    {
        $happy_clients = HappyClient::orderby('sortIds', 'asc')->get();
        return view('admin.happy-clients.index', compact('happy_clients'));
    }

    public function create(Request $request)
    {
        $icons = $this->icons;
        return view('admin.happy-clients.create', compact('icons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_type' => 'required',
            'no_of_clients' => 'required|integer|min:1',
        ]);

        $maxSortId = HappyClient::max('sortIds');
        $happy_client = new HappyClient();
        $happy_client->client_type = $request->client_type;
        $happy_client->no_of_clients = $request->no_of_clients;
        $happy_client->sortIds = $maxSortId !== null ? $maxSortId + 1 : 0;
        $happy_client->save();

        return redirect()->route('happy-clients.index')->with('success', 'Happy Client Added successfully!');
    }

    public function edit(Request $request, $id)
    {
        $happy_client = HappyClient::find($id);
        $icons = $this->icons;
        return view('admin.happy-clients.edit', compact('happy_client', 'icons'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'client_type' => 'required',
            'no_of_clients' => 'required|integer|min:1',
        ]);

        $happy_client = HappyClient::findOrFail($id);
        $happy_client->client_type = $request->client_type;
        $happy_client->no_of_clients = $request->no_of_clients;
        $happy_client->save();

        return redirect()->route('happy-clients.index')->with('success', 'Happy Client Updated Successfully!');
    }

    public function destroy(Request $request, $id)
    {
        HappyClient::find($id)->delete();
        return response()->json(['status' => true]);
    }
    public function sort(Request $request)
    {
        $sortIds = $request->sort_Ids;
        foreach ($sortIds as $key => $value) {
            $menu = HappyClient::find($value);
            if ($menu) {
                $menu->sortIds = $key;
                $menu->save();
            }
        }
        $frontValue = HappyClient::orderby('sortIds', 'asc')->get();
        return response()->json($frontValue);
    }

    public function change_status(Request $request)
    {
        $status = $request->status;
        $id = $request->id;

        $statusChange = HappyClient::where('id', $id)->update(['is_active' => $status]);
        if ($statusChange) {
            return response()->json('success');
        } else {
            return response()->json('error');
        }
    }
}
