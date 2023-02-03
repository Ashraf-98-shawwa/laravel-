<?php

namespace App\Http\Controllers\API;

use App\Models\City;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::orderby('id', 'desc')->get();
        return response()->json([
            'status' => 'true',
            'message' => 'All Cities In Data Base ',
            'data' => $cities
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
                'name' => 'required | string |min:3 |max:10',
                'street' => 'required | string |min:3 |max:10',
                'country_id' => 'required '
            ],
            [
                'country_id.required' => 'Choose a country.',
                'name.required' => 'Enter city name. ',
                'street.required' => 'Enter street name. '

            ]

        );

        if (!$validator->fails()) {
            $city = new City();
            $city->name = $request->name;
            $city->street = $request->street;
            $city->country_id = $request->country_id;
            $issaved = $city->save();

            if ($issaved) {

                return response()->json([
                    'status' => true,
                    'message' => 'Created City successfully',
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
        $city = City::findOrfail($id);

        if ($city) {
            return response()->json([
                'status' => true,
                'message' => 'City information ',
                'RequestStatus' =>  400,
                'data' => $city

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
            'name' => 'required| string |min:3 |max:10',
            'street' => 'required | string |min:3 |max:10',
            'country_id.required' => 'Choose a country.'
        ]);

        if (!$validator->fails()) {
            $city = City::findOrFail($id);
            $city->name = $request->name;
            $city->street = $request->street;
            $city->country_id = $request->country_id;
            $isupdated = $city->save();


            if ($isupdated) {
                return response()->json([
                    'status' => true,
                    'message' => 'Updated City successfully',
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
        $city = City::findOrfail($id);
        $city->delete();
        return response()->json([ 'status' => true,
                'message' =>'Deleted successfully',
                'RequestStatus' => 200]);
    }
}