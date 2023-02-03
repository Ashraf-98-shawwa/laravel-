<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Admin::class);
        $admins = Admin::with('user')->orderBy('id', 'desc')->paginate(10);
        return response()->view('cms.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Admin::class);
        $cities = City::all();
        $roles = Role::where('guard_name', 'admin')->get();
        return response()->view('cms.admins.create', compact('cities', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Admin::class);
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
                'image' => "required|image|max:2048|mimes:png,jpg,jpeg,pdf"
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
            $issaved = $admin->save();


            // to set the role of the admin
            $roles = Role::findOrFail($request->get('role_id'));
            $admin->assignRole($roles->name);

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

            return ['redirect' => route('admins.index')];

            if ($isSaved) {

                return response()->json(['icon' => 'success', 'title' => 'Created successfully'], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => 'fails to create'], 400);
            }
        } else {
            return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
        }

        return response()->view('cms.admins.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view', Admin::class);
        $admin = Admin::findOrFail($id);
        return response()->view('cms.admins.show', compact('admin'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('update', Admin::class);
        $roles = Role::where('guard_name', 'admin')->get();
        $cities = City::all();
        $admin = Admin::findOrFail($id);

        return response()->view('cms.admins.edit', compact('cities', 'admin', 'roles'));
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
        $this->authorize('update', Admin::class);
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
            $admin = Admin::findOrFail($id);
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
            $isSaved = $user->save();

            return ['redirect' => route('admins.index')];

            if ($isSaved) {

                return response()->json(['icon' => 'success', 'title' => 'Created successfully'], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => 'fails to create'], 400);
            }
            return ['redirect' => route('admins.index')];
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
    public function destroy(Admin $admin)
    {
        $this->authorize('delete', Admin::class);
        if (auth('admin')->check()) {
            if ($admin->id == Auth::id()) {
                return redirect()->route('admins.index');
            } else {
                $admin->delete();
                return response()->json(['icon' => 'success', 'title' => 'Admin Deleted'], 200);
            }
        } else {
            $admin->delete();
            return response()->json(['icon' => 'success', 'title' => 'Admin Deleted'], 200);
        }
    }
}