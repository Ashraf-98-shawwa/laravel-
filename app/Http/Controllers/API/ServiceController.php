<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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
        $services = Service::orderby('id', 'desc')->get();
        return response()->json([
            'status' => 'true',
            'message' => 'All services In Data Base ',
            'data' => $services
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
            if ($issaved) {

                return response()->json([
                    'status' => true,
                    'message' => 'Service Created successfully',
                    'RequestStatus' => 200
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Faild to create Service ',
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
        $service = Service::findOrfail($id);

        if ($service) {
            return response()->json([
                'status' => true,
                'message' => 'service information ',
                'RequestStatus' =>  400,
                'data' => $service

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
            'name' => 'required | string |min:5 ',
            'description' => 'required | string |min:30 ',
            'icon' => "required",
            ],
            [
                'description.required' => 'Enter Service Description',
                'name.required' => 'Enter Service Name. ',
                'icon.required' => 'Select icon for Service. ',

            ]);

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



            if ($isupdated) {
                return response()->json([
                    'status' => true,
                    'message' => 'Updated Service successfully',
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
        $service = Service::findOrfail($id);
        $service->delete();
        return response()->json([
            'status' => true,
            'message' => 'Deleted successfully',
            'RequestStatus' => 200
        ]);
    }
}
