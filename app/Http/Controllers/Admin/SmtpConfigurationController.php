<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserMenuAccess;
use App\Models\SmtpEmail;

class SmtpConfigurationController extends Controller
{
    public $parentModel = SmtpEmail::class;
    public function index()
    {
        $data['email'] = $this->parentModel::all();
        return view('admin.smtp-configurations.index')->with('data', $data);
    }

    public function create(Request $request)
    {
        $data['action'] = 'create';
        return view('admin.smtp-configurations.create')->with('data', $data);
    }

    public function edit($id = null)
    {
        $data['action'] = 'edit';
        $data['email'] = $this->parentModel::where('id', $id)->first();
        return view('admin.smtp-configurations.create')->with('data', $data);
    }

    public function store(Request $request)
    {
        $smtp_password = $request->password;
        $server = $request->smtp_server;
        $port = $request->port;
        $email = $request->email;

        $createEmail = $this->parentModel::create([
            'emails' => $email,
            'smtp_password' => $smtp_password,
            'smtp_server' => $server,
            'port' => $port,
        ]);

        if ($createEmail == true) {
            return redirect()->route('smtp-configuration.index')->With('success', 'Email has Been Created');
        } else {
            return redirect()->back()->with('error', 'Failed to create Email');
        }
    }
    public function update(Request $request, $id = null)
    {
        $smtp_password = $request->password;
        $server = $request->smtp_server;
        $port = $request->port;
        $email = $request->email;
        $createEmail = $this->parentModel::where('id', $id)->update([
            'emails' => $email,
            'smtp_password' => $smtp_password,
            'smtp_server' => $server,
            'port' => $port,
        ]);

        if ($createEmail == true) {
            return redirect()->route('smtp-configuration.index')->With('success', 'Email has Been Updated');
        } else {
            return redirect()->back()->with('error', 'Failed to Update Email');
        }
    }
    public function change_status(Request $request)
    {
        $status = $request->status;
        $id = $request->id;

        $statusChange = $this->parentModel::where('id', $id)->update([
            'status' => $status,
        ]);
        $changeOthersStatus = $this->parentModel::where('id', '!=', $id)->update([
            'status' => 0,
        ]);

        if ($statusChange) {
            return response()->json('success');
        } else {
            return response()->json('error');
        }
    }
    public function destroy($id = null)
    {
        $delete = $this->parentModel::where('id', $id)->delete();

        if ($delete == true) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    public function show($id)
    {
        //
    }
}
