<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobPost;
use App\Models\JobApplication;
use App\Models\FrontEmail;
use Str;

class JobPostController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkuseraccess', ['only' => ['index', 'create']]);
    }

    public function index()
    {
        $jobs = JobPost::orderby('sortIds', 'asc')->get();
        $data['email_contacts'] = FrontEmail::where('name', 'hr email')->get();
        return view('admin.jobpost.index', compact('jobs', 'data'));
    }

    public function create()
    {
        return view('admin.jobpost.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'post_title' => 'required',
            'job_type' => 'required',
            'city' => 'required',
            'work_experience' => 'required',
            'total_position' => 'required',
            'shift' => 'required',
            'job_description' => 'required|min:20',
        ]);
        $job = new JobPost();
        $job->post_title = $request->post_title;
        $job->job_type = $request->job_type;
        $job->city = $request->city;
        $job->work_experience = $request->work_experience;
        $job->total_positions = $request->total_position;
        $job->shift = $request->shift;
        $job->description = $request->job_description;
        $maxSortId = JobPost::max('sortIds');
        $job->sortIds = $maxSortId !== null ? $maxSortId + 1 : 0;
        $job->save();
        return redirect()->route('jobpost.index')->with('success', 'Job Post Added Successfully');
    }

    public function show($id)
    {
        $job = JobPost::find($id);
        return view('admin.jobpost.show-modal', compact('job'));
    }

    public function edit($id)
    {
        $job = JobPost::find($id);
        return view('admin.jobpost.edit', compact('job'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'post_title' => 'required',
            'job_type' => 'required',
            'city' => 'required',
            'work_experience' => 'required',
            'total_position' => 'required',
            'shift' => 'required',
            'job_description' => 'required|min:20',
        ]);
        $job = JobPost::find($id);
        $job->post_title = $request->post_title;
        $job->job_type = $request->job_type;
        $job->city = $request->city;
        $job->work_experience = $request->work_experience;
        $job->total_positions = $request->total_position;
        $job->shift = $request->shift;
        $job->description = $request->job_description;
        $job->save();
        return redirect()->route('jobpost.index')->with('success', 'Job Post Updated Successfully');
    }

    public function destroy(Request $request, $id)
    {
        $jobpost = JobPost::find($id);
        if ($jobpost) {
            $jobpost->delete();
            return response()->json(['status' => true]);
        }
    }

    public function jobdetail($id)
    {
        $jobApplications = JobApplication::where('job_post_id', $id)->latest()->get();
        $job = JobPost::find($id);
        return view('admin.jobpost.jobdetail', compact('jobApplications', 'job'));
    }

    public function downloadResume($id)
    {
        $jobApp = JobApplication::find($id);
        header('Content-Type:' . $jobApp->mime);
        header('Content-Disposition: attachment; filename=' . $jobApp->name . '_' . Str::random(5) . '.' . $jobApp->extension);
        echo $jobApp->resume;
    }
    
    // public function editEmail()
    // {
    //     $frontEmail = FrontEmail::where('name', 'hr email')->first();
    //     $emails = explode(' ', preg_replace("/\r|\n/", '', $frontEmail->emails));
    //     return view('admin.front-contact.editemail', compact('emails', 'frontEmail'));
    // }

    public function oldupdateEmail(Request $request)
    {
        $email = FrontEmail::find($request->emailId);
        // $email->emails = implode(' ', $request->emails);
        dd($request->all());
        $email->emails = $request->emails;
        $email->save();
        return response()->json(['status' => true]);
    }

    public function updateEmail(Request $request){

        FrontEmail::where('name', 'hr email')->delete();
        $adminEmails = $request->input('adminemail', []);
        // dd($adminEmails);

        if (!is_array($adminEmails)) {
            $adminEmails = [$adminEmails];
        }

        $adminEmails = array_filter($adminEmails, function ($email) {
            return !empty($email);
        });

        $uniqueEmails = [];

        foreach ($adminEmails as $email) {
            if (!in_array($email, $uniqueEmails)) {
                $emails = [
                    'name' => 'hr email',
                    'emails' => $email,
                ];
                FrontEmail::create($emails);

                $uniqueEmails[] = $email;
            }
        }

        // return response()->json(['status' => true]);
        return redirect()->back()->with('success', 'Email Added Successfully');
    }

    public function jobdetailDestroy(Request $request, $id)
    {
        $jobapplication = JobApplication::find($id);
        if ($jobapplication) {
            $jobapplication->delete();
            return response()->json(['status' => true]);
        }
    }

    public function changeStatus(Request $request)
    {
        $status = $request->status;
        $id = $request->id;

        $statusChange = JobPost::where('id', $id)->update(['active' => $status]);
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
            $item = JobPost::find($value);
            if ($item) {
                $item->sortIds = $key;
                $item->save();
            }
        }
        $responseValue = JobPost::orderby('sortIds', 'asc')->get();
        return response()->json($responseValue);
    }
}
