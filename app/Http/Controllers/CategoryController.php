<?php

namespace App\Http\Controllers;

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
        $this->authorize('viewAny', Category::class);
        $categories = Category::withCount('projects')->withCount('articles')->orderby('id', 'desc')->paginate(5);
        return response()->view('cms\categories\index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Category::class);
        return view('cms.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Category::class);

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

            return ['redirect' => route('categories.index')];

            if ($issaved) {

                return response()->json(['icon' => 'success', 'title' => 'Created successfully'], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => 'fails to create'], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }

        return response()->view('cms.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view', Category::class);

        $category = Category::findOrfail($id);
        return response()->view('cms\categories\show', compact('category'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update', Category::class);

        $category = Category::findOrfail($id);

        return response()->view('cms\categories\edit', compact('category'));
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
        $this->authorize('update', Category::class);

        $validator = validator($request->all(),
            [
                'name' => 'required | string |min:3',

            ],
            [
                'name.required' => 'Enter category name. ',

            ]);

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

            return ['redirect' => route('categories.index')];

            // if ($isupdated) {
            //     return response()->json(['icon' => 'success', 'title' => 'Upadted successfully'], 200);

            // } else {
            //     return response()->json(['icon' => 'error', 'title' => 'fails to update'], 400);
            // }
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
        $this->authorize('delete', Category::class);
        $category = Category::findOrfail($id);
        $category->delete();
        return response()->json(['icon' => 'success', 'title' => 'Deleted Successfully'], 200);
    }
}