<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FrontMenu;
use Illuminate\Http\JsonResponse;

class FrontPageController extends Controller
{
    protected $frontMenu;

    public function __construct(FrontMenu $frontMenu)
    {
        $this->frontMenu = $frontMenu;
    }

    public function index($slug): JsonResponse
    {
        $frontPageContent = $this->getFrontPageContent($slug);

        return response()->json($frontPageContent, 200);
    }

    private function getFrontPageContent($slug)
    {
        $pageContent = $this->frontMenu
            ->with([
                'frontPage' => function ($query) {
                    $query->select('id', 'name', 'meta_tag', 'meta_description', 'page_title', 'banner_image', 'slogan', 'content');
                },
            ])
            ->where('slug', $slug)
            ->first();

        return $pageContent->frontPage ?? null;
    }
}
