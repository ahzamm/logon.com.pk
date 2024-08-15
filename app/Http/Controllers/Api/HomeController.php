<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HomeSlider;
use App\Models\WhyChooseUs;
use App\Models\Service;
use App\Models\ClientBenefit;
use App\Models\HappyClient;

class HomeController extends Controller
{
    protected $homeSlider;
    protected $whyChooseUs;
    protected $service;
    protected $clientBenefit;
    protected $happyClient;

    public function __construct(HomeSlider $homeSlider, WhyChooseUs $whyChooseUs, Service $service, ClientBenefit $clientBenefit, HappyClient $happyClient)
    {
        $this->homeSlider = $homeSlider;
        $this->whyChooseUs = $whyChooseUs;
        $this->service = $service;
        $this->clientBenefit = $clientBenefit;
        $this->happyClient = $happyClient;
    }

    public function index()
    {
        $slider = $this->getSliderData();
        $whyChooseUs = $this->getWhyChooseUsData();
        $services = $this->getServicesData();
        $clientBenefits = $this->getClientBenefitsData();
        $happyClients = $this->getHappyClientsData();

        return response()->json([
            'slider' => $slider,
            'whychooseus' => $whyChooseUs,
            'services' => $services,
            'client_benefits' => $clientBenefits,
            'happy_clients' => $happyClients,
        ], 200);
    }

    private function getSliderData()
    {
        $videoSlide = $this->homeSlider->where('active', 1)
            ->where('image', 'like', '%.mp4')
            ->orderBy('sortIds', 'asc')
            ->select('title', 'slogan', 'image', 'image_alt')
            ->first();

        if ($videoSlide) {
            $videoSlide->image = '/homeslider/videos/' . $videoSlide->image;
            return $videoSlide;
        } else {
            return $this->homeSlider->where('active', 1)
                ->orderBy('sortIds', 'asc')
                ->select('title', 'slogan', 'image', 'image_alt')
                ->get()
                ->each(function ($slide) {
                    $slide->image = '/homeslider/' . $slide->image;
                });
        }
    }

    private function getWhyChooseUsData()
    {
        return $this->whyChooseUs->where('is_active', 1)
            ->orderBy('sortIds', 'asc')
            ->select('icon', 'heading', 'text')
            ->get();
    }

    private function getServicesData()
    {
        return $this->service->where('is_active', 1)
            ->orderBy('sortIds', 'asc')
            ->select('icon', 'heading', 'text')
            ->get();
    }

    private function getClientBenefitsData()
    {
        return $this->clientBenefit->where('is_active', 1)
            ->orderBy('sortIds', 'asc')
            ->select('icon', 'heading', 'text')
            ->get();
    }

    private function getHappyClientsData()
    {
        return $this->happyClient->where('is_active', 1)
            ->orderBy('sortIds', 'asc')
            ->select('client_type', 'no_of_clients')
            ->get();
    }
}
