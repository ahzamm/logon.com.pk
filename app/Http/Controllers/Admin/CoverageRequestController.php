<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CoverageRequest;

class CoverageRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkuseraccess', ['only' => ['index', 'create']]);
    }
    public function index()
    {
        $coveragerequest = CoverageRequest::all();
        return view('admin.coveragerequest.index', compact('coveragerequest'));
    }

    public function show($id)
    {
        $coveragerequest = CoverageRequest::find($id);
        return view('admin.coveragerequest.show-modal', compact('coveragerequest'));
    }

    public function destroy(Request $request, $id)
    {
        $coveragerequest = CoverageRequest::find($id);
        if ($coveragerequest) {
            $coveragerequest->delete();
            return response()->json(['status' => true]);
        }
    }
}
