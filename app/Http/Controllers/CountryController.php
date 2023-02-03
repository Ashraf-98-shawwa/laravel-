<?php

namespace App\Http\Controllers;

use App\Models\City;
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
        $this->authorize('viewAny', Country::class);
        $countries = Country::withCount('cities')->orderby('id', 'desc')->paginate(5);
        return response()->view('cms\countries\index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Country::class);

        return view('cms.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Country::class);

        $validator = validator($request->all(), [
            'name' => 'required | string |min:3',
            'code' => 'required | numeric |min:0 |max:10000'
        ]);

        if (!$validator->fails()) {
            $country = new Country();
            $country->name = $request->name;
            $country->code = $request->code;
            $issaved = $country->save();
            return ['redirect' => route('countries.index')];

            if ($issaved) {

                return response()->json(['icon' => 'success', 'title' => 'Created successfully'], 200);

            } else {
                return response()->json(['icon' => 'error', 'title' => 'fails to create'], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
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
        $this->authorize('view', Country::class);

        $country = Country::findOrfail($id);
        return response()->view('cms\countries\show', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update', Country::class);

        $country = Country::findOrfail($id);

        return response()->view('cms\countries\edit', compact('country'));
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
        $this->authorize('update', Country::class);

        $validator = validator($request->all(), [
            'name' => 'required | string |min:3',
            'code' => 'required | numeric |min:0 |max:10000'
        ]);

        if (!$validator->fails()) {
            $country = Country::findOrFail($id);
            $country->name = $request->name;
            $country->code = $request->code;
            $isupdated = $country->save();

            return ['redirect' => route('countries.index')];

            if ($isupdated) {
                return response()->json(['icon' => 'success', 'title' => 'Upadted successfully'], 200);

            } else {
                return response()->json(['icon' => 'error', 'title' => 'failed to update'], 400);
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
        $this->authorize('delete', Country::class);

        $country = Country::findOrfail($id);
        $isdeleted = $country->delete();
        return response()->json(['icon' => 'success', 'title' => 'Deleted Successfully'], 200);
    }


}