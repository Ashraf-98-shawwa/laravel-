<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Application::class);
        $requests = Application::orderBy('id', 'desc')->paginate(7);
        return response()->view('cms.requests.index', compact('requests'));
    }


    public function store(Request $request)
    {
        $validator = validator(
            $request->all(),
            [
                'name' => 'required | string |min:3 ',
                'email' => 'required | email',
                'date' => 'required',
                'time' => 'required',
                'message' => 'string |min:15 ',


            ],
            [
                'name.required' => 'Enter Your Name .',
                'email.required' => 'Enter Your Email',
                'date.required' => 'Enter the date.',
                'time.required' => 'Enter the time.',
                'message.required' => 'Write your message..'


            ]

        );

        if (!$validator->fails()) {
            $Application = new Application();

            $Application->name = $request->name;
            $Application->email = $request->email;
            $Application->date = $request->date;
            $Application->time = $request->time;
            $Application->message = $request->message;


            $issaved = $Application->save();


            if ($issaved) {

                return response()->json(['icon' => 'success', 'title' => 'Request Submited successfully'], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => 'failed to create'], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }

        return response()->view('cms.requests.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view', Application::class);

        $request = Application::findOrFail($id);
        return response()->view('cms.requests.show', compact('request'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', Application::class);

        $request = Application::findOrFail($id);
        $delete = $request->delete();
    }
}
