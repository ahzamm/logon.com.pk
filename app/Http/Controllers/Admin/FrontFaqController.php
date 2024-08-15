<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FrontFaq;

class FrontFaqController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkuseraccess', ['only' => ['index', 'create']]);
    }

    public function index()
    {
        $frontfaq = FrontFaq::orderby('sortIds', 'asc')->get();
        return view('admin.front-faq.index', compact('frontfaq'));
    }

    public function create()
    {
        return view('admin.front-faq.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);
        $lastFaqCount = FrontFaq::orderBy('faq_order')->get()->last();
        $faq = new FrontFaq();
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $maxSortId = FrontFaq::max('sortIds');
        $faq->sortIds = $maxSortId !== null ? $maxSortId + 1 : 0;
        $faq->save();
        return redirect()->route('front-faqs.index')->with('success', 'FAQ Added Successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $faq = FrontFaq::find($id);
        return view('admin.front-faq.edit', compact('faq'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);
        $faq = FrontFaq::find($id);
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->save();
        return redirect()->route('front-faqs.index')->with('success', 'FAQ Updated Successfully');
    }

    public function destroy(Request $request, $id)
    {
        $frontfaq = FrontFaq::find($id);
        if ($frontfaq) {
            $frontfaq->delete();
            return response()->json(['status' => true]);
        }
    }
    public function sortPost(Request $request)
    {
        foreach ($request->faq as $key => $item) {
            $faq = FrontFaq::find($item);
            $faq->faq_order = $key;
            $faq->save();
        }
        return response()->json(['status' => true]);
    }

    public function changeStatus(Request $request)
    {
        $status = $request->status;
        $id = $request->id;

        $statusChange = FrontFaq::where('id', $id)->update(['active' => $status]);
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
            $item = FrontFaq::find($value);
            if ($item) {
                $item->sortIds = $key;
                $item->save();
            }
        }
        $responseValue = FrontFaq::orderby('sortIds', 'asc')->get();
        return response()->json($responseValue);
    }
}
