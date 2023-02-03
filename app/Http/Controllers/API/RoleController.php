<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return response()->json([
            'status' => 'true',
            'message' => 'All Roles In Data Base ',
            'data' => $roles
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
            $role = new Role();
            $role->guard_name = $request->get('guard_name');
            $role->name = $request->get('name');

            $isSaved = $role->save();
            if ($isSaved) {

                return response()->json([
                    'status' => true,
                    'message' => 'Created Role successfully',
                    'RequestStatus' => 200
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Faild to create Role ',
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

    public function show($id)
    {
        $role = Role::findOrfail($id);

        if ($role) {
            return response()->json([
                'status' => true,
                'message' => 'Role information ',
                'RequestStatus' =>  400,
                'data' => $role

            ]);
        }
    }


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
            $role = Role::findOrFail($id);
            $role->guard_name = $request->get('guard_name');
            $role->name = $request->get('name');




            $isupdated = $role->save();

            if ($isupdated) {
                return response()->json([
                    'status' => true,
                    'message' => 'Updated Role successfully',
                    'RequestStatus' => 200
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Faild to Update project',
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
        $role = Role::findOrFail($id);
        $role->delete();
        return response()->json([
            'status' => true,
            'message' => 'Deleted successfully',
            'RequestStatus' => 200
        ]);
    }
}