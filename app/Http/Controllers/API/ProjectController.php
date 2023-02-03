<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderBy('id', 'desc')->get();
        return response()->json([
            'status' => 'true',
            'message' => 'All projects In Data Base ',
            'data' => $projects
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
                'image' => "required|image|max:2048|mimes:png,jpg,jpeg,pdf",
                'location' => 'required | string |min:3 ',
                'category_id' => 'required',
            ],
            [
                'image.required' => 'Upload Project image.',
                'name.required' => 'Enter Project name. ',
                'location.required' => 'Enter Project location. ',
                'category_id.required' => 'select a category. ',

            ]

        );

        if (!$validator->fails()) {
            $Project = new Project();
            if (request()->hasFile('image')) {

                $image = $request->file('image');

                $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                $image->move('storage/images/Project', $imageName);

                $Project->image = $imageName;
            }
            $Project->name = $request->name;
            $Project->location = $request->location;
            $Project->category_id = $request->category_id;

            $isSaved = $Project->save();
            if ($isSaved) {

                return response()->json([
                    'status' => true,
                    'message' => 'Created Project successfully',
                    'RequestStatus' => 200
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Faild to create Project ',
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

    public function show($id)
    {
        $Project = Project::findOrfail($id);

        if ($Project) {
            return response()->json([
                'status' => true,
                'message' => 'Project information ',
                'RequestStatus' =>  400,
                'data' => $Project

            ]);
        }
    }


    public function update(Request $request, $id)
    {
        $validator = validator(
            $request->all(),
            [
                'name' => 'required | string |min:3',
                'location' => 'required | string |min:3 ',
                'category_id' => 'required',
            ],
            [
                'name.required' => 'Enter Project name. ',
                'location.required' => 'Enter Project location. ',
                'category_id.required' => 'select a category. ',

            ]
        );

        if (!$validator->fails()) {
            $Project = Project::findOrFail($id);


            if (request()->hasFile('image')) {

                $image = $request->file('image');

                $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                $image->move('storage/images/Project', $imageName);

                $Project->image = $imageName;
            }


            $Project->name = $request->name;
            $Project->location = $request->location;
            $Project->category_id = $request->category_id;


            $isupdated = $Project->save();

            if ($isupdated) {
                return response()->json([
                    'status' => true,
                    'message' => 'Updated project successfully',
                    'RequestStatus' => 200
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Faild to Update project',
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
        $Project = Project::findOrfail($id);
        $Project->delete();
        return response()->json([
            'status' => true,
            'message' => 'Deleted successfully',
            'RequestStatus' => 200
        ]);
    }
}
