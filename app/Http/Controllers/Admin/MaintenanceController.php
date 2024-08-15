<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MaintenanceMode;
use Artisan;
class MaintenanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkuseraccess', ['only' => ['index']]);
    }
    public function index()
    {
        $mode = MaintenanceMode::first();
        return view('admin.maintenance.index', compact('mode'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'maintenance_time' => 'required|date|after:' . date('Y-m-d H:i:s', strtotime(now())),
        ]);
        MaintenanceMode::whereNotNull('id')->delete();
        $mode = new MaintenanceMode();
        $mode->time = $request->maintenance_time;
        $mode->save();
        Artisan::call('down');
        return redirect()->route('maintenance.index');
    }
    public function deactivate()
    {
        MaintenanceMode::whereNotNull('id')->delete();
        Artisan::call('up');
        return redirect()->route('maintenance.index');
    }
}
