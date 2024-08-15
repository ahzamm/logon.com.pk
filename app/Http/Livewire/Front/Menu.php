<?php

namespace App\Http\Livewire\Front;

use App\Models\ContactInformation;
use App\Models\GeneralConfiguration;
use Livewire\Component;
use App\Models\FrontMenu;
use App\Models\Social;

class Menu extends Component
{
    public function render()
    {
        $menus = FrontMenu::where('status', 1)->where('parent_id', 0)->orderby('sortIds', 'asc')->get();
        $general_configuration = GeneralConfiguration::first();
        $socials = Social::where('status', 1)->orderby('sortIds', 'asc')->get();
        $contact_information = ContactInformation::first();
        return view('livewire.front.menu', [
            'menus' => $menus,
            'socials' => $socials,
            'contact_information' => $contact_information,
            'general_configuration' => $general_configuration
        ]);
    }
}
