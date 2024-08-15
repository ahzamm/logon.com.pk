<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\HomeSlider;

class Slider extends Component
{
    public function render()
    {
        // $slides = HomeSlider::where('active',1)->orderby('sortIds', 'asc')->get();
        // return view('livewire.front.slider',['slides'=>$slides]);

        // Check for active sliders with videos
        $videoSlide = HomeSlider::where('active', 1)
            ->where('image', 'like', '%.mp4') // Assuming videos are stored as mp4
            ->orderby('sortIds', 'asc')
            ->first();

        if ($videoSlide) {
            // If a video slide exists, pass it to the view
            return view('livewire.front.slider', ['slide' => $videoSlide]);
        }

        // Default behavior: Get all active slides and sort them
        $slides = HomeSlider::where('active', 1)->orderby('sortIds', 'asc')->get();
        return view('livewire.front.slider', ['slides' => $slides]);
    }
}
