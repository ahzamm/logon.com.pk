<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Hash;
use App\Models\UserMenuAccess;
use DB;
use Auth;
use Validator;
use App\Models\SubMenu;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Admin::where('role', 'employee')->get();
        return view('admin.employee.index', compact('employees'));
    }

    public function create()
    {
        return view('admin.employee.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        DB::transaction(function () use ($request) {
            $admin = Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'employee',
            ]);
            $submenus = SubMenu::all();
            foreach ($submenus as $key => $submenu) {
                UserMenuAccess::create([
                    'user_id' => $admin->id,
                    'sub_menu_id' => $submenu->id,
                    'status' => 0,
                ]);
            }
        }, 3);
        return redirect()->route('employee.index')->with('success', 'Employee Added Successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $employee = Admin::find($id);
        return view('admin.employee.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'password' => ['nullable', 'string', 'min:8'],
        ]);
        if ($request->password != null) {
            Admin::find($id)->update(['password' => Hash::make($request->password)]);
            return redirect()->route('employee.index')->with('success', 'Employee Updated Successfully');
        }
        return redirect()->route('employee.index');
    }

    public function updateProfilePic(Request $request, $id)
    {
        $user = Admin::find($id);

        $request->validate(
            [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:max_width=1500,max_height=1500',
            ],
            [
                'image.required' => 'Please upload an image.',
                'image.image' => 'The file must be an image.',
                'image.mimes' => 'Only jpeg, png, jpg, and gif images are allowed.',
                'image.max' => 'The image size should not exceed 2MB.',
                'image.dimensions' => 'The image dimensions should not exceed 1500x1500 pixels.',
            ],
        );

        if ($request->hasFile('image')) {
            if ($user->image && file_exists(public_path('admin/dist/img/' . $user->image))) {
                unlink(public_path('admin/dist/img/' . $user->image));
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::random(10) . '.' . $extension;
            $file->move(public_path('admin/dist/img/'), $filename);

            $user->image = $filename;
            $user->save();

            return redirect()->back()->with('success', 'Profile Pic Updated!');
        }

        return redirect()->back();
    }

    public function updatePassword(Request $request)
    {
        $validatedData = [
            'oldpassword' => 'required',
            'newpassword' => 'required|confirmed',
        ];

        $valdiate = Validator::make($request->all(), $validatedData);
        if ($valdiate->fails()) {
            return redirect()->back()->withInput()->with('error', 'All Fields are required');
        }

        if (Hash::check($request->oldpassword, Auth::user()->password)) {
            Auth::user()->update([
                'password' => Hash::make($request->newpassword),
            ]);
            return redirect()->back()->with('success', 'Password Updated Successfully');
        } else {
            return redirect()->back()->with('error', 'Old and new password didnt match');
        }
    }

    public function destroy(Request $request, $id)
    {
        $admin = Admin::find($id);
        if ($admin) {
            $admin->delete();
            return response()->json(['status' => true]);
        }
    }

    public function showAccess($id)
    {
        $userAccesses = UserMenuAccess::where('user_id', $id)->get();
        return view('admin.employee.showAccess', compact('userAccesses'));
    }
    public function updateAccess(Request $request, $id)
    {
        $userAccess = UserMenuAccess::find($id);
        $userAccess->status = $request->access_status;
        $userAccess->save();
        return response()->json(['status' => true]);
    }

    public function changeStatus(Request $request)
    {
        $status = $request->status;
        $id = $request->id;

        $statusChange = Admin::where('id', $id)->update(['active' => $status]);
        if ($statusChange) {
            return response()->json('success');
        } else {
            return response()->json('error');
        }
    }
}
