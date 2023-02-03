<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderby('id', 'desc')->get();
        return response()->json([
            'status' => 'true',
            'message' => 'All Categories In Data Base ',
            'data' => $categories
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
                'image' => "required|image|max:2048|mimes:png,jpg,jpeg,pdf"
            ],
            [
                'image.required' => 'Upload category image.',
                'name.required' => 'Enter category name. ',
            ]

        );

        if (!$validator->fails()) {
            $category = new Category();

            if (request()->hasFile('image')) {

                $image = $request->file('image');

                $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                $image->move('storage/images/category', $imageName);

                $category->image = $imageName;
            }
            $category->name = $request->name;

            $issaved = $category->save();

            if ($issaved) {

                return response()->json([
                    'status' => true,
                    'message' => 'Created Category successfully',
                    'RequestStatus' => 200
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Faild to create City ',
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
        $category = Category::findOrfail($id);

        if ($category) {
            return response()->json([
                'status' => true,
                'message' => 'Category information ',
                'RequestStatus' =>  400,
                'data' => $category

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
                // 'name' => 'required | string |min:3 ',
            ],
            [
                'name.required' => 'Enter category name. ',
            ]

        );

        if (!$validator->fails()) {
            $category = Category::findOrFail($id);


            if (request()->hasFile('image')) {

                $image = $request->file('image');

                $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                $image->move('storage/images/category', $imageName);

                $category->image = $imageName;
            }


            $category->name = $request->name;
            $isupdated = $category->save();


            if ($isupdated) {
                return response()->json([
                    'status' => true,
                    'message' => 'Updated Category successfully',
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
        $category = Category::findOrfail($id);
        $category->delete();
        return response()->json([
            'status' => true,
            'message' => 'Deleted successfully',
            'RequestStatus' => 200
        ]);
    }
}