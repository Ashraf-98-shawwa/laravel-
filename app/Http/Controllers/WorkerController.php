<?php

namespace App\Http\Controllers;

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
        $this->authorize('viewAny', Worker::class);

        $workers = Worker::orderby('id', 'desc')->paginate(5);
        return response()->view('cms\workers\index', compact('workers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Worker::class);

        return view('cms.workers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Worker::class);

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
            return ['redirect' => route('workers.index')];

            if ($issaved) {

                return response()->json(['icon' => 'success', 'title' => 'Created successfully'], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => 'faild to create'], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }

        return response()->view('cms.workers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view', Worker::class);

        $worker = Worker::findOrfail($id);
        return response()->view('cms\workers\show', compact('worker'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update', Testimonial::class);

        $worker = Worker::findOrfail($id);
        return response()->view('cms\workers\edit', compact('worker'));
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
        $this->authorize('update', Worker::class);

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

            $issaved = $worker->save();
            return ['redirect' => route('workers.index')];

            if ($issaved) {

                return response()->json(['icon' => 'success', 'title' => 'Updated successfully'], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => 'faild to update'], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }

        return response()->view('cms.workers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', Worker::class);

        $worker = Worker::findOrfail($id);
        $worker->delete();
        return response()->json(['icon' => 'success', 'title' => 'Deleted Successfully'], 200);
    }
}