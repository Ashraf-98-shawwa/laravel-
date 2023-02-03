<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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
        $requests = Application::all();
        return response()->json([
            'status' => 'true',
            'message' => 'All Requests In Data Base ',
            'data' => $requests
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

                return response()->json([
                    'status' => true,
                    'message' => 'Request Created successfully',
                    'RequestStatus' => 200
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Faild to create Request ',
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
        $request = Application::findOrFail($id);

        if ($request) {
            return response()->json([
                'status' => true,
                'message' => 'request information ',
                'RequestStatus' =>  400,
                'data' => $request

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
        $request = Application::findOrFail($id);
        $request->delete();
        return response()->json([
            'status' => true,
            'message' => 'Deleted successfully',
            'RequestStatus' => 200
        ]);
    }
}