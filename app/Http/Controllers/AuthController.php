<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Author;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Return_;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    public function showLogin($guard)
    {
        return response()->view('auth.login', compact('guard'));
    }


    public function login(Request $request)
    {

        $validator = Validator($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6'

        ]);

        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];
        if (!$validator->fails()) {
            if (Auth::guard($request->get('guard'))->attempt($credentials)) {
                return response()->json(['icon' => 'success', 'title' => 'Login Successfully'], 200);
            } else {
                return response()->json(['icon' => 'error', 'title' => 'Login Failed '], 400);
            }
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], 400);
        }
    }

    public function logout(Request $request)
    {
        $guard = auth('admin')->check() ? 'admin' : 'author';
        Auth::guard($guard)->logout();
        $request->session()->invalidate();
        return redirect()->route('view.login', $guard);
    }


    public function editProfile()
    {

        if (auth('author')->check()) {
            $roles = Role::where('guard_name', 'author')->get();

            $cities = City::all();
            $author = Author::findOrFail(Auth::id());

            return response()->view('auth.edit-Author-profile', compact('roles', 'cities', 'author'));
        }

        if (auth('admin')->check()) {

            $roles = Role::where('guard_name', 'admin')->get();
            $cities = City::all();
            $admin = Admin::findOrFail(Auth::id());

            return response()->view('auth.edit-Admin-profile', compact('cities', 'admin', 'roles'));
        }
    }


    public function updateProfile(Request $request)
    {

        if (auth('admin')->check()) {
            $this->authorize('update', Admin::class);
            $validator = validator(
                $request->all(),
                [
                    'email' => "required",
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
                    'gender.required' => 'Select Admin Gender ',
                    'city_id.required' => 'Select Admin City. '
                ]
            );

            if (!$validator->fails()) {
                $admin = Admin::findOrFail(Auth::id());
                $admin->email = $request->email;
                $issaved = $admin->save();



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



        if (auth('author')->check()) {
            $this->authorize('update', Author::class);

            $validator = validator(
                $request->all(),
                [
                    'email' => "required",
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
                    'first_name.required' => 'Enter Author first name . ',
                    'last_name.required' => 'Enter Author last name . ',
                    'mobile.required' => 'Enter Author mobile number. ',
                    'date.required' => 'Enter Author date of birth. ',
                    'address.required' => 'Enter Author address. ',
                    'gender.required' => 'Select Author Gender ',
                    'city_id.required' => 'Select Author City. '
                ]
            );

            if (!$validator->fails()) {
                $author = Author::findOrFail(Auth::id());
                $author->email = $request->email;
                $issaved = $author->save();


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

                return ['redirect' => route('authors.index')];

                if ($isSaved) {

                    return response()->json(['icon' => 'success', 'title' => 'Created successfully'], 200);
                } else {
                    return response()->json(['icon' => 'error', 'title' => 'fails to create'], 400);
                }
            } else {
                return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
            }
        }
    }



    public function ResetPassword()
    {
        return response()->view('auth.editPassword');
    }





    public function updatePassword(Request $request) {
        if (auth('admin')->check()) {

            $validator = validator(
                $request->all(),
                [
                    'password' => 'required|string|min:6|max:25',
                    'new_password' => 'required|string|min:6|max:25|confirmed',
                    'new_password_confirmation' => 'required|string|min:6|max:25',
                ],
                []
            );
            if (!$validator->fails()) {

                $admin = Admin::findOrFail(Auth::id());
                if (Hash::check($request->get('password'), $admin->password)) {
                    $admin->password = Hash::make($request->get('new_password'));
                    $isUpdate = $admin->update();
                    return ['redirect' => route('main')];

                    if ($isUpdate) {

                        return response()->json(['icon' => 'success', 'title' => 'Updated Password successfully'], 200);
                    } else {
                        return response()->json(['icon' => 'error', 'title' => 'failed To Update Password'], 400);
                    }
                } else {
                    return response()->json(['icon' => 'error', 'title' => 'Old Password Is Wrong'], 400);
                }
            } else {
                return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
            }
        }
        if (auth('author')->check()) {

            $validator = validator(
                $request->all(),
                [
                    'password' => 'required|string|min:6|max:25',
                    'new_password' => 'required|string|min:6|max:25|confirmed',
                    'new_password_confirmation' => 'required|string|min:6|max:25',
                ],
                []
            );
            if (!$validator->fails()) {

                $author = Author::findOrFail(Auth::id());
                if (Hash::check($request->get('password'), $author->password)) {
                    $author->password = Hash::make($request->get('new_password'));
                    $isUpdate = $author->update();
                    return ['redirect' => route('main')];

                    if ($isUpdate) {

                        return response()->json(['icon' => 'success', 'title' => 'Updated Password successfully'], 200);
                    } else {
                        return response()->json(['icon' => 'error', 'title' => 'failed To Update Password'], 400);
                    }
                } else {
                    return response()->json(['icon' => 'error', 'title' => 'Old Password Is Wrong'], 400);
                }
            } else {
                return response()->json(['icon' => 'error', 'title' => $validator->getMessageBag()->first()], 400);
            }
        }



    }
}
