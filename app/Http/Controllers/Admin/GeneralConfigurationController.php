<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeneralConfiguration;
use Illuminate\Support\Str;

class GeneralConfigurationController extends Controller
{
    public function index()
    {
        $general_configuration = GeneralConfiguration::first();
        return view('admin.general_configurations.index', compact('general_configuration'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'brand_name' => 'required',
            'brand_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'footer_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'site_footer' => 'required',
        ]);

        $general_configuration = GeneralConfiguration::first();

        $images = ['brand_logo', 'favicon', 'footer_logo'];

        foreach ($images as $imageField) {
            if ($request->hasFile($imageField)) {
                // Delete the old image if it exists
                if ($general_configuration->$imageField && file_exists(public_path('site/images/' . $general_configuration->$imageField))) {
                    unlink(public_path('site/images/' . $general_configuration->$imageField));
                }

                // Upload new image
                $file = $request->file($imageField);
                $extension = $file->getClientOriginalExtension();
                $image_filename = Str::random(10) . '.' . $extension;
                $file->move(public_path('site/images/'), $image_filename);

                $general_configuration->$imageField = $image_filename;
            }
        }

        $general_configuration->brand_name = $request['brand_name'];
        $general_configuration->site_footer = $request['site_footer'];
        $general_configuration->save();

        return redirect()->route('general_configurations.index')->with('success', 'Configurations updated successfully!');
    }

    public function change_status(Request $request)
    {
        $Otp = GeneralConfiguration::first();

        $statusChange = $Otp->update([
            'otp_status' => $request->status,
        ]);

        if ($statusChange) {
            return response()->json('success');
        } else {
            return response()->json('error');
        }
    }
}
