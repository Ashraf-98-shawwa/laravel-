<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::orderBy('created_at', 'desc')->get();
        return response()->json([
            'status' => 'true',
            'message' => ' All Admins In Data Base ',
            'data' => $admins
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
                'email' => "required",
                'password' => "required",
                'first_name' => "required|string",
                'last_name' => "required|string | min:3 | max:10",
                'mobile' => "required|numeric|digits:10",
                'date' => "required",
                'address' => "required",
                'city_id' => "required",
                'role_id' => "required",
                'gender' => "required",
                'image' => "required|image|max:2048|mimes:png,jpg",
            ],
            [
                'image.required' => 'Upload an image.',
                'email.required' => 'Enter email address. ',
                'first_name.required' => 'Enter Admin first name . ',
                'last_name.required' => 'Enter Admin last name . ',
                'mobile.required' => 'Enter Admin mobile number. ',
                'date.required' => 'Enter Admin date of birth. ',
                'address.required' => 'Enter Admin address. ',
                'password.required' => 'Enter Admin password. ',
                'gender.required' => 'Select Admin Gender ',
                'city_id.required' => 'Select Admin City. '

            ]

        );


        if (!$validator->fails()) {
            $admin = new Admin();
            $admin->email = $request->email;
            $admin->password = Hash::make($request->get('password'));
            $save = $admin->save();


            // // to set the role of the admin
            // $roles = Role::findOrFail($request->get('role_id'));
            // $admin->assignRole($roles->name);

            $user = new User();
            if (request()->hasFile('image')) {

                $image = $request->file('image');

                $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                $image->move('storage/images/admin', $imageName);

                $user->image = $imageName;
            }

            $user->gender = $request->gender;
            $user->address = $request->address;
            $user->date = $request->date;
            $user->mobile = $request->mobile;
            $user->last_name = $request->last_name;
            $user->first_name = $request->first_name;
            $user->city_id = $request->city_id;
            $user->user()->associate($admin); // to associate the new admin with the apropriate user.
            $isSaved = $user->save();

            if ($isSaved) {

                return response()->json([
                    'status' => true,
                    'message' => 'Created Admin successfully',
                    'RequestStatus' => 200
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Faild to create Admin ',
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
        $admin = Admin::findOrfail($id);


            return response()->json([
                'status' => true,
                'message' => 'Admin information ',
                'RequestStatus' =>  400,
                'data' => $admin

            ]);

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
        $validator = validator(
            $request->all(),
            [
                'email' => "required",
                'first_name' => "required|string",
                'last_name' => "required|string | min:3 | max:10",
                'mobile' => "required|numeric|digits:10",
                'date' => "required",
                'address' => "required",
                'city_id' => "required",
                'gender' => "required",
            ],
            [
                'email.required' => 'Enter email address. ',
                'first_name.required' => 'Enter Admin first name . ',
                'last_name.required' => 'Enter Admin last name . ',
                'mobile.required' => 'Enter Admin mobile number. ',
                'date.required' => 'Enter Admin date of birth. ',
                'address.required' => 'Enter Admin address. ',
                'password.required' => 'Enter Admin password. ',
                'gender.required' => 'Select Admin Gender ',
                'city_id.required' => 'Select Admin City. '
            ]
        );

        if (!$validator->fails()) {
            $admin = Admin::findOrfail($id);
            $admin->email = $request->email;
            $admin->password = Hash::make($request->get('password'));
            $issaved = $admin->save();


            // to set the role of the admin
            $roles = Role::findOrFail($request->get('role_id'));
            $admin->assignRole($roles->name);

            $user = $admin->user;
            if (request()->hasFile('image')) {

                $image = $request->file('image');

                $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                $image->move('storage/images/admin', $imageName);

                $user->image = $imageName;
            }

            $user->gender = $request->gender;
            $user->address = $request->address;
            $user->date = $request->date;
            $user->mobile = $request->mobile;
            $user->last_name = $request->last_name;
            $user->first_name = $request->first_name;
            $user->city_id = $request->city_id;
            $user->user()->associate($admin); // to associate the new admin with the apropriate user.
            $isSaved = $user->save();

            if ($issaved) {

                return response()->json([
                    'status' => true,
                    'message' => 'Updated Admin successfully',
                    'RequestStatus' => 200
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Faild to update Admin ',
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::findOrfail($id);
        $admin->delete();
        return response()->json([
            'status' => true,
            'message' => 'Deleted successfully',
            'RequestStatus' => 200
        ]);
    }
}