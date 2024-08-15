<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactInformation;
use App\Models\Social;
use App\Models\GeneralConfiguration;
use App\Models\FrontMenu;
use App\Models\CorporateUser;

class SiteComponentController extends Controller
{
    protected $contactInformation;
    protected $social;
    protected $generalConfiguration;
    protected $frontMenu;
    protected $corporateUser;

    public function __construct(ContactInformation $contactInformation, Social $social, GeneralConfiguration $generalConfiguration, FrontMenu $frontMenu, CorporateUser $corporateUser)
    {
        $this->contactInformation = $contactInformation;
        $this->social = $social;
        $this->generalConfiguration = $generalConfiguration;
        $this->frontMenu = $frontMenu;
        $this->corporateUser = $corporateUser;
    }

    public function index()
    {
        $header = $this->getHeaderData();
        $menuBar = $this->getMenuBarData();
        $corporateUsers = $this->getCorporateUsersData();
        $footer = $this->getFooterData();

        return response()->json(
            [
                'header' => $header,
                'menu_bar' => $menuBar,
                'corporate_users' => $corporateUsers,
                'footer' => $footer,
            ],
            200,
        );
    }

    private function getHeaderData()
    {
        $contactInformation = $this->contactInformation->first();
        $socials = $this->social->select('name', 'icon', 'url')->where('status', 1)->get();

        return [
            'phone' => $contactInformation->phone,
            'email' => $contactInformation->email,
            'socials' => $socials,
        ];
    }

    private function getMenuBarData()
    {
        $generalConfigurations = $this->generalConfiguration->first();
        $menus = $this->frontMenu->where('status', 1)->where('parent_id', 0)->orderby('sortIds', 'asc')->get();
        $menuTree = $this->buildMenuTree($menus);

        return [
            'brand_logo' => '/site/images/' . $generalConfigurations->brand_logo,
            'menus' => $menuTree,
        ];
    }

    private function getCorporateUsersData()
    {
        return $this->corporateUser
            ->select('name', 'logo')
            ->where('active', 1)
            ->orderBy('sortIds', 'asc')
            ->get()
            ->map(function ($user) {
                $user->logo = '/corporate/' . $user->logo;
                return $user;
            });
    }

    private function getFooterData()
    {
        $generalConfigurations = $this->generalConfiguration->first();
        $contactInformation = $this->contactInformation->first();
        $socials = $this->social->select('name', 'icon', 'url')->where('status', 1)->get();

        return [
            'footer_logo' => '/site/images/' . $generalConfigurations->footer_logo,
            'socials' => $socials,
            'brand_name' => $generalConfigurations->brand_name,
            'address' => $contactInformation->address,
            'phone' => $contactInformation->phone,
            'email' => $contactInformation->email,
            'footer_text' => $generalConfigurations->site_footer,
        ];
    }

    private function buildMenuTree($menus)
    {
        $tree = [];
        foreach ($menus as $menu) {
            $childMenus = $this->buildMenuTree($menu->childs);
            $tree[] = [
                'menu_name' => $menu->menu_name,
                'slug' => $menu->slug,
                'icon' => $menu->icon,
                'children' => $childMenus,
            ];
        }
        return $tree;
    }
}
