<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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
        $Slider = Slider::orderby('id', 'desc')->get();
        return response()->json([
            'status' => 'true',
            'message' => 'All Sliders In Data Base ',
            'data' => $Slider
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
            if ($issaved) {

                return response()->json([
                    'status' => true,
                    'message' => 'Slider Created successfully',
                    'RequestStatus' => 200
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Faild to create Slider ',
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
        $slider = Slider::findOrfail($id);

        if ($slider) {
            return response()->json([
                'status' => true,
                'message' => 'slider information ',
                'RequestStatus' =>  400,
                'data' => $slider

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


            if ($isupdated) {
                return response()->json([
                    'status' => true,
                    'message' => 'Updated Slider successfully',
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
        $slider = Slider::findOrfail($id);
        $slider->delete();
        return response()->json([
            'status' => true,
            'message' => 'Deleted successfully',
            'RequestStatus' => 200
        ]);
    }
}