<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\JobPost;
use App\Models\FrontEmail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\EmailService;
use Str;

class JobApplicationController extends Controller
{
    protected $jobApplication;
    protected $emailService;

    public function __construct(JobApplication $jobApplication, EmailService $emailService)
    {
        $this->jobApplication = $jobApplication;
        $this->emailService = $emailService;
    }

    public function old_index(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email:rfc,dns',
            'phone' => 'required',
            'resume' => 'required|mimes:pdf,doc,docx|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'error' => 'Validation error',
                    'messages' => $validator->errors(),
                ],
                422
            );
        }

        try {
            $decryptId = \App\ChiperText::decrypt($id);
            $jobPost = JobPost::find($id);
            if (!$jobPost) {
                return response()->json(['status' => false, 'message' => 'Job post not found'], 404);
            }

            $jobApplication = new JobApplication();
            $jobApplication->name = $request->name;
            $jobApplication->email = $request->email;
            $jobApplication->phone = $request->phone;
            $jobApplication->job_post_id = $decryptId;

            // Store the resume and get its path
            $resumePath = $request->file('resume')->store('resumes');
            $jobApplication->resume = $resumePath;
            $jobApplication->mime = $request->file('resume')->getMimeType();
            $jobApplication->extension = $request->file('resume')->extension();

            $frontEmails = FrontEmail::where('name', 'career')->first();
            if ($frontEmails) {
                $jobApplication->save();
                $emails = explode(' ', preg_replace("/\r|\n/", '', $frontEmails->emails));
                $this->sendCareerDetails(implode(',', $emails), $jobApplication, $jobPost->post_title);
            }

            return response()->json(['status' => true]);

        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'An error occurred', 'error' => $e->getMessage()], 500);
        }
    }
    public function index(Request $request, $id): JsonResponse
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
