<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSlider;
use DB;
use Illuminate\Support\Str;
use Image;

class HomeSliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkuseraccess', ['only' => ['index', 'create']]);
    }

    public function index()
    {
        $sliders = HomeSlider::orderby('sortIds', 'asc')->get();
        return view('admin.homeslider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.homeslider.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slogan' => 'required',
            'banner_image' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!$value->isValid()) {
                        return $fail('Invalid file.');
                    }

                    $mimeType = $value->getMimeType();
                    if (!in_array($mimeType, ['image/jpeg', 'image/png', 'video/mp4'])) {
                        return $fail('The ' . $attribute . ' must be an image or a video.');
                    }

                    // Optionally check file size
                    $maxFileSize = 20000; // KB for images, increase for videos
                    if ($value->getSize() > $maxFileSize * 1024) {
                        return $fail('The ' . $attribute . ' must not be Less than ' . $maxFileSize . ' KB.');
                    }
                },
            ],
            'image_alt' => 'required_if:banner_image,image/jpeg,image/png', // alt text for images only
        ]);

        try {
            DB::transaction(function () use ($request) {
                $homeSlider = new HomeSlider();
                $homeSlider->title = $request->title;
                $homeSlider->slogan = $request->slogan;
                $homeSlider->image = '';
                $homeSlider->image_alt = $request->image_alt;
                $maxSortId = HomeSlider::max('sortIds');
                $homeSlider->sortIds = $maxSortId !== null ? $maxSortId + 1 : 0;
                $homeSlider->save();

                if ($request->hasFile('banner_image')) {
                    $image = $request->file('banner_image');
                    $extension = $image->extension();
                    $fileName = Str::random(10) . '_' . time() . '.' . $extension;
                    $mimeType = $image->getMimeType();

                    if (in_array($mimeType, ['image/jpeg', 'image/png'])) {
                        $img = Image::make($image->path());
                        $img->resize(1903, 720, function ($constraint) {})->save(public_path('/homeslider') . '/' . $fileName);
                    } elseif ($mimeType == 'video/mp4') {
                        // Save video file
                        $image->move(public_path('/homeslider/videos'), $fileName);
                    }

                    $homeSlider->image = $fileName;
                    $homeSlider->save();
                }
            }, 2);

            return redirect()->route('homeslider.index')->with('success', 'Home Slider Added Successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Error while adding Home Slider.');
        }
    }

    public function show($id)
    {
        $homeslider = HomeSlider::find($id);
        return view('admin.homeslider.show-modal', compact('homeslider'));
    }

    public function edit($id)
    {
        $homeslider = HomeSlider::find($id);
        return view('admin.homeslider.edit', compact('homeslider'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'slogan' => 'required',
            'banner_image' => 'image|max:2000',
            'image_alt' => 'required',
        ]);
        DB::transaction(function () use ($request, $id) {
            $homeSlider = HomeSlider::find($id);
            $homeSlider->title = $request->title;
            $homeSlider->slogan = $request->slogan;
            $homeSlider->image_alt = $request->image_alt;
            $homeSlider->save();
            if ($request->hasFile('banner_image')) {
                if ($homeSlider->image != null) {
                    unlink(public_path('/homeslider/' . $homeSlider->image));
                }
                $image = $request->file('banner_image');
                $extension = $request->file('banner_image')->extension();
                $fileName = Str::random(10) . '_' . time() . '.' . $extension;

                $img = Image::make($image->path());
                $img->resize(1903, 720, function ($constraint) {})->save(public_path('/homeslider') . '/' . $fileName);
                $homeSlider->image = $fileName;
                $homeSlider->save();
            }
        }, 2);
        return redirect()->route('homeslider.index')->with('success', 'Home Slider Updated Successfully');
    }

    public function destroy(Request $request, $id)
    {
        $homeslider = HomeSlider::find($id);
        if ($homeslider) {
            $homeslider->delete();
            return response()->json(['status' => true]);
        }
    }

    public function changeStatus(Request $request)
    {
        $status = $request->status;
        $id = $request->id;

        $statusChange = HomeSlider::where('id', $id)->update(['active' => $status]);
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
            $item = HomeSlider::find($value);
            if ($item) {
                $item->sortIds = $key;
                $item->save();
            }
        }
        $responseValue = HomeSlider::orderby('sortIds', 'asc')->get();
        return response()->json($responseValue);
    }
}
