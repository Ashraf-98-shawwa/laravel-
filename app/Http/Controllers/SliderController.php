<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Slider::class);

        $sliders = Slider::orderby('id', 'desc')->paginate(5);
        return response()->view('cms\sliders\index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Slider::class);

        return view('cms.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Slider::class);

        $validator = validator(
            $request->all(),
            [
                'heading' => 'required | string |min:5 ',
                'image' => "required|image|max:2048|mimes:png,jpg,jpeg,pdf",
                'icon' => "required",

            ],
            [
                'image.required' => 'Upload slider image.',
                'heading.required' => 'Enter slider heading. ',
                'icon.required' => 'Select icon for slider. ',

            ]

        );

        if (!$validator->fails()) {
            $slider = new Slider();
            if (request()->hasFile('image')) {

                $image = $request->file('image');

                $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                $image->move('storage/images/slider', $imageName);

                $slider->image = $imageName;
            }
            $slider->heading = $request->heading;
            $slider->icon = $request->icon;

            $issaved = $slider->save();

            return ['redirect' => route('sliders.index')];

            if ($issaved) {

                return response()->json(['icon' => 'success', 'title' => 'Created successfully'], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => 'faild to create'], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }

        return response()->view('cms.sliders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view', Slider::class);

        $slider = Slider::findOrfail($id);
        return response()->view('cms\sliders\show', compact('slider'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update', Slider::class);

        $slider = Slider::findOrfail($id);
        return response()->view('cms\sliders\edit', compact('slider'));
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
        $this->authorize('update', Slider::class);

        $validator = validator(
            $request->all(),
            [
                'heading' => 'required | string |min:5 ',
                'icon' => "required",

            ],
            [
                'heading.required' => 'Enter slider heading. ',
                'icon.required' => 'Select icon for slider. ',

            ]
        );

        if (!$validator->fails()) {

            $slider = Slider::findOrfail($id);


            if (request()->hasFile('image')) {

                $image = $request->file('image');

                $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                $image->move('storage/images/slider', $imageName);

                $slider->image = $imageName;
            }


            $slider->heading = $request->heading;
            $slider->icon = $request->icon;


            $isupdated = $slider->save();

            return ['redirect' => route('sliders.index')];

            if ($isupdated) {
                return response()->json(['icon' => 'success', 'title' => 'Upadted successfully'], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => 'fails to update'], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
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
        $this->authorize('delete', Slider::class);

        $slider = Slider::findOrfail($id);
        $slider->delete();
        return response()->json(['icon' => 'success', 'title' => 'Deleted Successfully'], 200);
    }
}