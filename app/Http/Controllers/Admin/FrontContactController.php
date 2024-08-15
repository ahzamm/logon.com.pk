<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FrontContact;
use App\Models\FrontEmail;

class FrontContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkuseraccess', ['only' => ['index']]);
    }

    public function index()
    {
        $data['email_contacts'] = FrontEmail::where('name', 'contact email')->get();
        return view('admin.front-contact.index', compact('data'));
    }

    public function getFrontContactData(Request $request)
    {
        $columns = [
            0 => 'id',
            1 => 'name',
            2 => 'phone',
            3 => 'email',
            4 => 'subject',
            5 => 'action',
        ];

        $totalData = FrontContact::count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $contacts = FrontContact::offset($start)->limit($limit)->orderBy($order, $dir)->get();
        } else {
            $search = $request->input('search.value');

            $contacts = FrontContact::where('name', 'LIKE', "%{$search}%")
                ->orWhere('phone', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('subject', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = FrontContact::where('name', 'LIKE', "%{$search}%")
                ->orWhere('phone', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('subject', 'LIKE', "%{$search}%")
                ->count();
        }

        $data = [];
        if (!empty($contacts)) {
            foreach ($contacts as $key => $contact) {
                $nestedData['id'] = $key + 1;
                $nestedData['name'] = $contact->name;
                $nestedData['phone'] = $contact->phone;
                $nestedData['email'] = $contact->email;
                $nestedData['subject'] = $contact->subject;
                $nestedData['action'] = '<button class="btn btn-danger btn-sm btnDeleteMenu" data-value="' . $contact->id . '"><i class="fa fa-trash"></i></button>';

                $data[] = $nestedData;
            }
        }

        $json_data = [
            'draw' => intval($request->input('draw')),
            'recordsTotal' => intval($totalData),
            'recordsFiltered' => intval($totalFiltered),
            'data' => $data,
        ];

        return response()->json($json_data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Request $request, $id)
    {
        $frontcontact = FrontContact::find($id);
        if ($frontcontact) {
            $frontcontact->delete();
            return response()->json(['status' => true]);
        }
    }
    public function editEmail()
    {
        $frontEmail = FrontEmail::where('name', 'contact email')->first();
        $emails = explode(' ', preg_replace("/\r|\n/", '', $frontEmail->emails));
        return view('admin.front-contact.editemail', compact('emails', 'frontEmail'));
    }
    public function updateEmail(Request $request)
    {
        // $email = FrontEmail::find($request->emailId);
        // $email->emails = implode(' ', $request->emails);
        // $email->save();

        FrontEmail::where('name', 'contact email')->delete();

        // Retrieve the array of emails from the request or an empty array if not present
        $adminEmails = $request->input('adminemail', []);
        // dd($adminEmails);

        // Ensure $adminEmails is an array
        if (!is_array($adminEmails)) {
            $adminEmails = [$adminEmails];
        }

        // Filter out empty emails
        $adminEmails = array_filter($adminEmails, function ($email) {
            return !empty($email);
        });

        // Array to keep track of unique emails
        $uniqueEmails = [];

        // Iterate through the emails and save each one as a new record if not already saved
        foreach ($adminEmails as $email) {
            if (!in_array($email, $uniqueEmails)) {
                // Prepare the data for saving
                $emails = [
                    'name' => 'contact email',
                    'emails' => $email,
                ];
                // Save the email to the database
                FrontEmail::create($emails);

                // Mark this email as saved
                $uniqueEmails[] = $email;
            }
        }

        // return response()->json(['status' => true]);
        return redirect()->back()->with('success', 'Email Added Successfully');
    }
}
