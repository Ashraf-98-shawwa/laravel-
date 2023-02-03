<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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
        $features = Feature::orderby('id', 'desc')->get();
        return response()->json([
            'status' => 'true',
            'message' => 'All features In Data Base ',
            'data' => $features
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

            if ($issaved) {

                return response()->json([
                    'status' => true,
                    'message' => 'Created Feature successfully',
                    'RequestStatus' => 200
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Faild to create Feature ',
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
        $feature = Feature::findOrfail($id);

        if ($feature) {
            return response()->json([
                'status' => true,
                'message' => 'City information ',
                'RequestStatus' =>  400,
                'data' => $feature

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
                'name' => 'required | string |min:3',

            ],
            [
                'name.required' => 'Enter Feature name. ',


            ]);

        if (!$validator->fails()) {
            $feature = Feature::findOrfail($id);
            $feature->name = $request->name;
            $isupdated = $feature->save();


            if ($isupdated) {
                return response()->json([
                    'status' => true,
                    'message' => 'Updated Feature successfully',
                    'RequestStatus' => 200
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Faild to Update Feature',
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
        $feature = Feature::findOrfail($id);
        $feature->delete();
        return response()->json([
            'status' => true,
            'message' => 'Deleted successfully',
            'RequestStatus' => 200
        ]);
    }
}