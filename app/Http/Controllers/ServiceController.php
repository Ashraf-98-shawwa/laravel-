<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Service::class);

        $services = Service::orderby('id', 'desc')->paginate(5);
        return response()->view('cms\services\index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Service::class);

        return view('cms.services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Service::class);

        $validator = validator(
            $request->all(),
            [
                'name' => 'required | string |min:5 ',
                'description' => 'required | string |min:30 ',
                'icon' => "required",
                'image' => "required|image|max:2048|mimes:png,jpg,jpeg,pdf",

            ],
            [
                'image.required' => 'Upload Service Image.',
                'description.required' => 'Enter Service Description',
                'name.required' => 'Enter Service Name. ',
                'icon.required' => 'Select icon for Service. ',

            ]

        );

        if (!$validator->fails()) {
            $service = new Service();
            if (request()->hasFile('image')) {

                $image = $request->file('image');

                $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                $image->move('storage/images/service', $imageName);

                $service->image = $imageName;
            }
            $service->name = $request->name;
            $service->description = $request->description;
            $service->icon = $request->icon;

            $issaved = $service->save();

            return ['redirect' => route('services.index')];

            if ($issaved) {

                return response()->json(['icon' => 'success', 'title' => 'Created successfully'], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => 'faild to create'], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }

        return response()->view('cms.services.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view', Service::class);

        $service = Service::findOrfail($id);
        return response()->view('cms\services\show', compact('service'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update', Service::class);

        $service = Service::findOrfail($id);
        return response()->view('cms\services\edit', compact('service'));
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
        $this->authorize('update', Service::class);

        $validator = validator(
            $request->all(),
            [
                'name' => 'required | string |min:5 ',
                'description' => 'required | string |min:30 ',
                'icon' => "required",

            ],
            [
                'description.required' => 'Enter Service Description',
                'name.required' => 'Enter Service Name. ',
                'icon.required' => 'Select icon for Service. ',

            ]
        );

        if (!$validator->fails()) {

            $service = Service::findOrfail($id);


            if (request()->hasFile('image')) {

                $image = $request->file('image');

                $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                $image->move('storage/images/service', $imageName);

                $service->image = $imageName;
            }


            $service->name = $request->name;
            $service->description = $request->description;
            $service->icon = $request->icon;

            $isupdated = $service->save();


            return ['redirect' => route('services.index')];

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
        $this->authorize('delete', Service::class);
        $service = Service::findOrfail($id);
        $service->delete();
        return response()->json(['icon' => 'success', 'title' => 'Deleted Successfully'], 200);
    }
}
