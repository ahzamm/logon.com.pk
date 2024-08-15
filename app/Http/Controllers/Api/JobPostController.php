<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JobPost;
use Illuminate\Http\JsonResponse;

class JobPostController extends Controller
{
    protected $jobPost;

    public function __construct(JobPost $jobPost)
    {
        $this->jobPost = $jobPost;
    }

    public function index(): JsonResponse
    {
        $jobPosts = $this->jobPost->where('active', 1)->orderBy('sortIds', 'asc')->get();
        return response()->json($jobPosts, 200);
    }
}
