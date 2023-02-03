<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use Illuminate\Auth\Events\Validated;
use Illuminate\Database\Events\ModelsPruned;
use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\Count;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', City::class);

        $cities = City::orderby('id', 'desc')->paginate(5);
        return response()->view('cms\cities\index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', City::class);

        $countries = Country::all();
        return view('cms.cities.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', City::class);

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
            return ['redirect' => route('cities.index')];

            if ($issaved) {

                return response()->json(['icon' => 'success', 'title' => 'Created successfully'], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => 'fails to create'], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }

        return response()->view('cms.cities.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view', City::class);

        $city = City::findOrfail($id);
        return response()->view('cms\cities\show', compact('city'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update', City::class);

        $city = City::findOrfail($id);
        $countries = Country::all();
        return response()->view('cms\cities\edit', compact('city', 'countries'));
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
        $this->authorize('update', City::class);

        $validator = validator($request->all(), [
            'name' => 'required | string |min:3 |max:10',
            'street' => 'required | string |min:3 |max:10'
        ]);

        if (!$validator->fails()) {
            $city = City::findOrFail($id);
            $city->name = $request->name;
            $city->street = $request->street;
            $city->country_id = $request->country_id;
            $isupdated = $city->save();

            return ['redirect' => route('cities.index')];

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
        $this->authorize('delete', City::class);
        $city = City::findOrfail($id);
        $city->delete();
        return response()->json(['icon' => 'success', 'title' => 'Deleted Successfully'], 200);
    }
}