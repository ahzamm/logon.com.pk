<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactInformation;
use App\Models\FrontContact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\EmailService;
use App\Models\FrontEmail;

class ContactController extends Controller
{
    protected $contactInformation;
    protected $emailService;

    public function __construct(ContactInformation $contactInformation, FrontContact $frontContact, EmailService $emailService)
    {
        $this->contactInformation = $contactInformation;
        $this->frontContact = $frontContact;
        $this->emailService = $emailService;
    }

    public function index(): JsonResponse
    {
        $contactInformation = $this->contactInformation->first();
        return response()->json($contactInformation, 200);
    }

    public function old_store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'error' => 'Validation error',
                    'messages' => $validator->errors(),
                ],
                422,
            );
        }

        $this->frontContact->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'subject' => $request->input('subject'),
            'phone' => $request->input('phone'),
            'message' => $request->input('message'),
        ]);

        return response()->json(
            [
                'success' => true,
                'message' => 'Contact information submitted successfully!',
            ],
            201,
        );
    }

    public function store(Request $request): JsonResponse{
        $userDetails = [];
        $userDetails['username'] = $request->username;
        $userDetails['email'] = $request->email;
        $userDetails['subject'] = $request->subject;
        $userDetails['phone'] = $request->phone;
        $userDetails['message'] = $request->message;

   
        $frontContact = new FrontContact();
        $frontContact->name = $request->name;
        $frontContact->email = $request->email;
        $frontContact->phone = $request->subject;
        $frontContact->subject = $request->phone;
        $frontContact->message = $request->message;


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
                return response()->json(['status' => true]);
            } catch (\Throwable $th) {
                return response()->json(['status' => false, 'message'=>$th->getMessage()]);
            }
        }

        return response()->json(['status' => false, 'message'=>$frontEmails]);
       
    }

    
}
