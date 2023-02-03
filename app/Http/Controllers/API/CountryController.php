<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::withCount('cities')->orderby('id', 'desc')->get();
        return response()->json([
            'status' => 'true',
            'message' => 'All Countries In Data Base ',
            'data' => $countries
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
                'code' => 'required | numeric |min:0 |max:10000'
            ]

        );

        if (!$validator->fails()) {
            $country = new Country();
            $country->name = $request->name;
            $country->code = $request->code;
            $issaved = $country->save();

            if ($issaved) {

                return response()->json([
                    'status' => true,
                    'message' => 'Country Created successfully',
                    'RequestStatus' => 200
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Faild to create Country ',
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
        $country = Country::findOrfail($id);

        if ($country) {
            return response()->json([
                'status' => true,
                'message' => 'Country information ',
                'RequestStatus' =>  400,
                'data' => $country

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
        $validator = validator($request->all(), [
            'name' => 'required | string |min:3',
            'code' => 'required | numeric |min:0 |max:10000'
        ]);

        if (!$validator->fails()) {
            $country = Country::findOrFail($id);
            $country->name = $request->name;
            $country->code = $request->code;
            $isupdated = $country->save();


            if ($isupdated) {
                return response()->json([
                    'status' => true,
                    'message' => 'Updated Country successfully',
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
        $country = Country::findOrFail($id);
        $country->delete();
        return response()->json([
            'status' => true,
            'message' => 'Deleted successfully',
            'RequestStatus' => 200
        ]);
    }
}
