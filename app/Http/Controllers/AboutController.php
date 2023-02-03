<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', About::class);
        $count = About::count();
        $abouts = About::orderBy('created_at', 'desc')->paginate(5);
        return response()->view('cms.abouts.index', compact('abouts', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', About::class);

        $count = About::count();

        if ($count >=1) {
            return response()->view('cms.abouts.index',);


        } else {
            return response()->view('cms.abouts.create',);

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', About::class);
        $validator = validator(
            $request->all(),
            [
                'heading' => 'required | string |min:3 ',
                'paragraph_1' => 'required | string |min:30 ',
                'paragraph_2' => 'required | string |min:30 ',
                'paragraph_3' => 'required | string |min:30 ',
                'image' => "required|image|max:2048|mimes:png,jpg,jpeg,pdf",
                // 'signature' => "required|image|max:2048|mimes:png,jpg,jpeg,pdf"

            ],
            [
                'image.required' => 'Upload Article Image.',
                // 'signature.required' => 'Upload Signature Image.',
                'heading.required' => 'Enter About Heading. ',
                'paragraph_1.required' => 'Enter About Paragraph 1',
                'paragraph_2.required' => 'Enter About Paragraph 2',
                'paragraph_3.required' => 'Enter About Paragraph 3',

            ]

        );

        if (!$validator->fails()) {
            $about = new About();
            if (request()->hasFile('image')) {

                $image = $request->file('image');

                $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                $image->move('storage/images/about', $imageName);

                $about->image = $imageName;
            }
            if (request()->hasFile('signature')) {

                $image = $request->file('signature');

                $imageName = time() . 'signature.' . $image->getClientOriginalExtension();

                $image->move('storage/images/about', $imageName);

                $about->signature = $imageName;
            }
            $about->heading = $request->heading;
            $about->paragraph_1 = $request->paragraph_1;
            $about->paragraph_2 = $request->paragraph_2;
            $about->paragraph_3 = $request->paragraph_3;

            $issaved = $about->save();

            return ['redirect' => route('abouts.index')];

            if ($issaved) {

                return response()->json(['icon' => 'success', 'title' => 'Created successfully'], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => 'failed to create'], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }

        return response()->view('cms.abouts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view', About::class);
        $about = About::findOrfail($id);
        return response()->view('cms.abouts.show', compact('about'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update', About::class);
        $about = About::findOrfail($id);
        return response()->view('cms.abouts.edit', compact('about'));
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
        $this->authorize('update', About::class);
        $validator = validator(
            $request->all(),
            [
                'heading' => 'required | string |min:3 ',
                'paragraph_1' => 'required | string |min:30 ',
                'paragraph_2' => 'required | string |min:30 ',
                'paragraph_3' => 'required | string |min:30 ',

            ],
            [
                'heading.required' => 'Enter About Heading. ',
                'paragraph_1.required' => 'Enter About Paragraph 1',
                'paragraph_2.required' => 'Enter About Paragraph 2',
                'paragraph_3.required' => 'Enter About Paragraph 3',

            ]


        );

        if (!$validator->fails()) {
            $about = About::findOrfail($id);
            if (request()->hasFile('image')) {

                $image = $request->file('image');

                $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                $image->move('storage/images/about', $imageName);

                $about->image = $imageName;
            }
            if (request()->hasFile('signature')) {

                $image = $request->file('signature');

                $imageName = time() . 'signature.' . $image->getClientOriginalExtension();

                $image->move('storage/images/about', $imageName);

                $about->signature = $imageName;
            }


            $about->heading = $request->heading;
            $about->paragraph_1 = $request->paragraph_1;
            $about->paragraph_2 = $request->paragraph_2;
            $about->paragraph_3 = $request->paragraph_3;

            $issaved = $about->save();

            return ['redirect' => route('abouts.index')];

            if ($issaved) {

                return response()->json(['icon' => 'success', 'title' => 'Updated successfully'], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => 'failed to update'], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }

        return response()->view('cms.abouts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', About::class);
        $about = About::destroy($id);
    }
}