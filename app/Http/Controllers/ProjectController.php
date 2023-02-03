<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Project;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Project::class);

        $projects = Project::orderby('id', 'desc')->paginate(5);
        return response()->view('cms\projects\index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Project::class);

        $categories  = Category::all();
        return view('cms.projects.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Project::class);

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

            $issaved = $Project->save();

            return ['redirect' => route('projects.index')];

            if ($issaved) {

                return response()->json(['icon' => 'success', 'title' => 'Created successfully'], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => 'fails to create'], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }

        return response()->view('cms.projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view', Project::class);

        $Project = Project::findOrfail($id);
        return response()->view('cms\projects\show', compact('Project'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update', Project::class);

        $Project = Project::findOrfail($id);
        $categories  = Category::all();
        return response()->view('cms\projects\edit', compact('Project', 'categories'));
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
        $this->authorize('update', Project::class);

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

            return ['redirect' => route('projects.index')];

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
        $this->authorize('delete', Project::class);

        $Project = Project::findOrfail($id);
        $Project->delete();
        return response()->json(['icon' => 'success', 'title' => 'Deleted Successfully'], 200);
    }
}
