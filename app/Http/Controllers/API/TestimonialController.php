<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = Testimonial::orderby('id', 'desc')->get();
        return response()->json([
            'status' => 'true',
            'message' => 'All Testimonials In Data Base ',
            'data' => $testimonials
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
                'client_name' => 'required | string |min:5 ',
                'client_position' => 'required | string |min:5 ',
                'client_testimonial' => 'required | string |min:30 ',
                'image' => "required|image|max:2048|mimes:png,jpg,jpeg,pdf",

            ],
            [
                'image.required' => 'Upload Testimonial Image.',
                'client_testimonial.required' => 'Enter Client Testimonial.',
                'client_position.required' => 'Enter Client Position. ',
                'client_name.required' => 'Enter Client Name. ',

            ]

            );

            if (!$validator->fails()) {
            $testimonial = new Testimonial();
            if (request()->hasFile('image')) {

                $image = $request->file('image');

                $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                $image->move('storage/images/testimonial', $imageName);

                $testimonial->image = $imageName;
            }
            $testimonial->client_name = $request->client_name;
            $testimonial->client_position = $request->client_position;
            $testimonial->client_testimonial = $request->client_testimonial;

            $issaved = $testimonial->save();
                if ($issaved) {

                    return response()->json([
                        'status' => true,
                        'message' => 'Testimonial Created successfully',
                        'RequestStatus' => 200
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Faild to create Testimonial ',
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
        $testimonial = Testimonial::findOrfail($id);

        if ($testimonial) {
            return response()->json([
                'status' => true,
                'message' => 'Testimonial information ',
                'RequestStatus' =>  400,
                'data' => $testimonial

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
                'client_name' => 'required | string |min:5 ',
                'client_position' => 'required | string |min:5 ',
                'client_testimonial' => 'required | string |min:30 ',

            ],
            [
                'image.require' => ' Testimonial Image.',                'client_testimonial.required' => 'Enter Client Testimonial.',
                'client_position.required' => 'Enter Client Position. ',
                'client_name.required' => 'Enter Client Name. ',

            ]
        );

        if (!$validator->fails()) {
            $testimonial = Testimonial::findOrfail($id);


            if (request()->hasFile('image')) {

                $image = $request->file('image');

                $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                $image->move('storage/images/service', $imageName);

                $testimonial->image = $imageName;
            }

            $testimonial->client_name = $request->client_name;
            $testimonial->client_position = $request->client_position;
            $testimonial->client_testimonial = $request->client_testimonial;

            $isupdated = $testimonial->save();



            if ($isupdated) {
                return response()->json([
                    'status' => true,
                    'message' => 'Updated Testimonial successfully',
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
        $testimonial = Testimonial::findOrfail($id);
        $testimonial->delete();
        return response()->json([
            'status' => true,
            'message' => 'Deleted successfully',
            'RequestStatus' => 200
        ]);
    }
}
