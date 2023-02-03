<?php

namespace App\Http\Controllers;

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
        $this->authorize('viewAny', Testimonial::class);

        $testimonials = Testimonial::orderby('id', 'desc')->paginate(5);
        return response()->view('cms\testimonials\index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Testimonial::class);

        return view('cms.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Testimonial::class);

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

            return ['redirect' => route('testimonials.index')];

            if ($issaved) {

                return response()->json(['icon' => 'success', 'title' => 'Created successfully'], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => 'faild to create'], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }

        return response()->view('cms.testimonials.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view', Testimonial::class);

        $testimonial = Testimonial::findOrfail($id);
        return response()->view('cms\testimonials\show', compact('testimonial'));
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

        $testimonial = Testimonial::findOrfail($id);
        return response()->view('cms\testimonials\edit', compact('testimonial'));
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
        $this->authorize('update', Testimonial::class);

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


            return ['redirect' => route('testimonials.index')];

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
        $this->authorize('delete', Testimonial::class);

        $testimonial = Testimonial::findOrfail($id);
        $testimonial->delete();
        return response()->json(['icon' => 'success', 'title' => 'Deleted Successfully'], 200);
    }
}
