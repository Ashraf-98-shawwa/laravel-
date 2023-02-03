<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workers = Worker::orderby('id', 'desc')->get();
        return response()->json([
            'status' => 'true',
            'message' => 'All workers In Data Base ',
            'data' => $workers
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
                'name' => 'required | string |min:3',
                'position' => 'required | string |min:5',
                'twitter_link' => "required",
                'facebook_link' => "required",
                'instagram_link' => "required",
                'linkedin_link' => "required",
                'youtube_link' => "required",
                'image' => "required|image|max:2048|mimes:png,jpg,jpeg,pdf",


            ],
            [
                'name.required' => 'Enter worker name. ',
                'position.required' => 'Enter worker position title. ',
                'twitter_link.required' => 'Enter Worker Link On Twitter. ',
                'facebook_link.required' => 'Enter Worker Link On facebook. ',
                'instagram_link.required' => 'Enter Worker Link On instagram. ',
                'linkedin_link.required' => 'Enter Worker Link On linkedin. ',
                'youtube_link.required' => 'Enter Worker Link On linkedin. ',
                'image.required' => 'Upload Worker Image.',


            ]


        );

        if (!$validator->fails()) {
            $worker = new Worker();
            if (request()->hasFile('image')) {

                $image = $request->file('image');

                $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                $image->move('storage/images/worker', $imageName);

                $worker->image = $imageName;
            }
            $worker->name = $request->name;
            $worker->position = $request->position;
            $worker->twitter_link = $request->twitter_link;
            $worker->facebook_link = $request->facebook_link;
            $worker->linkedin_link = $request->linkedin_link;
            $worker->instagram_link = $request->instagram_link;
            $worker->youtube_link = $request->youtube_link;

            $issaved = $worker->save();
            if ($issaved) {

                return response()->json([
                    'status' => true,
                    'message' => 'Worker Created successfully',
                    'RequestStatus' => 200
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Faild to create Worker ',
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
        $worker = Worker::findOrfail($id);

        if ($worker) {
            return response()->json([
                'status' => true,
                'message' => 'worker information ',
                'RequestStatus' =>  400,
                'data' => $worker

            ]);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = validator(

            $request->all(),
            [
                'name' => 'required | string |min:3',
                'position' => 'required | string |min:5',
                'twitter_link' => "required",
                'facebook_link' => "required",
                'instagram_link' => "required",
                'linkedin_link' => "required",
                'youtube_link' => "required",

            ],
            [
                'name.required' => 'Enter worker name. ',
                'position.required' => 'Enter worker position title. ',
                'twitter_link.required' => 'Enter Worker Link On Twitter. ',
                'facebook_link.required' => 'Enter Worker Link On facebook. ',
                'instagram_link.required' => 'Enter Worker Link On instagram. ',
                'linkedin_link.required' => 'Enter Worker Link On linkedin. ',
                'youtube_link.required' => 'Enter Worker Link On linkedin. '

            ]
        );

        if (!$validator->fails()) {
            $worker = Worker::findOrfail($id);
            if (request()->hasFile('image')) {

                $image = $request->file('image');

                $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                $image->move('storage/images/worker', $imageName);

                $worker->image = $imageName;
            }
            $worker->name = $request->name;
            $worker->position = $request->position;
            $worker->twitter_link = $request->twitter_link;
            $worker->facebook_link = $request->facebook_link;
            $worker->linkedin_link = $request->linkedin_link;
            $worker->instagram_link = $request->instagram_link;
            $worker->youtube_link = $request->youtube_link;


            $isupdated = $worker->save();



            if ($isupdated) {
                return response()->json([
                    'status' => true,
                    'message' => 'Updated Worker successfully',
                    'RequestStatus' => 200
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Faild to Update',
                    'RequestStatus' => 400
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $this->authorize('delete', City::class);
        $worker = Worker::findOrfail($id);
        $worker->delete();
        return response()->json([
            'status' => true,
            'message' => 'Deleted successfully',
            'RequestStatus' => 200
        ]);
    }
}