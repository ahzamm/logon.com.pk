<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\CorporateUser;
class CorporateLogo extends Component
{
    public function render()
    {
        $corporates = CorporateUser::where('active',1)->orderBy('sortIds', 'asc')->get();
        return view('livewire.front.corporate-logo',['corporates'=>$corporates]);
    }
}
