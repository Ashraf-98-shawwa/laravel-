<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::orderBy('id', 'desc')->get();
        return response()->json([
            'status' => 'true',
            'message' => 'All contacts In Data Base ',
            'data' => $contacts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = validator(
            $request->all(),
            [
                'name' => 'required | string |min:3 ',
                'email' => 'required | email',
                'subject' => 'required | string | min:5',
                'message' => 'string |min:15 ',

            ],
            [
                'name.required' => 'Enter Your Name .',
                'email.required' => 'Enter Your Email',
                'subject.required' => 'Enter the subject.',
                'message.required' => 'Write your message..'

            ]

        );

        if (!$validator->fails()) {
            $contact = new Contact();

            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->subject = $request->subject;
            $contact->message = $request->message;


            $issaved = $contact->save();

            if ($issaved) {

                return response()->json([
                    'status' => true,
                    'message' => 'Message Sent successfully',
                    'RequestStatus' => 200
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Faild to send message ',
                    'RequestStatus' =>  400
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => $validator->getMessageBag()->first(),
                'RequestStatus' => 400
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Contact::findOrFail($id);

        if ($contact) {
            return response()->json([
                'status' => true,
                'message' => 'Contact information ',
                'RequestStatus' =>  400,
                'data' => $contact

            ]);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $this->authorize('delete', City::class);
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return response()->json([
            'status' => true,
            'message' => 'Deleted successfully',
            'RequestStatus' => 200
        ]);
    }
}
