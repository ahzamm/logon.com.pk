<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FrontContact;
use App\Models\CoverageRequest;
use App\Models\JobPost;
use App\Models\JobApplication;
use App\Models\FrontFaq;
use App\Models\FrontPage;
use App\Models\ModalContent;
use App\Admin;

class HomeController extends Controller
{
    public function dashboard()
    {
        $coverageMembers = CoverageRequest::whereRaw("date(created_at) = date(now()) and request_type = 'partner'")->get();
        $coverageUsers = CoverageRequest::whereRaw("date(created_at) = date(now()) and request_type = 'user'")->get();
        $jobpost = JobPost::where('active', 1)->count();
        $jobAplication = JobApplication::whereRaw('job_post_id in (select id from job_posts where active =1)')->count();
        $contactRequest = FrontContact::count();
        $faqs = FrontFaq::where('active', 1)->count();
        $contacts = FrontContact::whereRaw('date(created_at) = date(now())')->get();
        $frontPages = FrontPage::where('status', '1')->count();
        $employees = Admin::where('role', 'employee')->count();
        $requestCount = CoverageRequest::count();
        $modalContent = ModalContent::count();
        return view('admin.home.dashboard', compact('contacts', 'coverageMembers', 'coverageUsers', 'jobpost', 'jobAplication', 'contactRequest', 'faqs', 'frontPages', 'employees', 'requestCount', 'modalContent'));
    }
}
