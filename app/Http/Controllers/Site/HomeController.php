<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\ContactInformation;
use App\Models\HappyClient;
use Illuminate\Http\Request;
use App\Models\FrontMenu;
use App\Models\FrontContact;
use App\Models\FrontEmail;
use App\Models\WhyChooseUs;
use App\Models\Service;
use App\Models\ClientBenefit;
use App\Services\EmailService;

class HomeController extends Controller
{
    protected $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function index()
    {
        $whychooseus = WhyChooseUs::where('is_active', 1)->orderby('sortIds', 'asc')->get();
        $services = Service::where('is_active', 1)->orderby('sortIds', 'asc')->get();
        $client_benefits = ClientBenefit::where('is_active', 1)->orderby('sortIds', 'asc')->get();
        $happy_clients = HappyClient::where('is_active', 1)->orderby('sortIds', 'asc')->get();
        return view('site.pages.home', compact('whychooseus', 'services', 'client_benefits', 'happy_clients'));
    }

    public function pages($slug = null)
    {
        if ($slug) {
            $menu = FrontMenu::where('slug', $slug)->first();

            if ($menu && $menu->page_id != null && $menu->frontPage->status != 0) {
                $parentMenu = FrontMenu::where('id', $menu->parent_id)->first();
                return view('site.pages.services', compact('menu', 'parentMenu'));
            } else {
                return abort(404);
            }
        }
        return abort(404);
    }

    public function contact()
    {
        $contact_information = ContactInformation::first();
        return view('site.pages.contact', compact('contact_information'));
    }

    public function contactPost(Request $request)
    {
        $userDetails = [];
        $userDetails['username'] = $request->username;
        $userDetails['email'] = $request->email;
        $userDetails['subject'] = $request->subject;
        $userDetails['phone'] = $request->phone;
        $userDetails['message'] = $request->message;

        //Save Contact Records
        $frontContact = new FrontContact();
        $frontContact->name = $request->username;
        $frontContact->email = $request->email;
        $frontContact->phone = $request->subject;
        $frontContact->subject = $request->phone;
        $frontContact->message = $request->message;

        //Send Email
        $frontEmails = FrontEmail::where('name', 'contact email')->get();
        if ($frontEmails != null) {
            try {
                $frontContact->save();

                $this->emailService->sendEmail(
                    'Thank You For Reaching Out To Us', 
                    'EmailTemplates.customerContact', 
                    ['fullName' => $userDetails['username'], 'message' => $userDetails['message']], 
                    $userDetails['email']
                );

                foreach ($frontEmails as $email) {
                    $this->emailService->sendEmail(
                        'Contact Us Email From Logon Website | User Name: ' . $userDetails['username'], 
                        'EmailTemplates.adminContact',
                        [
                            'fullName' =>  $userDetails['username'],
                            'email' => $userDetails['email'],
                            'phone' =>  $userDetails['phone'],
                            'message' =>  $userDetails['message'],
                        ],
                        $email->emails);
                }
            } catch (\Throwable $th) {
                dd($th);
            }
        }
        return response()->json(['status' => true]);
    }

    public function faqs()
    {
        return view('site.pages.faqs');
    }
    private function sendContactDetail($to, $details)
    {
        $subject = 'Contact Us Email From Logon Website | User Name: ' . $details['username'];
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
        $headers .= 'From: info@logon.com.pk';
        $message = view('email.contact_us', ['usedetail' => $details])->render();
        $response = mail($to, $subject, $message, $headers);
        dd($response);
    }
}
