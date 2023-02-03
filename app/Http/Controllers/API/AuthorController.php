<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::orderBy('created_at', 'desc')->get();
        return response()->json([
            'status' => 'true',
            'message' => ' All Authors In Data Base ',
            'data' => $authors
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
                'date' => "required|date",
                'address' => "required",
                'city_id' => "required",
                'role_id' => "required",
                'gender' => "required",
                'image' => "required|image|max:2048|mimes:png,jpg,jpeg,pdf"
            ],
            [
                'image.required' => 'Upload an image.',
                'email.required' => 'Enter email address. ',
                'first_name.required' => 'Enter Author first name . ',
                'last_name.required' => 'Enter Author last name . ',
                'mobile.required' => 'Enter Author mobile number. ',
                'date.required' => 'Enter Author date of birth. ',
                'address.required' => 'Enter Author address. ',
                'password.required' => 'Enter Author password. ',
                'gender.required' => 'Select Author Gender ',
                'city_id.required' => 'Select Author City. ',
                'role_id.required' => 'Select Author role. '


            ]

        );


        if (!$validator->fails()) {
            $author = new Author();
            $author->email = $request->email;
            $author->password = Hash::make($request->get('password'));
            $issaved = $author->save();



            $roles = Role::findOrFail($request->get('role_id'));
            $author->assignRole($roles->name);
            if ($issaved) {
                $user = new User();
                if (request()->hasFile('image')) {

                    $image = $request->file('image');

                    $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                    $image->move('storage/images/author', $imageName);

                    $user->image = $imageName;
                }

                $user->gender = $request->gender;
                $user->address = $request->address;
                $user->date = $request->date;
                $user->mobile = $request->mobile;
                $user->last_name = $request->last_name;
                $user->first_name = $request->first_name;
                $user->city_id = $request->city_id;
                $user->user()->associate($author); // to associate the new admin with the apropriate user.
                $isSaved = $user->save();

                if ($isSaved) {

                    return response()->json([
                        'status' => true,
                        'message' => 'Created Author successfully',
                        'RequestStatus' => 200
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Faild to create Author ',
                        'RequestStatus' =>  400
                    ]);
                }
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
        $author = Author::findOrfail($id);


        return response()->json([
            'status' => true,
            'message' => 'Admin information ',
            'RequestStatus' =>  400,
            'data' => $author

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
                'password' => "required",
                'first_name' => "required|string",
                'last_name' => "required|string | min:3 | max:10",
                'mobile' => "required|numeric|digits:10",
                'date' => "required|date",
                'address' => "required",
                'city_id' => "required",
                'gender' => "required",
                'role_id' => "required",

            ],
            [
                'email.required' => 'Enter email address. ',
                'first_name.required' => 'Enter Author first name . ',
                'last_name.required' => 'Enter Author last name . ',
                'mobile.required' => 'Enter Author mobile number. ',
                'date.required' => 'Enter Author date of birth. ',
                'address.required' => 'Enter Author address. ',
                'password.required' => 'Enter Author password. ',
                'gender.required' => 'Select Author Gender ',
                'city_id.required' => 'Select Author City. ',
                'role_id.required' => 'Select Author City. '
            ]
        );

        if (!$validator->fails()) {
            $author = Author::findOrFail($id);
            $author->email = $request->email;
            $author->password = Hash::make($request->get('password'));
            $issaved = $author->save();

            // to set the role of the author
            $roles = Role::findOrFail($request->get('role_id'));
            $author->assignRole($roles->name);

            $user = $author->user;
            if (request()->hasFile('image')) {

                $image = $request->file('image');

                $imageName = time() . 'image.' . $image->getClientOriginalExtension();

                $image->move('storage/images/author', $imageName);

                $user->image = $imageName;
            }

            $user->gender = $request->gender;
            $user->address = $request->address;
            $user->date = $request->date;
            $user->mobile = $request->mobile;
            $user->last_name = $request->last_name;
            $user->first_name = $request->first_name;
            $user->city_id = $request->city_id;
            $isSaved = $user->save();

            if ($issaved) {

                return response()->json([
                    'status' => true,
                    'message' => 'Updated Author successfully',
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
        $author = Author::findOrfail($id);
        $author->delete();
        return response()->json([
            'status' => true,
            'message' => 'Deleted successfully',
            'RequestStatus' => 200
        ]);
    }
}