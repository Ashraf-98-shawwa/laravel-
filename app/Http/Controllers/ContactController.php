<?php

namespace App\Http\Controllers;

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
        $this->authorize('viewAny', Contact::class);

        $contacts = Contact::orderBy('id', 'desc')->paginate(7);
        return response()->view('cms.contacts.index', compact('contacts'));
    }


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

                return response()->json(['icon' => 'success', 'title' => 'Message Sent successfully'], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => 'failed to create'], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }

        return response()->view('cms.contacts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view', Contact::class);
        $contact = Contact::findOrFail($id);
        return response()->view('cms.contacts.show', compact('contact'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', Contact::class);
        $contact = Contact::findOrFail($id);
        $delete = $contact->delete();
    }
}
