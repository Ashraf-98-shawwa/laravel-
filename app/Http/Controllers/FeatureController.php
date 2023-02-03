<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Feature::class);

        $features = Feature::orderby('id', 'desc')->paginate(5);
        return response()->view('cms\features\index', compact('features'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Feature::class);

        return view('cms.features.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Feature::class);

        $validator = validator(
            $request->all(),
            [
                'name' => 'required | string |min:3',

            ],
            [
                'name.required' => 'Enter Feature name. ',


            ]

        );

        if (!$validator->fails()) {
            $feature = new Feature();
            $feature->name = $request->name;
            $issaved = $feature->save();
            return ['redirect' => route('features.index')];

            if ($issaved) {

                return response()->json(['icon' => 'success', 'title' => 'Created successfully'], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => 'faild to create'], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }

        return response()->view('cms.features.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view', Feature::class);

        $feature = Feature::findOrfail($id);
        return response()->view('cms\features\show', compact('feature'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update', Feature::class);

        $feature = Feature::findOrfail($id);
        return response()->view('cms\features\edit', compact('feature'));
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
        $this->authorize('update', Feature::class);

        $validator = validator(
            $request->all(),
            [
                'name' => 'required | string |min:3',

            ],
            [
                'name.required' => 'Enter Feature name. ',


            ]

        );

        if (!$validator->fails()) {
            $feature = Feature::findOrfail($id);
            $feature->name = $request->name;
            $issaved = $feature->save();

            return ['redirect' => route('features.index')];

            if ($issaved) {

                return response()->json(['icon' => 'success', 'title' => 'Updated successfully'], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => 'faild to update'], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }

        return response()->view('cms.features.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', Feature::class);

        $feature = Feature::findOrfail($id);
        $isdeleted = $feature->delete();
        return response()->json(['icon' => 'success', 'title' => 'Deleted Successfully'], 200);
    }
}