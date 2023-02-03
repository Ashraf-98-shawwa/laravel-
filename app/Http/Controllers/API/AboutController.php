<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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
        $about = About::orderBy('created_at', 'desc')->get();
        return response()->json([
            'status' => 'true',
            'message' => ' About In Data Base ',
            'data' => $about
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

        $count = About::count();

        if ($count >= 1) {
            return response()->json([
                'status' => false,
                'message' => 'About already created ',
                'RequestStatus' =>  400
            ]);

        } else {
            $validator = validator(
                $request->all(),
                [
                    'heading' => 'required | string |min:3 ',
                    'paragraph_1' => 'required | string |min:30 ',
                    'paragraph_2' => 'required | string |min:30 ',
                    'paragraph_3' => 'required | string |min:30 ',
                    // 'image' => "required|image|max:2048|mimes:png,jpg,jpeg,pdf",
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

                if ($issaved) {

                    return response()->json([
                        'status' => true,
                        'message' => 'Created About successfully',
                        'RequestStatus' => 200
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Faild to create About ',
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


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $about = About::findOrfail($id);

        if ($about) {
            return response()->json([
                'status' => true,
                'message' => 'About information ',
                'RequestStatus' =>  400,
                'data' => $about

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
        $validator = validator($request->all(),
            [
                // 'heading' => 'required | string |min:3 ',
                'paragraph_1' => 'required | string |min:30 ',
                'paragraph_2' => 'required | string |min:30 ',
                'paragraph_3' => 'required | string |min:30 ',

            ],
            [
                'heading.required' => 'Enter About Heading. ',
                'paragraph_1.required' => 'Enter About Paragraph 1',
                'paragraph_2.required' => 'Enter About Paragraph 2',
                'paragraph_3.required' => 'Enter About Paragraph 3',

            ]);

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

            $isupdated = $about->save();


            if ($isupdated) {
                return response()->json([
                    'status' => true,
                    'message' => 'Updated About successfully',
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
        $about = About::findOrfail($id);
        $about->delete();
        return response()->json([
            'status' => true,
            'message' => 'Deleted successfully',
            'RequestStatus' => 200
        ]);
    }
}