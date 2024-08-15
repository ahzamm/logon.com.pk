<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobPost;
use App\Models\JobApplication;
use Str;
use Validator;
use App\Models\FrontEmail;
use App\Services\EmailService;

class CareerController extends Controller
{
    protected $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function jobs()
    {
        $jobs = JobPost::where('active', 1)->orderby('sortIds', 'asc')->get();
        return view('site.pages.career', compact('jobs'));
    }
    public function job_detail($id)
    {
        $decryptId = \App\ChiperText::decrypt($id);
        $job = JobPost::find($decryptId);
        return view('site.pages.job_detail', compact('job', 'id'));
    }
    public function application(Request $request, $id)
    {
        $messages = [
            'resume.required' => 'The resume field is required.',
            'resume.mimes' => 'The resume must be a file of type: doc, docx, pdf.',
            'resume.max' => 'The resume may not be greater than 1MB.',
        ];

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email:rfc,dns',
                'phone' => 'required',
                'resume' => 'required|mimes:doc,docx,pdf|max:1024',
            ],
            $messages,
        );

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $jobPostId = \App\ChiperText::decrypt($id);
        $jobPost = JobPost::find($jobPostId);
        if ($jobPost->active != 1) {
            return response()->json(['status' => false]);
        }

        $file = $request->file('resume');
        $extension = $file->getClientOriginalExtension();
        $resume_filename = Str::random(10) . '.' . $extension;
        $file->move(public_path('Resumes/'), $resume_filename);

        $jobApplication = new JobApplication();
        $jobApplication->name = $request->name;
        $jobApplication->email = $request->email;
        $jobApplication->phone = $request->phone;
        $jobApplication->resume = $resume_filename;
        $jobApplication->job_post_id = $jobPostId;
        $jobApplication->save();

        $attachment = public_path('Resumes/' . $resume_filename);
        $new_filename = 'Resume.' . $extension;

        $hrEmails = FrontEmail::where('name', 'hr email')->get();
        foreach ($hrEmails as $hrEmail) {
            $this->emailService->sendEmail(
                'Logon Job Application',
                'EmailTemplates.hrJobApplicationEmail',
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'resume' => $resume_filename,
                ],
                $hrEmail->emails,
                $attachment,
                $new_filename
            );
        }

        $this->emailService->sendEmail(
            'Logon Job Application',
            'EmailTemplates.applicantEmail',
            [
                'name' => $request->name,
                'jobTitle' => $jobPost->post_title
            ],
            $request->email
        );
        return response()->json(['status' => true]);
    }
}
