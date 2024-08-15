<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\FrontFaq;

class Faqs extends Component
{
    public $faqs;
    public function mount()
    {
        $this->faqs = FrontFaq::where('active',1)->orderBy('sortIds', 'asc')->get();
    }
    public function render()
    {
        return view('livewire.front.faqs');
    }
}
