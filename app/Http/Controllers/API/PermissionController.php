<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::orderBy('id', 'desc')->get();
        return response()->json([
            'status' => 'true',
            'message' => 'All permissions In Data Base ',
            'data' => $permissions
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
                'guard_name' => 'required',
                'name' => 'required',
            ],
            [
                'name.required' => 'Enter Feature name. ',
                'guard_name.required ' => 'Enter Admin or Author as a guard_name',

            ]

        );

        if (!$validator->fails()) {
            $permisiion = new Permission();
            $permisiion->guard_name = $request->get('guard_name');
            $permisiion->name = $request->get('name');

            $isSaved = $permisiion->save();
            if ($isSaved) {

                return response()->json([
                    'status' => true,
                    'message' => 'Created permisiion successfully',
                    'RequestStatus' => 200
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Faild to create permisiion ',
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = validator(
            $request->all(),
            [
                'guard_name' => 'required',
                'name' => 'required',
            ],
            [
                'name.required' => 'Enter Feature name. ',
                'guard_name.required ' => 'Enter Admin or Author as a guard_name',

            ]
        );

        if (!$validator->fails()) {
            $permission = Permission::findOrFail($id);
            $permission->guard_name = $request->get('guard_name');
            $permission->name = $request->get('name');
            $isupdated = $permission->save();

            if ($isupdated) {
                return response()->json([
                    'status' => true,
                    'message' => 'Updated permission successfully',
                    'RequestStatus' => 200
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Faild to Update permission',
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
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return response()->json([
            'status' => true,
            'message' => 'Deleted successfully',
            'RequestStatus' => 200
        ]);
    }
}