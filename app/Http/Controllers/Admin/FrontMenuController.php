<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FrontMenu;
use App\Models\FrontPage;
use Auth;
class FrontMenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkuseraccess', ['only' => ['index','create']]);
    }

    public $icons = ["fa fa-address-book","fa fa-address-card","fa fa-adjust","fa fa-align-center","fa fa-align-justify","fa fa-align-left","fa fa-align-right","fa fa-allergies","fa fa-ambulance","fa fa-american-sign-language-interpreting","fa fa-anchor","fa fa-angle-double-down","fa fa-angle-double-left","fa fa-angle-double-right","fa fa-angle-double-up","fa fa-angle-down","fa fa-angle-left","fa fa-angle-right","fa fa-angle-up","fa fa-archive","fa fa-arrow-alt-circle-down","fa fa-arrow-alt-circle-left","fa fa-arrow-alt-circle-right","fa fa-arrow-alt-circle-up","fa fa-arrow-circle-down","fa fa-arrow-circle-left","fa fa-arrow-circle-right","fa fa-arrow-circle-up","fa fa-arrow-down","fa fa-arrow-left","fa fa-arrow-right","fa fa-arrow-up","fa fa-arrows-alt","fa fa-arrows-alt-h","fa fa-arrows-alt-v","fa fa-assistive-listening-systems","fa fa-asterisk","fa fa-at","fa fa-audio-description","fa fa-backward","fa fa-balance-scale","fa fa-ban","fa fa-band-aid","fa fa-barcode","fa fa-bars","fa fa-baseball-ball","fa fa-basketball-ball","fa fa-bath","fa fa-battery-empty","fa fa-battery-full","fa fa-battery-half","fa fa-battery-quarter","fa fa-battery-three-quarters","fa fa-bed","fa fa-beer","fa fa-bell","fa fa-bell-slash","fa fa-bicycle","fa fa-binoculars","fa fa-birthday-cake","fa fa-blind","fa fa-bold","fa fa-bolt","fa fa-bomb","fa fa-book","fa fa-bookmark","fa fa-bowling-ball","fa fa-box","fa fa-box-open","fa fa-boxes","fa fa-braille","fa fa-briefcase","fa fa-briefcase-medical","fa fa-bug","fa fa-building","fa fa-bullhorn","fa fa-bullseye","fa fa-burn","fa fa-bus","fa fa-calculator","fa fa-calendar","fa fa-calendar-alt","fa fa-calendar-check","fa fa-calendar-minus","fa fa-calendar-plus","fa fa-calendar-times","fa fa-camera","fa fa-camera-retro","fa fa-capsules","fa fa-car","fa fa-caret-down","fa fa-caret-left","fa fa-caret-right","fa fa-caret-square-down","fa fa-caret-square-left","fa fa-caret-square-right","fa fa-caret-square-up","fa fa-caret-up","fa fa-cart-arrow-down","fa fa-cart-plus","fa fa-certificate","fa fa-chart-area","fa fa-chart-bar","fa fa-chart-line","fa fa-chart-pie","fa fa-check","fa fa-check-circle","fa fa-check-square","fa fa-chess","fa fa-chess-bishop","fa fa-chess-board","fa fa-chess-king","fa fa-chess-knight","fa fa-chess-pawn","fa fa-chess-queen","fa fa-chess-rook","fa fa-chevron-circle-down","fa fa-chevron-circle-left","fa fa-chevron-circle-right","fa fa-chevron-circle-up","fa fa-chevron-down","fa fa-chevron-left","fa fa-chevron-right","fa fa-chevron-up","fa fa-child","fa fa-circle","fa fa-circle-notch","fa fa-clipboard","fa fa-clipboard-check","fa fa-clipboard-list","fa fa-clock","fa fa-clone","fa fa-closed-captioning","fa fa-cloud","fa fa-cloud-download-alt","fa fa-cloud-upload-alt","fa fa-code","fa fa-code-branch","fa fa-coffee","fa fa-cog","fa fa-cogs","fa fa-columns","fa fa-comment","fa fa-comment-alt","fa fa-comment-dots","fa fa-comment-slash","fa fa-comments","fa fa-compass","fa fa-compress","fa fa-copy","fa fa-copyright","fa fa-couch","fa fa-credit-card","fa fa-crop","fa fa-crosshairs","fa fa-cube","fa fa-cubes","fa fa-cut","fa fa-database","fa fa-deaf","fa fa-desktop","fa fa-diagnoses","fa fa-dna","fa fa-dollar-sign","fa fa-dolly","fa fa-dolly-flatbed","fa fa-donate","fa fa-dot-circle","fa fa-dove","fa fa-download","fa fa-edit","fa fa-eject","fa fa-ellipsis-h","fa fa-ellipsis-v","fa fa-envelope","fa fa-envelope-open","fa fa-envelope-square","fa fa-eraser","fa fa-euro-sign","fa fa-exchange-alt","fa fa-exclamation","fa fa-exclamation-circle","fa fa-exclamation-triangle","fa fa-expand","fa fa-expand-arrows-alt","fa fa-external-link-alt","fa fa-external-link-square-alt","fa fa-eye","fa fa-eye-dropper","fa fa-eye-slash","fa fa-fat-backward","fa fa-fat-forward","fa fa-fax","fa fa-female","fa fa-fighter-jet","fa fa-file","fa fa-file-alt","fa fa-file-archive","fa fa-file-audio","fa fa-file-code","fa fa-file-excel","fa fa-file-image","fa fa-file-medical","fa fa-file-medical-alt","fa fa-file-pdf","fa fa-file-powerpoint","fa fa-file-video","fa fa-file-word","fa fa-film","fa fa-filter","fa fa-fire","fa fa-fire-extinguisher","fa fa-first-aid","fa fa-flag","fa fa-flag-checkered","fa fa-flask","fa fa-folder","fa fa-folder-open","fa fa-font","fa fa-football-ball","fa fa-forward","fa fa-frown","fa fa-futbol","fa fa-gamepad","fa fa-gavel","fa fa-gem","fa fa-genderless","fa fa-gift","fa fa-glass-martini","fa fa-globe","fa fa-golf-ball","fa fa-graduation-cap","fa fa-h-square","fa fa-hand-holding","fa fa-hand-holding-heart","fa fa-hand-holding-usd","fa fa-hand-lizard","fa fa-hand-paper","fa fa-hand-peace","fa fa-hand-point-down","fa fa-hand-point-left","fa fa-hand-point-right","fa fa-hand-point-up","fa fa-hand-pointer","fa fa-hand-rock","fa fa-hand-scissors","fa fa-hand-spock","fa fa-hands","fa fa-hands-helping","fa fa-handshake","fa fa-hashtag","fa fa-hdd","fa fa-heading","fa fa-headphones","fa fa-heart","fa fa-heartbeat","fa fa-history","fa fa-hockey-puck","fa fa-home","fa fa-hospital","fa fa-hospital-alt","fa fa-hospital-symbol","fa fa-hourglass","fa fa-hourglass-end","fa fa-hourglass-half","fa fa-hourglass-start","fa fa-i-cursor","fa fa-id-badge","fa fa-id-card","fa fa-id-card-alt","fa fa-image","fa fa-images","fa fa-inbox","fa fa-indent","fa fa-industry","fa fa-info","fa fa-info-circle","fa fa-italic","fa fa-key","fa fa-keyboard","fa fa-language","fa fa-laptop","fa fa-leaf","fa fa-lemon","fa fa-level-down-alt","fa fa-level-up-alt","fa fa-life-ring","fa fa-lightbulb","fa fa-link","fa fa-lira-sign","fa fa-list","fa fa-list-alt","fa fa-list-ol","fa fa-list-ul","fa fa-location-arrow","fa fa-lock","fa fa-lock-open","fa fa-long-arrow-alt-down","fa fa-long-arrow-alt-left","fa fa-long-arrow-alt-right","fa fa-long-arrow-alt-up","fa fa-low-vision","fa fa-magic","fa fa-magnet","fa fa-male","fa fa-map","fa fa-map-marker","fa fa-map-marker-alt","fa fa-map-pin","fa fa-map-signs","fa fa-mars","fa fa-mars-double","fa fa-mars-stroke","fa fa-mars-stroke-h","fa fa-mars-stroke-v","fa fa-medkit","fa fa-meh","fa fa-mercury","fa fa-microchip","fa fa-microphone","fa fa-microphone-slash","fa fa-minus","fa fa-minus-circle","fa fa-minus-square","fa fa-mobile","fa fa-mobile-alt","fa fa-money-bill-alt","fa fa-moon","fa fa-motorcycle","fa fa-mouse-pointer","fa fa-music","fa fa-neuter","fa fa-newspaper","fa fa-notes-medical","fa fa-object-group","fa fa-object-ungroup","fa fa-outdent","fa fa-paint-brush","fa fa-pallet","fa fa-paper-plane","fa fa-paperclip","fa fa-parachute-box","fa fa-paragraph","fa fa-paste","fa fa-pause","fa fa-pause-circle","fa fa-paw","fa fa-pen-square","fa fa-pencil-alt","fa fa-people-carry","fa fa-percent","fa fa-phone","fa fa-phone-slash","fa fa-phone-square","fa fa-phone-volume","fa fa-piggy-bank","fa fa-pills","fa fa-plane","fa fa-play","fa fa-play-circle","fa fa-plug","fa fa-plus","fa fa-plus-circle","fa fa-plus-square","fa fa-podcast","fa fa-poo","fa fa-pound-sign","fa fa-power-off","fa fa-prescription-bottle","fa fa-prescription-bottle-alt","fa fa-print","fa fa-procedures","fa fa-puzzle-piece","fa fa-qrcode","fa fa-question","fa fa-question-circle","fa fa-quidditch","fa fa-quote-left","fa fa-quote-right","fa fa-random","fa fa-recycle","fa fa-redo","fa fa-redo-alt","fa fa-registered","fa fa-reply","fa fa-reply-all","fa fa-retweet","fa fa-ribbon","fa fa-road","fa fa-rocket","fa fa-rss","fa fa-rss-square","fa fa-ruble-sign","fa fa-rupee-sign","fa fa-save","fa fa-search","fa fa-search-minus","fa fa-search-plus","fa fa-seedling","fa fa-server","fa fa-share","fa fa-share-alt","fa fa-share-alt-square","fa fa-share-square","fa fa-shekel-sign","fa fa-shield-alt","fa fa-ship","fa fa-shipping-fat","fa fa-shopping-bag","fa fa-shopping-basket","fa fa-shopping-cart","fa fa-shower","fa fa-sign","fa fa-sign-in-alt","fa fa-sign-language","fa fa-sign-out-alt","fa fa-signal","fa fa-sitemap","fa fa-sliders-h","fa fa-smile","fa fa-smoking","fa fa-snowflake","fa fa-sort","fa fa-sort-alpha-down","fa fa-sort-alpha-up","fa fa-sort-amount-down","fa fa-sort-amount-up","fa fa-sort-down","fa fa-sort-numeric-down","fa fa-sort-numeric-up","fa fa-sort-up","fa fa-space-shuttle","fa fa-spinner","fa fa-square","fa fa-square-full","fa fa-star","fa fa-star-half","fa fa-step-backward","fa fa-step-forward","fa fa-stethoscope","fa fa-sticky-note","fa fa-stop","fa fa-stop-circle","fa fa-stopwatch","fa fa-street-view","fa fa-strikethrough","fa fa-subscript","fa fa-subway","fa fa-suitcase","fa fa-sun","fa fa-superscript","fa fa-sync","fa fa-sync-alt","fa fa-syringe","fa fa-table","fa fa-table-tennis","fa fa-tablet","fa fa-tablet-alt","fa fa-tablets","fa fa-tachometer-alt","fa fa-tag","fa fa-tags","fa fa-tape","fa fa-tasks","fa fa-taxi","fa fa-terminal","fa fa-text-height","fa fa-text-width","fa fa-th","fa fa-th-large","fa fa-th-list","fa fa-thermometer","fa fa-thermometer-empty","fa fa-thermometer-full","fa fa-thermometer-half","fa fa-thermometer-quarter","fa fa-thermometer-three-quarters","fa fa-thumbs-down","fa fa-thumbs-up","fa fa-thumbtack","fa fa-ticket-alt","fa fa-times","fa fa-times-circle","fa fa-tint","fa fa-toggle-off","fa fa-toggle-on","fa fa-trademark","fa fa-train","fa fa-transgender","fa fa-transgender-alt","fa fa-trash","fa fa-trash-alt","fa fa-tree","fa fa-trophy","fa fa-truck","fa fa-truck-loading","fa fa-truck-moving","fa fa-tty","fa fa-tv","fa fa-umbrella","fa fa-underline","fa fa-undo","fa fa-undo-alt","fa fa-universal-access","fa fa-university","fa fa-unlink","fa fa-unlock","fa fa-unlock-alt","fa fa-upload","fa fa-user","fa fa-user-circle","fa fa-user-md","fa fa-user-plus","fa fa-user-secret","fa fa-user-times","fa fa-users","fa fa-utensil-spoon","fa fa-utensils","fa fa-venus","fa fa-venus-double","fa fa-venus-mars","fa fa-vial","fa fa-vials","fa fa-video","fa fa-video-slash","fa fa-volleyball-ball","fa fa-volume-down","fa fa-volume-off","fa fa-volume-up","fa fa-warehouse","fa fa-weight","fa fa-wheelchair","fa fa-wifi","fa fa-window-close","fa fa-window-maximize","fa fa-window-minimize","fa fa-window-restore","fa fa-wine-glass","fa fa-won-sign","fa fa-wrench","fa fa-x-ray","fa fa-yen-sign","fa fa-address-book","fa fa-address-card","fa fa-arrow-alt-circle-down","fa fa-arrow-alt-circle-left","fa fa-arrow-alt-circle-right","fa fa-arrow-alt-circle-up","fa fa-bell","fa fa-bell-slash","fa fa-bookmark","fa fa-building","fa fa-calendar","fa fa-calendar-alt","fa fa-calendar-check","fa fa-calendar-minus","fa fa-calendar-plus","fa fa-calendar-times","fa fa-caret-square-down","fa fa-caret-square-left","fa fa-caret-square-right","fa fa-caret-square-up","fa fa-chart-bar","fa fa-check-circle","fa fa-check-square","fa fa-circle","fa fa-clipboard","fa fa-clock","fa fa-clone","fa fa-closed-captioning","fa fa-comment","fa fa-comment-alt","fa fa-comments","fa fa-compass","fa fa-copy","fa fa-copyright","fa fa-credit-card","fa fa-dot-circle","fa fa-edit","fa fa-envelope","fa fa-envelope-open","fa fa-eye-slash","fa fa-file","fa fa-file-alt","fa fa-file-archive","fa fa-file-audio","fa fa-file-code","fa fa-file-excel","fa fa-file-image","fa fa-file-pdf","fa fa-file-powerpoint","fa fa-file-video","fa fa-file-word","fa fa-flag","fa fa-folder","fa fa-folder-open","fa fa-frown","fa fa-futbol","fa fa-gem","fa fa-hand-lizard","fa fa-hand-paper","fa fa-hand-peace","fa fa-hand-point-down","fa fa-hand-point-left","fa fa-hand-point-right","fa fa-hand-point-up","fa fa-hand-pointer","fa fa-hand-rock","fa fa-hand-scissors","fa fa-hand-spock","fa fa-handshake","fa fa-hdd","fa fa-heart","fa fa-hospital","fa fa-hourglass","fa fa-id-badge","fa fa-id-card","fa fa-image","fa fa-images","fa fa-keyboard","fa fa-lemon","fa fa-life-ring","fa fa-lightbulb","fa fa-list-alt","fa fa-map","fa fa-meh","fa fa-minus-square","fa fa-money-bill-alt","fa fa-moon","fa fa-newspaper","fa fa-object-group","fa fa-object-ungroup","fa fa-paper-plane","fa fa-pause-circle","fa fa-play-circle","fa fa-plus-square","fa fa-question-circle","fa fa-registered","fa fa-save","fa fa-share-square","fa fa-smile","fa fa-snowflake","fa fa-square","fa fa-star","fa fa-star-half","fa fa-sticky-note","fa fa-stop-circle","fa fa-sun","fa fa-thumbs-down","fa fa-thumbs-up","fa fa-times-circle","fa fa-trash-alt","fa fa-user","fa fa-user-circle","fa fa-window-close","fa fa-window-maximize","fa fa-window-minimize","fa fa-window-restore"];

    public function index()
    {
        $menus = FrontMenu::orderby('sortIds', 'asc')->get();
        return view('admin.menus.index',compact('menus'));
    }

 
    public function create()
    {
        $frontPages = FrontPage::where('status',1)->get();
        $menus = FrontMenu::orderby('sortIds', 'asc')->get();
        $icons = $this->icons;
        return view('admin.menus.create',compact('frontPages','menus','icons'));

    }


    public function store(Request $request)
    {
        $request->validate([
            'menu_name' =>'required',
            'icon' => 'required'
        ]);
        $menu = new FrontMenu;
        $menu->menu_name = $request->menu_name;
        $menu->parent_id = $request->parent_menu == null?0:$request->parent_menu;
        $menu->page_id = $request->page;
        $menu->slug = $request->slug;
        $menu->created_by = Auth::user()->name;
        $menu->updated_by = Auth::user()->name;
        $menu->icon = $request->icon;
        $maxSortId = FrontMenu::max('sortIds');
        $menu->sortIds = $maxSortId !== null ? $maxSortId + 1 : 0;
        $menu->save();
        return redirect()->route('front-menus.index')->with("success", "Front Menu Added Successfully");;
    }


    public function show($id)
    {
        $menu = FrontMenu::find($id);
        return view('admin.menus.show',compact('menu'));
    }


    public function edit($id)
    {
        $menu = FrontMenu::find($id);
        $icons = $this->icons;
        $frontPages = FrontPage::where('status',1)->get();
        $menus = FrontMenu::where('status',1)->get();
        return view('admin.menus.edit',compact('menu','icons','menus','frontPages'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'menu_name' =>'required',
            'icon' => 'required'
        ]);
        $menu = FrontMenu::find($id);
        $menu->menu_name = $request->menu_name;
        $menu->parent_id = $request->parent_menu == null?0:$request->parent_menu;
        $menu->page_id = $request->page;
        $menu->slug = $request->slug;
        $menu->updated_by = Auth::user()->name;
        $menu->icon = $request->icon;
        $menu->save();
        return redirect()->route('front-menus.index')->with("success", "Front Menu Updated Successfully");;
    }

    public function destroy(Request $request, $id)
    {
        $frontmenu = FrontMenu::find($id);
        if ($frontmenu) {
            $frontmenu->delete();
            return response()->json(['status' => true]);
        }
    }

    public function changeStatus(Request $request)
    {
        $status = $request->status;
        $id = $request->id;

        $statusChange = FrontMenu::where('id', $id)->update(['status' => $status]);
        if ($statusChange) {
            return response()->json('success');
        } else {
            return response()->json('error');
        }
    }


    public function sort(Request $request)
    {
        $sortIds = $request->sort_Ids;
        foreach ($sortIds as $key => $value) {
            $item = FrontMenu::find($value);
            if ($item) {
                $item->sortIds = $key;
                $item->save();
            }
        }
        $responseValue = FrontMenu::with('parent')->orderby('sortIds', 'asc')->get();
        return response()->json($responseValue);
    }
}
