<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\UserMenuAccess;
use App\Models\ActionLog;

class UserMenuAccessController extends Controller
{
    public function index()
    {
        $users = User::where('active', 1)->get();
        return view('usermenuaccess.index', compact('users'));
    }
    public function show($id)
    {
        $userAccesses = UserMenuAccess::where('user_id', $id)->get();
        return view('usermenuaccess.show', compact('userAccesses'));
    }
    public function update(Request $request, $id)
    {
        $userAccess = UserMenuAccess::find($id);
        $userAccess->status = $request->access_status;
        $userAccess->save();
        ActionLog::userActivityLog(__CLASS__, __FUNCTION__, 'Add User Menu Access. User Access Id:' . $userAccess->id . ' Access Status: ' . $request->access_status);
        return response()->json(['status' => true]);
    }
}
